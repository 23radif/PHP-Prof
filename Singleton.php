<?php
/**
 * Created by PhpStorm.
 * User: 23rad
 * Date: 21.02.2019
 * Time: 3:08
 */

class Singleton{
    private $content;
    static $object;

    private function __construct($content){
        $this->content = $content;
        echo $content;
	}
    use Traits;
}

