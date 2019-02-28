<?php
function index()
{
    if (empty($_SESSION['goods'])) {
        return 'Корзина пуста';
    }
    $content = '<h1>Корзина товаров</h1>';
    $dirImg = 'img/';
    $sumPrice = 0;
    foreach ($_SESSION['goods'] as $id => $good) {
        $content .= <<<php
        <div style="display: inline-block">
            <img src="$dirImg{$good['url']}" alt="{$good['name']}" style="width: 100px; height: 100px; object-fit: cover;">
            <h3>{$good['name']}</h3>
            <p>{$good['price']}р.</p>
            <p>
                <a href="?page=backet&func=del&id={$id}">-</a>    
                    {$good['count']}
                <a href="?page=backet&func=add&id={$id}">+</a>
            </p>
        </div>
php;
        $sumPrice += $good['priceSum'];
    }

    $content .= <<<php
    <p>Общая сумма: {$sumPrice}</p>
    <h2>Заказать (авторизованным доступен дополнительный функционал в ЛК)</h2>
<form method="post" action="?page=backet&func=zakaz">
    <input name="fio" placeholder="fio">
    <input name="tel" placeholder="tel">
    <input name="address" placeholder="address">
    <input type="submit">
</form>  
php;
    fileLog('-backet');
    $_SESSION['title'] = 'Корзина товаров';
    return $content;
}

function add() {
    $id = (int)$_GET['id'];
    $msg = 'Что-то пошло не так...';
    if (!empty($id)) {
        $sql = "SELECT id, name, info, price, url FROM goods WHERE id = $id";
        $res = mysqli_query(connect(), $sql);
        $row = mysqli_fetch_assoc($res);
        if (!empty($row)) {
            $item = [
                'price' => $row['price'],
                'name' => $row['name'],
                'priceSum' => $row['price'],
            ];
            if (empty($_SESSION['goods'][$id])) {
                $item['count'] = 1;
                $_SESSION['goods'][$id] = $item;
                $_SESSION['goods'][$id]['url'] = $row['url'];
            } else {
                $_SESSION['goods'][$id]['count'] += 1;
                $_SESSION['goods'][$id]['url'] = $row['url'];
                $_SESSION['goods'][$id]['priceSum'] += $_SESSION['goods'][$id]['price'];
            }
            $msg = '';
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo count ($_SESSION['goods']);
        exit;
    }

    $_SESSION['msg'] = $msg;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

function del()
{
    $id = (int)$_GET['id'];
    $msg = 'Что-то пошло не так...';
    if (!empty($id)) {
        if (!empty($_SESSION['goods'][$id])) {
            if ($_SESSION['goods'][$id]['count'] != 1) {
                $_SESSION['goods'][$id]['count'] -= 1;
                $_SESSION['goods'][$id]['priceSum'] -= $_SESSION['goods'][$id]['price'];
            } else {
                unset($_SESSION['goods'][$id]);
            }
        }
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

function addajax(){
    add();
}

function zakaz() {
    $msg = 'Что-то пошло не так...';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $fio = clearStr($_POST['fio']);
        $tel = clearStr($_POST['tel']);
        $address = clearStr($_POST['address']);
        $login = $_SESSION['login'];
        $info = json_encode(array_values($_SESSION['goods']), JSON_UNESCAPED_UNICODE );

        if (!empty($fio) && !empty($tel) && !empty($address)) {
            $sql = "INSERT INTO zakaz(fio, tel, address, info, login) 
                  VALUES ('$fio', '$tel', '$address', '$info', '$login')";
            mysqli_query(connect(), $sql);
            unset($_SESSION['goods']);
            $msg = 'Ваш заказ принят';
        } else {
            $msg = 'Необходимо заполнить все данные!';
        }
    }
    $_SESSION['msg'] = $msg;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}