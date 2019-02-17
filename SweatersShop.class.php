<?php
/**
 * Created by PhpStorm.
 * User: 23rad
 * Date: 17.02.2019
 * Time: 20:13
 */

class SweatersShop extends Shop
{
    function __construct($name, $price, $count)
    {
        parent::__construct($name, $price, $count);
        echo "Вы заказали свитер модели: '{$this->getName()}' в количестве {$this->getCount()} штук. Цена 1 единицы: {$this->getPrice()}р.
        Сумма заказа: {$this->sum()}<br>";
    }
}
