<?php
/**
 * Created by PhpStorm.
 * User: 23rad
 * Date: 03.03.2019
 * Time: 18:46
 */

spl_autoload_register(function($classname){
    include_once("../c/$classname.php");
    require_once '../vendor/autoload.php';
});

$action = 'action_';
$action .= (isset($_GET['act'])) ? $_GET['act'] : 'index';

switch ($_GET['c'])
{
    case 'articles':
        $controller = new C_Page();
        break;
    case 'auth':
        $controller = new C_Auth();
        break;
    default:
        $controller = new C_Page();
}

$controller->Request($action);