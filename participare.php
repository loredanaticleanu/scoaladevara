<?php
require 'connect.php';
if (isset($_POST['curs_id']) && $_SESSION['logat']) {
    $curs_id = (int) $_POST['curs_id'];
    $user_id = $_SESSION['user']['id'];
    $sql = "INSERT INTO user_curs (curs_id, user_id) VALUES ($curs_id, $user_id)";
    mysqli_query($conexiune, $sql) or die(mysqli_error($conexiune));
    header("Location: cursuri.php");
}