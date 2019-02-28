<?php
function index () {
    $del = (int)$_GET['del'];
    if (! empty($del)) {
        $sql = "DELETE FROM users WHERE id = $del";
        mysqli_query(connect(), $sql);
        header('Location: ?page=users');
        exit;
    }

    $sql = "SELECT id, name, login, password, typeUser, dob 
        FROM users
        ORDER BY id DESC";
    $res = mysqli_query(connect(), $sql);
    $content = '<h1>Добавление пользователя</h1><a href="?page=addUser"><h3>Добавить (статус 1 - Администратор, 0 - Пользователь)</h3></a>';

    while($row = mysqli_fetch_assoc($res)){
        $content .= <<<php
    <p>
    Логин: <b>{$row['login']}</b> Имя: <b>{$row['name']}</b> Статус: <b>{$row['typeUser']}</b> День Рождения: <b>{$row['dob']}</b><br> Пароль(зашифрован): <b>{$row['password']}</b>
    | <a href="?page=users&del={$row['id']}">Удалить</a>
    | <a href="?page=editUser&edit={$row['id']}">Изменить данные</a>
    <br>
    </p>

php;
    }
    fileLog('-users');
    $_SESSION['title'] = 'Пользователи';
    if (isAdmin()) {
        return $content;
    }
    return '<b>Для доступа к данному функционалу необходимо авторизовться как Администратор! Данные предоставлены на странице авторизации</b>';
}
