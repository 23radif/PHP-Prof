<?php
/**
 * Created by PhpStorm.
 * User: 23rad
 * Date: 21.02.2019
 * Time: 1:49
 */

class DigitalGood extends Good
{
    public function __construct($price, $realPrice, $count = 1)
    {
        parent::__construct($price / 2, $realPrice / 2, $count);
        echo "Цена цифрового товара в 2 раза меньше: {$this->getPrice()}. Доход: {$this->getIncome()}<br><br>";
    }

}