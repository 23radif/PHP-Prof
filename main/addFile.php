<?php
function index () {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $file = PUBLIC_DIR . '/../uploads/' . $_FILES['userfile']['name'];
        copy($_FILES['userfile']['tmp_name'], $file);
        header('Location: '. $_SERVER['REQUEST_URI']);
        exit;
    }

    $content = <<<php
    <h1>Загрузка файлов (хранятся в директории: /uploads)</h1>
<p>
<form enctype="multipart/form-data" method="post">
    Отправить этот файл: <input name="userfile" type="file" >
    <input type="submit" value="Отправить файл" >
</form>
php;
    fileLog('-addFile');
    $_SESSION['title'] = 'Загрузка файлов';
    if (isAdmin()) {
        return $content;
    }
    return '<b>Для доступа к данному функционалу необходимо авторизовться как Администратор! Данные предоставлены на странице авторизации</b>';
}