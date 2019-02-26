<?php

$dirImg = $_GET['dirImg'];
$url = $_GET['url'];
$alt = $_GET['alt'];
$size = $_GET['size'];

$link = mysqli_connect('localhost', 'root', '', 'gbphp');
$sql = "SELECT id, url, size, name, CountClick FROM images WHERE url = '{$url}'";
$res = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($res);

$CountClick = (int)$row['CountClick'];
$CountClick++;
$id = (int)$row['id'];

include '../Twig/Autoloader.php';
Twig_Autoloader::register();

try {
    $loader = new Twig_Loader_Filesystem('../templates');

    $twig = new Twig_Environment($loader);

    $template = $twig->loadTemplate('img-full.tmpl');

    echo $template->render(array(
        'row' => $row,
        'dirImg' => $dirImg,
        'url' => $url,
        'alt' => $alt,
        'CountClick' => $CountClick
    ));

} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}

$sql = "UPDATE images SET 
			CountClick = $CountClick
			WHERE id = $id";
$res = mysqli_query($link, $sql) or die(mysqli_error($link));

mysqli_close($link);

