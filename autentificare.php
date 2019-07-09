<?php

include 'connect.php';
include 'header.php';

if (isset($_POST['submit'])) {
    $mail = $_POST['mail'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM user where mail ='$mail'";
    $result = mysqli_query($conexiune, $query) or die(mysqli_error($conexiune));

    if (mysqli_num_rows($result)) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($pass,  $user['password'])) {
            $_SESSION['logat'] = true;
            $_SESSION['user'] = $user;

            header("Location: acasa.php");
        }
    } else {
        echo "Mail sau parola gresite!";
    }
}

?>
    <div class="container mb-5">
        <form class="form-horizontal mx-auto" role="form" method="POST" action="autentificare.php"><br><br>

            <div class="row">
                <div class="col-md-3 field-label-responsive">
                    <label for="email">E-Mail *</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <input type="text" name="mail" class="form-control" id="mail"
                                   placeholder="you@example.com" required autofocus>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-3 field-label-responsive">
                    <label for="password">Parola *</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <input type="password" name="password" class="form-control" id="parolapas"
                                   placeholder="********" required>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <input class="btn btn-secondary btn-lg btn-block" type="submit" name="submit"
                           value="Autentificare"/>
                </div>
            </div>
        </form>

        <?php if (isset($_GET['mesaj_participare'])) {
            echo '<div class="my-4 alert alert-warning text-center">
                      Pentru a participa trebuie sa te autentifici. Daca nu ai un cont, <a href="inregistrare.php">inregistreaza-te</a>.
                  </div>';
        } ?>

    </div>

<?php
include 'footer.php';
?>