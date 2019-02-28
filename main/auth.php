<?php

function index(){
    $content = '';
    $content .= <<<php
    <h1>Авторизация</h1>
    <img src="img/img-66df5.jpg" width="200">
    <form method="post" action="?page=auth&func=auth">
        <input type="text" name="login" placeholder="login">
        <input type="text" name="password" placeholder="password">
        <input type="submit">
    </form>
    <script src="script.js"></script>
php;
    if (!empty($_SESSION['login'])){
        $content = <<<php
    <a href="?page=auth&func=logout" style="cursor: pointer"><h3>Выход</h3></a>
php;
    }
    $content .= '<h5>Для доступа к дополнительным возможносям в ЛК, работе с файлами и пользователями авторизуйтесь 
в качестве Администратора <br>(данные: login: admin, password: admin)</h5>';
    fileLog('-auth');
    $_SESSION['title'] = 'Авторизация';
    return $content;
}
function auth(){
    $msg = 'Что-то пошло не так';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (empty($_POST['login']) || empty($_POST['password'])){
            $msg = 'Не все параметры переданы';
            header('Location: ?page=auth');
        }
        $login = clearStr($_POST['login']);

        $sql = "SELECT id, login, password, name, typeUser 
                FROM users
                WHERE login = '$login'";
        $res = mysqli_query(connect(), $sql);
        $row = mysqli_fetch_assoc($res);
        $password = passwordGen($_POST['password']);
        $passwordSql = $row['password'];
        if ($password == $passwordSql){
            if ($row['typeUser'] == '1') {
                $_SESSION['isAdmin'] = 'YES';
            }
            $_SESSION['login'] = $login;
            header('Location: ?page=personalArea');
            exit;
        }
    }
    $_SESSION['msg'] = $msg;
    header('Location: ?page=auth');
    exit;
}

function logout(){
    session_destroy();
    header('Location: ?page=auth');
    exit;
}