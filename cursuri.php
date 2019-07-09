<?php
include 'connect.php';
include 'header.php';

if ($_SESSION['logat']) {
    $user = $_SESSION['user'];

    $user_id = $user['id'];
    $sql = "SELECT * FROM user_curs WHERE user_id = $user_id";

    $cursuri_user = [];

    $result = mysqli_query($conexiune, $sql) or die(mysqli_error($conexiune));
    if (mysqli_num_rows($result)) {
        while ($user_curs = mysqli_fetch_assoc($result)) {

            $cursuri_user[] = $user_curs['curs_id'];

        }
    }
}

?>

    <br>
    <div class="container text-justify" style="width: 100%">
        <div class="card-deck">
            <?php

            $sql = "SELECT * FROM curs";
            $result = mysqli_query($conexiune, $sql);
            if (mysqli_num_rows($result)) {
                while ($curs = mysqli_fetch_assoc($result)) {

                    ?>
                    <div class="card" style="width:400px">
                        <img class="card-img-top" src="images/<?php echo $curs['logo'] ?>" style="width:100%">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $curs['nume'] ?></h4>
                            <p class="card-text">
                                <?php echo $curs['detalii'] ?>
                                <?php
                                if (!$_SESSION['logat']) {
                                    echo '<div>
                                            <a class=" btn btn-primary stretched-link" href="autentificare.php?mesaj_participare">Participa</a>
                                          </div>';
                                } elseif (in_array($curs['id'], $cursuri_user)) {
                                    echo '<div class="alert alert-success">Participi la acest curs!</div>';
                                }
                                else {
                                ?>
                            <form action="participare.php" method="post">
                                <input type="hidden" name="curs_id" value="<?php echo $curs['id'] ?>">
                                <input type="submit" value="Participa" name="submit"
                                       class="btn btn-primary stretched-link"/>
                            </form>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <br>
                    <?php
                }
            }
            ?>
        </div>
    </div>
<?php
include 'footer.php';
?>