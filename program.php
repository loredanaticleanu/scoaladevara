<?php
include 'connect.php';
include 'header.php';

$query = "SELECT * FROM program 
              inner join curs 
              on curs.id = curs_id";
$result = mysqli_query($conexiune, $query) or die(mysqli_error($conexiune));

while ($curs = mysqli_fetch_assoc($result)) {
    $data_inceput = date('m-d-Y', strtotime($curs['data_inceput']));
    $data_sfarsit = date('m-d-Y', strtotime($curs['data_sfarsit']));
    $durata = date_diff(date_create($curs['data_inceput']), date_create($curs['data_sfarsit']))->format('%d zile');
    ?>
    <div class="row my-3">
        <div class="col-4">
            <div class="card">
                <img class="card-img-top" src="images/<?php echo $curs['logo'] ?>" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $curs['nume'] ?></h4>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="row align-items-center h-100">
                <div class="col"><?php echo $data_inceput?></div>
                <div class="col"><?php echo $data_sfarsit?></div>
                <div class="col"><?php echo $durata?></div>
            </div>
        </div>
    </div>
    <?php
}
include 'footer.php';
