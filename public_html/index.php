<?php

$link = mysqli_connect('localhost', 'root', '', 'gbphp');
$sql = "SELECT id, url, size, name FROM images ;";
$res = mysqli_query($link, $sql);

$sql = "SELECT * FROM images ORDER BY CountClick DESC ;";
$res = mysqli_query($link, $sql);

include '../Twig/Autoloader.php';
Twig_Autoloader::register();

try {
  $loader = new Twig_Loader_Filesystem('../templates');
  
  $twig = new Twig_Environment($loader);
  
  $template = $twig->loadTemplate('gallery.tmpl');

  while ($row = mysqli_fetch_assoc($res)) {
    echo $template->render(array (
        'row' => $row
    ));
  }
  
} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}

mysqli_close($link);

//echo phpinfo();
