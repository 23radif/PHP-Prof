<?php
/**
 * Created by PhpStorm.
 * User: 23rad
 * Date: 17.02.2019
 * Time: 21:12
 */

class ShoesShop extends Shop
{
    private $present;
    function __construct($name, $price, $count, $present = 'подарок')
    {
        $this->setPresent($present);
        parent::__construct($name, $price, $count);
        echo "Вы заказали туфли модели: '{$this->getName()}' в количестве {$this->getCount()} штук. Цена 1 единицы: {$this->getPrice()}р.
        Сумма заказа: {$this->sum()}<br><span style='color: lawngreen'>При покупке замечательных туфель мы подарим Вам {$this->getPresent()} совершенно бесплатно! Торопись!</span><br>";
    }

    private function setPresent($present) {
        $this->present = $present;
    }

    private function getPresent() {
        return $this->present;
    }
}