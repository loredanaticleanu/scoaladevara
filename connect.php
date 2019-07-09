<?php
session_start();


define('DB_HOST', 'localhost');
define('DB_NAME', 'scoala_de_vara');
define('DB_USER', 'root');
define('DB_PASS', 'lore');


error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);


$conexiune = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

if (!$conexiune) {
    die('Eroare conectare la MySQL: ' . mysqli_connect_error());
}

mysqli_select_db($conexiune, DB_NAME) or die("Eroare la selectarea bazei de date " . mysqli_error($conexiune));
?>