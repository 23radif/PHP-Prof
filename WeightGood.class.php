<?php
/**
 * Created by PhpStorm.
 * User: 23rad
 * Date: 21.02.2019
 * Time: 1:50
 */

class WeightGood extends Good
{
    public function __construct($price, $realPrice, $count = 1)
    {
        parent::__construct($price, $realPrice, $count);
        echo "Суммарная цена весового товара: {$this->sum()} ({$this->getCount()}кг. * {$this->getPrice()}руб.) 
        Доход: {$this->getIncome()}<br><br>";
    }
}