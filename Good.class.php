<?php
/**
 * Created by PhpStorm.
 * User: 23rad
 * Date: 21.02.2019
 * Time: 1:13
 */

abstract class Good
{
    private $price;
    private $count;
    private $realPrice;
    private $income;

    function __construct($price, $realPrice, $count = 1)
    {
        $this->setPrice($price);
        $this->setCount($count);
        $this->setRealPrice($realPrice);
        $this->setIncome($this->sumIncome());
    }

    protected function sum () {
        return $this->count * $this->price;
    }

    protected function sumReal () {
        return $this->count * $this->realPrice;
    }

    protected function sumIncome () {
        return $this->sum() - $this->sumReal();
    }

    private function setPrice ($price) {
        $this->price = $price;
    }
    private function setCount ($count) {
        $this->count = $count;
    }
    private function setRealPrice ($realPrice) {
        $this->realPrice = $realPrice;
    }
    protected function setIncome ($income) {
        $this->income = $income;
    }

    protected function getPrice () {
        return $this->price;
    }
    protected function getCount () {
        return $this->count;
    }
    protected function getRealPrice () {
        return $this->realPrice;
    }
    protected function getIncome () {
        return $this->income;
    }
}