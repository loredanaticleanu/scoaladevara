<?php
require_once 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Scoala de vara</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</head>
<body>
<div class="container">

    <div>
        <img src="images/training_banner.jpg" width="100%" height="200">
    </div>

        <nav class="navbar navbar-expand-sm bg-secondary navbar-dark" width="40px">
            <ul class="navbar-nav justify-content-around w-100">
                <li class="nav-item">
                    <a class="nav-link" href="acasa.php">Acasa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="despre.php">Despre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="organizatori.php">Organizatori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cursuri.php">Cursuri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="scoala_de_vara.php">Scoada de vara</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="participanti.php">Participanti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <?php
                    if(!$_SESSION['logat']) {
                ?>
                    <li class="nav-item">
                            <a class="nav-link" href="inregistrare.php">Inregistrare</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="autentificare.php">Autentificare</a>
                    </li>

                <?php } else { ?>
                <li class="nav-item">
                        <a class="nav-link" href="cursuri_user.php">Cursuri active</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                </li>
                <?php } ?>
            </ul>
        </nav>
        <?php if ($_SESSION['logat']) { ?>
            <div class="text-right">
                <span>Bine ai venit, <?php echo $_SESSION['user']['nume'] ?></span>
            </div>
        <?php } ?>


