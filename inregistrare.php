<?php

include "header.php";
include "connect.php";

$comanda = $_REQUEST["submit"];
if (isset($comanda)) {
    $nume = $_POST["nume"];
    $mail = $_POST["mail"];
    $username = $_POST["username"];
    $parola = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $profesia = $_POST["profesia"];

    function test_input($data)
    {
        $data = trim($data);
        $data = addslashes($data); // l'oreal => l\'oreal
        $data = htmlspecialchars($data);
        return $data;
    }


    $nameError = $emailError = $userError = $parolaError = $cpError = $profError = "";
    $nume = $mail = $username = $parola = $confirm_password = $profesia = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["nume"])) {
            $nameError = "Name is required";
        } else {
            $nume = test_input($_POST["nume"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $nume)) {
                $nameError = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["mail"])) {
            $emailError = "Email is required";
        } else {
            $mail = test_input($_POST["mail"]);
            // check if e-mail address is well-formed
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $emailError = "Invalid email format";
            } else {
                $check = mysqli_query($conexiune, "SELECT id FROM user WHERE mail = '$mail'");
                if (mysqli_num_rows($check) > 0) {

                    $emailError = "Email already exist! ";
                }
            }
        }

        if (empty($_POST["username"])) {
            $userError = "username is required";
        } else {
            $username = test_input($_POST["username"]);
            if (!preg_match("/^[a-zA-Z ]*$/", $username)) {
                $userError = "Only letters and white space allowed";
            }
        }

        if (empty($_POST['password'])) {
            $parolaError = "Please enter password   ";
        } elseif (!empty($_POST["password"]) && !empty($_POST['confirm_password']) && ($_POST["password"] == $_POST["confirm_password"])) {

            $parola = test_input($_POST["password"]);
            $conf_parola = test_input($_POST["confirm_password"]);

            if (strlen($_POST["password"]) < 8) {
                $parolaError = "Your Password Must Contain At Least 8 Characters!";
            } elseif (!preg_match("#[0-9]+#", $parola)) {
                $parolaError = "Your Password Must Contain At Least 1 Number!";
            } elseif (!preg_match("#[A-Z]+#", $parola)) {
                $parolaError = "Your Password Must Contain At Least 1 Capital Letter!";
            } elseif (!preg_match("#[a-z]+#", $parola)) {
                $parolaError = "Your Password Must Contain At Least 1 Lowercase Letter!";
            }
        } elseif (empty($_POST["confirm_password"])) {
            $cpError = "Please Check You've Entered Or Confirmed Your Password!";
        } else {
            $cpError = "Password do not match";
        }




        if (empty($_POST["profesia"])) {
            $profError = "Profesia is required";
        } else {
            $profesia = test_input($_POST["profesia"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $profesia)) {
                $profError = "Only letters and white space allowed";
            }
        }

        $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);



        if (empty($nameError) && empty($parolaError) && empty($cpError) && empty($emailError) && empty($userError) && empty($profError)) {
            $sql = "INSERT INTO user(nume, mail, username, password, profesia)
                VALUES ('$nume', '$mail','$username', '$pass_hash','$profesia')";
            if (!mysqli_query($conexiune, $sql)) {
                die('Error: ' . mysqli_error($conexiune));
            } else {
                header("Location:autentificare.php");

            }
        }
    }
}
?>

    <div class="container mb-5">
        <form class="form-horizontal mx-auto    " role="form" method="POST" action="inregistrare.php"><br><br><br>
            <div class="row">
                <div class="col-md-3 field-label-responsive">
                    <label for="name">Nume *</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <input type="text" name="nume" class="form-control" id="nume"
                                   placeholder="John Doe" required autofocus>
                            <div><?php echo $nameError; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <!-- Put name validation error messages here -->
                        </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 field-label-responsive">
                    <label for="email">E-Mail *</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <input type="text" name="mail" class="form-control" id="email"
                                   placeholder="you@example.com" required autofocus>
                            <div><?php echo $emailError ?></div>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <!-- Put e-mail validation error messages here -->
                        </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 field-label-responsive">
                    <label for="email">Username *</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <input type="text" name="username" class="form-control" id="email"
                                   placeholder="username" required autofocus>
                            <div><?php echo $userError ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <!-- Put e-mail validation error messages here -->
                        </span>
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
                            <?php echo $parolaError; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 field-label-responsive">
                    <label for="password">Confirmare parola *</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <input type="password" name="confirm_password" class="form-control" id="confirm_password"
                                   placeholder="********" required>
                            <div><?php echo $cpError ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 field-label-responsive">
                    <label for="email">Profesia *</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <input type="text" name="profesia" class="form-control" id="profesia"
                                   placeholder="profesia" required autofocus>
                            <div><?php echo $profError ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <!-- Put e-mail validation error messages here -->
                        </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <input class="btn btn-secondary btn-lg btn-block" type="submit" name="submit" value="Inregistrare"/>
                </div>
            </div>
        </form>
    </div>

<?php

include "footer.php";

?>