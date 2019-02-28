<?php
function index () {
    $edit = (int)$_GET['edit'];
    if (empty($edit)) {
        header('Location: ?page=users');
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $login = clearStr($_POST['login']);
        $name = clearStr($_POST['name']);
        $password = $_POST['password'];
        $dob = clearStr($_POST['dob']);
        $typeUser = clearStr($_POST['typeUser']);
        $sql = "UPDATE users SET 
                name ='$name' ,
                login ='$login' ,
                password ='$password' ,
                dob ='$dob' ,
                typeUser ='$typeUser' 
             WHERE id = $edit";
        mysqli_query(connect(), $sql) or die(mysqli_error(connect()));
//    header('Location: '. $_SERVER['REQUEST_URI']);
        header('Location: ?page=users');
        exit;
    }

    $sql = "SELECT id, name, login, password, typeUser, dob FROM users WHERE id = {$edit}";
    $res = mysqli_query(connect(), $sql);
    $row = mysqli_fetch_assoc($res);

    $content = <<<php
    <h1>Редактирование пользователя (typeUser: 1 - Администратор, 0 - Пользователь)</h1>
<form method="post">
    <input type="text" name="name" placeholder="name" value="{$row['name']}">
    <input type="text" name="login" placeholder="login" value="{$row['login']}">
    <input type="text" name="password" placeholder="password" value="{$row['password']}">
    <input type="text" name="typeUser" placeholder="typeUser" value="{$row['typeUser']}">
    <input type="date" name="dob" placeholder="dob" value="{$row['dob']}">
    <input type="submit">
</form>
php;
    fileLog('-editUser');
    $_SESSION['title'] = 'Редактирование пользователя';
    return $content;
}

