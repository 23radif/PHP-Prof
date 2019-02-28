<?php
function index(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $statusProduct = (int)clearStr($_POST['statusProduct']);
        $userProduct = clearStr($_POST['userProduct']);
        $id = (int)clearStr($_POST['id']);
        $sql = "UPDATE zakaz SET status = {$statusProduct} WHERE id = {$id}";
        mysqli_query(connect(), $sql);

        if ($userProduct == 'Отменить заказ') {
            $sql = "DELETE FROM zakaz WHERE id = {$id}";
            mysqli_query(connect(), $sql);
        }
    }

    $_SESSION['msg'] = 'Необходимо авторизоваться, чтобы попасть в личный кабинет!';
    $content = '';
    $login = login();

    if (login()) {
        $_SESSION['msg'] = '';
        $sql = "SELECT name, dob FROM users WHERE login = '{$login}'";
        $res = mysqli_query(connect(), $sql);
        $row = mysqli_fetch_assoc($res);
        $status = (isAdmin()) ? 'Администратор' : 'Пользователь';

        $content = "<h1>Добро пожаловать {$row['name']} в Ваш личный кабинет!</h1>
	Ваш логин: <span style='color:gray;font-weight:600'>{$login}</span><br>
	Ваш статус: <span style='color:gray;font-weight:600'>{$status}</span><br>
	Ваш день рождения: <span style='color:gray;font-weight:600'>{$row['dob']}</span>";

        $sql = "SELECT id, fio, tel, address, status, login, info FROM zakaz ORDER BY id DESC";
        if (!isAdmin()) {
            $sql = "SELECT id, fio, tel, address, status, login, info FROM zakaz WHERE login = '{$login}'";
            $content .= "<h2><br>Мои товары: </h2>";
        } else {
            $content .= "<h2><br>Товары всех клиентов: </h2>";
        }

        $sumPrice = 0;
        $res = mysqli_query(connect(), $sql);
        while ($row = mysqli_fetch_assoc($res)) {
            switch ($row['status']) {
                case '0':
                    $statusProduct = 'Не выполнен';
                    break;
                case '1':
                    $statusProduct = 'В обработке';
                    break;
                case '2':
                    $statusProduct = 'Выполнен';
                    break;
            }
            $content .= "<br><br><h3>Заказ №{$row['id']} (идентификатор в базе данных)</h3>
                         <span>ФИО клиента: {$row['fio']}</span>,
                         <span>Адрес: {$row['address']}</span>,
                         <span>Телефон: {$row['tel']}</span><br><br>";
            $zakaz = json_decode($row['info'], true);
            foreach ($zakaz as $key => $value) {
                $sumPrice += (int)$value['price'] * (int)$value['count'];
                $content .= "<br>
                <h4>Наименование товара: {$value['name']}</h4>
                <span>Цена: {$value['price']}</span>,
                <span>Количество: {$value['count']}</span><br><br>
                ";
            }
            $content .= "<span>Общая сумма: {$sumPrice}</span><br> Статус: {$statusProduct}";

            if (isAdmin()) {
                $content .= <<<php
<form method="post">
    <input type="hidden" name="id" value="{$row['id']}">
    <input type="submit" name="statusProduct" value="0"> - Не выполнен
    <input type="submit" name="statusProduct" value="1"> - В обработку
    <input type="submit" name="statusProduct" value="2"> - Выполнить
</form>
php;
            } else {
                $content .= <<<php
<form method="post">
    <input type="hidden" name="id" value="{$row['id']}">
    <input type="submit" name="userProduct" value="Отменить / удалить заказ">
</form>
php;
            }
        }
    }
    fileLog('-personalArea');
    $_SESSION['title'] = 'Личный кабинет';
    return $content;
}
