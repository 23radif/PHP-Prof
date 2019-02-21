<?php
/**
 * Created by PhpStorm.
 * User: 23rad
 * Date: 21.02.2019
 * Time: 3:27
 */

trait Traits
{
    public static function getObject($content){
        if(Singleton::$object==null){
            Singleton::$object = new self($content);
        }
        return Singleton::$object;
    }

    private function __clone() {}
    private function __wakeup() {}
}