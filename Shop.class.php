<?php
/**
 * Created by PhpStorm.
 * User: 23rad
 * Date: 17.02.2019
 * Time: 19:54
 */

class Shop {
    private $name;
    private $price;
    private $count;
    private static $log;

    function __construct($name, $price, $count) {
        $this->setName($name);
        $this->setPrice($price);
        $this->setCount($count);
        $this->log();
        $this->sum();
    }

    private function log () {
        if (empty(Shop::$log)) {
            Shop::$log = 0;
        }
        Shop::$log++;
    }

    protected function sum () {
        return $this->count * $this->price;
    }

    private function setName ($name) {
        $this->name = $name;
    }
    private function setPrice ($price) {
        $this->price = $price;
    }
    private function setCount ($count) {
        $this->count = $count;
    }

    protected function getName () {
        return $this->name;
    }
    protected function getPrice () {
        return $this->price;
    }
    protected function getCount () {
        return $this->count;
    }
    public static function getLog () {
        return Shop::$log;
    }
}