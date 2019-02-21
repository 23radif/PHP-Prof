<?php
/**
 * Created by PhpStorm.
 * User: 23rad
 * Date: 21.02.2019
 * Time: 1:53
 */

spl_autoload_register(function($name){
    if (file_exists("$name.class.php")) {
        include "$name.class.php";
    } else if (file_exists("$name.php")) {
        include "$name.php";
    }
});

new PieceGood(25000, 18000);

new WeightGood(60, 15, 150);

Singleton::getObject('Синглтон');
Singleton::getObject('Синглтон 2 раз нельзя вызвать');