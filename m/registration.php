<?php
function index() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = clearStr($_POST['name']);
        $dob = clearStr($_POST['dob']);
        $login = clearStr($_POST['login']);
        $password = passwordGen($_POST['password']);
        $passwordRep = passwordGen($_POST['passwordRep']);

        if ($password != $passwordRep) {
            $_SESSION['msg'] = 'Ошибка при повторном вводе пароля!';
            header('Location: ?page=registration');
            exit;
        }

        if (empty($name) || empty($dob) || empty($login) || empty($password) || empty($passwordRep)) {
            $_SESSION['msg'] = 'Необходимо заполнить все поля!';
            header('Location: ?page=registration');
            exit;
        }

        $sql = "SELECT login FROM users";
        $res = mysqli_query(connect(), $sql);
        while ($row = mysqli_fetch_assoc($res)) {
            if ($login == $row['login']) {
                $_SESSION['msg'] = 'Данный логин уже существует! Подберите другой!';
                header('Location: ?page=registration');
                exit;
            }
        }

        $sql = "INSERT INTO users (name, login, password, dob) 
			VALUES ('$name', '$login', '$password', '$dob')";
        mysqli_query(connect(), $sql);
        $_SESSION['msg'] = '';
        $_SESSION['login'] = $login;

        header('Location: ?page=personalArea');
        exit;
    }

    $content = <<<php
    <h1>Регистрация пользователя</h1>
<form method="post">
    <input type="text" name="name" placeholder="Введите Ваше имя" style="width:220px;padding: 3px"><br>
	<input type="date" name="dob" placeholder="Введите Ваш день рождения" style="width:220px;padding: 3px"><br>
	<input type="text" name="login" placeholder="Придумайте оригинальный логин" style="width:220px;padding: 3px"><br>
    <input type="password" name="password" placeholder="Придумайте сложный пароль" style="width:220px;padding: 3px"><br>
	<input type="password" name="passwordRep" placeholder="Повторите пароль" style="width:220px;padding: 3px"><br>
    <input type="submit">
</form>
php;
    fileLog('-registration');
    $_SESSION['title'] = 'Регистрация пользователя';
    return $content;
}