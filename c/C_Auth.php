<?php

class C_Auth extends C_Page
{
    public function action_index(){
        //var_dump($_SESSION, $_GET, $_POST);
        $this->title .= 'Authorization';
        $this->content = '';
        $this->content .= <<<php
    <h1>Авторизация</h1>
    <img src="img/img-66df5.jpg" width="200">
    <form method="post" action="?act=auth&c=auth">
        <input type="text" name="login" placeholder="login">
        <input type="text" name="password" placeholder="password">
        <input type="submit">
    </form>
    <script src="js/script.js"></script>
php;
        if (!empty($_SESSION['login'])){
            $this->content = <<<php
    <a href="?act=logout&c=auth" style="cursor: pointer"><h3>Выход</h3></a>
php;
        }
        $this->content .= '<h5>Для доступа к дополнительным возможносям в ЛК, работе с файлами и пользователями авторизуйтесь 
в качестве Администратора <br>(данные: login: admin, password: admin)</h5>';
        //fileLog('-auth');
        $_SESSION['title'] = 'Авторизация';
    }


    public function action_auth(){
        if ($this->IsPost()){
            if (empty($_POST['login']) || empty($_POST['password'])){
                $msg = 'Не все параметры переданы';
                header('Location: ?c=auth');
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
                header('Location: ?c=personalArea');
                exit;
            }
        }
        $_SESSION['msg'] = $msg;
        header('Location: ?c=auth');
        exit;
    }

    public function action_logout(){
        session_destroy();
        header('Location: ?c=auth');
        exit;
    }
}

