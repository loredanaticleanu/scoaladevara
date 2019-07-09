<?php
include 'connect.php';

session_unset();
session_destroy();
// redirectionam userul catre acasa
header("Location: index.php");

?>