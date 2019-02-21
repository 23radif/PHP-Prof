<?php
/**
 * Created by PhpStorm.
 * User: 23rad
 * Date: 21.02.2019
 * Time: 1:49
 */

class PieceGood extends Good
{
    public function __construct($price, $realPrice, $count = 1)
    {
        parent::__construct($price, $realPrice, $count);
        echo "Цена штучного товара: {$this->getPrice()}. Доход: {$this->getIncome()}<br>";
        new DigitalGood($price, $realPrice, $count);
    }
}