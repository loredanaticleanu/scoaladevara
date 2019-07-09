<?php

include 'connect.php';
include 'header.php';

if ($_SESSION['logat']) {

    $user = $_SESSION['user'];
    $user_id = $user['id'];

    $query = "SELECT * FROM user_curs 
              inner join curs 
              on curs.id = curs_id

              WHERE user_id = $user_id";
    $result = mysqli_query($conexiune, $query) or die(mysqli_error($conexiune));
    ?>

    <br>
    <div class="container text-justify" style="width: 100%">
    <div class="card-deck">

    <?php
    while ($curs = mysqli_fetch_assoc($result)) {
        ?>
        <div class="card" style="width:400px">
        <img class="card-img-top" src="images/<?php echo $curs['logo'] ?>" style="width:100%">
        <div class="card-body">
        <h4 class="card-title"><?php echo $curs['nume'] ?></h4>
        <p class="card-text">
        <?php echo $curs['detalii'] ?>

        </div>
        </div>
        <?php
    }
        ?>
    </div>
</div>
    <br>
    <?php

}