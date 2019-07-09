<?php
include 'connect.php';

unset($_SESSION);
session_unset();
session_destroy();

header("Location: index.php");

?>