<?php
function index() {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $login = clearStr($_POST['login']);
        $name = clearStr($_POST['name']);
        $password = passwordGen(clearStr($_POST['password']));
        $dob = clearStr($_POST['dob']);
        $typeUser = clearStr($_POST['typeUser']);
        $sql = "INSERT INTO users(name, login, password, dob, typeUser) 
            VALUES ('$name', '$login', '$password', '$dob', $typeUser)";
        mysqli_query(connect(), $sql);
//    header('Location: '. $_SERVER['REQUEST_URI']);
        header('Location: ?page=users');
        exit;
    }
    $content = <<<php
    <h1>Добавление пользователя (typeUser: 1 - Администратор, 0 - Пользователь)</h1>
<form method="post">
    <input type="text" name="name" placeholder="name">
    <input type="text" name="login" placeholder="login">
    <input type="text" name="password" placeholder="password">
    <input type="text" name="typeUser" placeholder="typeUser">
    <input type="date" name="dob" placeholder="dob">
    <input type="submit">
</form>
php;
    fileLog('-addUser');
    $_SESSION['title'] = 'Добавление пользователя';
    return $content;
}