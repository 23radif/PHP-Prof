<?php

include('../config/config.php');
$dirImg = 'img/';

isset($_GET['num']) ? $num = $_GET['num'] : $num = 0;
$sql = "SELECT id, name, info, price, url FROM goods ORDER BY CountClick DESC LIMIT {$num}, 3"; //Вытаскиваем из таблицы 3 комментария начиная с $num
$res = mysqli_query(connect(), $sql);

if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        $num++;
        $content .= <<<php
		<a href="?page=goods&func=one&id={$row['id']}" style="display: inline-block; margin: 5px">{$row['name']}<br>
		Цена: {$row['price']}р.<br>
		<img src="$dirImg{$row['url']}" alt="{$row['name']}" style="width: 300px; height: 300px; object-fit: cover; margin-top: 5px">
		</a>
php;
    }
    usleep(300000); //Сделана задержка в 1 секунду чтобы можно проследить выполнение запроса
} else {
    $content .= 0; //Если записи закончились
}

echo $content;
