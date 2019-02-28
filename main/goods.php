<?
function index()
{
    $dirImg = 'img/';

    $sql = "SELECT id, name, info, price, url FROM goods ORDER BY CountClick DESC LIMIT 3"; //Вытаскиваем из таблицы 3 комментария
    $res = mysqli_query(connect(), $sql);

    $content = "<div id='content'><script src='js/img-auto-load.js' type=\"text/javascript\"></script>";
    $content .= "<h2>Товары сортируются по популярности:</h2>";
    while ($row = mysqli_fetch_assoc($res)) {
        $content .= <<<php
		<a href="?page=goods&func=one&id={$row['id']}" style="display: inline-block; margin: 5px">{$row['name']}<br>
		Цена: {$row['price']}р.<br>
		<img src="$dirImg{$row['url']}" alt="{$row['name']}" style="width: 300px; height: 300px; object-fit: cover; margin-top: 5px">
		</a>
php;
    }
    $content .= <<<php
</div>
<div id="load">
    <div>Загрузить еще</div>
    <img src="img/loading.gif" id="imgLoad">
</div>
php;

    fileLog('-goods');
    $_SESSION['title'] = 'Товары';
    return $content;
}

function one()
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = clearStr($_POST["name"]);
        $review = clearStr($_POST["review"]);
        $id_images = (int)clearStr($_POST["id_images"]);
        $remove = clearStr($_POST["remove"]);
        $removeRev = clearStr($_POST["removeRev"]);

        if ($remove == 'Удалить') {
            $sql = "DELETE FROM reviews WHERE reviews.num = {$removeRev}";
            mysqli_query(connect(), $sql);
        }

        if (!empty($name) && !empty($review) && !empty($id_images)) {
            $sql = "INSERT INTO reviews (id_images, name, review) 
		            VALUES ('$id_images', '$name', '$review')";
            mysqli_query(connect(), $sql);
        }

        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }

    $dirImg = 'img/';
    $id = (int)$_GET['id'];
    $sql = "SELECT id, name, info, price, url, CountClick FROM goods WHERE id = $id";
    $res = mysqli_query(connect(), $sql);
    $content = '<h4><a href="?page=goods">Все товары</a></h4>';

    $row = mysqli_fetch_assoc($res);
    $content .= <<<php
            <div style="text-align:center">
                <img style="margin:0 auto; max-width: 500px" src="$dirImg{$row['url']}" alt="{$row['name']}"></img>
                <h1>{$row['name']}</h1>
                <h4 style="color: red; cursor: pointer" onclick="send({$id})">Добавить в корзину</h4>
                <span>Цена: {$row['price']}р.</span><br>
                <span>Описание: {$row['info']}</span><br>
php;
    $CountClick = (int)$row['CountClick'];
    $CountClick++;
    $sqlRev = "UPDATE goods SET CountClick = '{$CountClick}' WHERE id = {$row['id']}";
    mysqli_query(connect(), $sqlRev);
    $content .= <<<php
		<figcaption style="width: 600px; margin: 0 auto">
			Число просмотров: <span style="color:red;font-weight:600">{$CountClick}</span><br>
			Описание товара: <span style="color:gray;font-weight:600">{$row['ProductDescription']}</span><br><br>
			Добавить отзыв:
			<form action="" method="post">
				<input type="text" name="name" placeholder="Имя" maxlength="50">
				<input type="text" name="review" placeholder="Отзыв" maxlength="500">
				<input type="hidden" name="id_images" value="{$row['id']}">
				<input type="submit">
			</form><br>Отзывы:<br><br>
php;
    $sqlRev = "SELECT num, id_images, name, review FROM reviews ORDER BY num DESC ";
    $resRev = mysqli_query(connect(), $sqlRev);
    while ($rowRev = mysqli_fetch_assoc($resRev)) {
        if ($row['id'] == $rowRev['id_images']) {
            $reviews = "<span style='color:green;font-weight:600; word-break: break-all'>Имя: {$rowRev['name']}</span><br>" .
                "<span style='color:gray; word-break: break-all'>Отзыв: {$rowRev['review']}</span>" .
                "<form action='' method='post'>
								<input type='submit' name='remove' value='Удалить'>
								<input type='hidden' name='removeRev' value='{$rowRev['num']}'>
							</form><br>";
            $content .= $reviews;
        }
    }
    $content .= '</figcaption></div>';
    fileLog('-goods-one');
    $_SESSION['title'] = 'Товар';
    return $content;
}
