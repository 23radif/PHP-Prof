<?php
/**
 * Created by PhpStorm.
 * User: 23rad
 * Date: 17.02.2019
 * Time: 20:49
 */

class ShortsShop extends Shop
{
    function __construct($name, $price, $count)
    {
        parent::__construct($name, $price, $count);
        echo "Вы заказали шорты модели: '{$this->getName()}' в количестве {$this->getCount()} штук. Цена 1 единицы: {$this->getPrice()}р.
        Сумма заказа: {$this->sum()}<br>";
    }
}