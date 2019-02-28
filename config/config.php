<?php
const SOL = "b07152d234b79075b9640";

function passwordGen($pass) {
    return md5(md5($pass . SOL));
}

function connect() {
    static $link;
    if (empty($link)) {
        $link = mysqli_connect('localhost', 'root', '', 'gbphp');
    }
    return $link;
}

function clearStr($str) {
    return mysqli_real_escape_string(connect(), strip_tags(trim($str)));
}

function isAdmin(){
    return $_SESSION['isAdmin'] == 'YES';
}

function login(){
    if (!empty($_SESSION['login'])) {
        return $_SESSION['login'];
    }
    return false;
}

function getMsg(){
    $msg = '';
    if (! empty($_SESSION['msg'])){
        $msg = "<span style='color:red'>{$_SESSION['msg']}</span>";
        $_SESSION['msg'] = '';
    }
    return  $msg;
}

function template($param = '') {
    static $tmpl;
    if (empty($tmpl)){
        $tmpl = 'public.tmpl';
    }
    if (! empty($param)) {
        $tmpl = $param;
    }
    return $tmpl;
}