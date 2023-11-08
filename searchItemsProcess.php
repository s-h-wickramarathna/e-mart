<?php

require "connection.php";

$selectItem = $_GET["sitem"];

$selectResult = Database::Search(" SELECT * FROM `user` WHERE `email` LIKE '%" . $selectItem . "%' ");
$num = $selectResult->num_rows;

for ($x = 0; $x < $num; $x++) {
    $d = $selectResult->fetch_assoc();

?>

    <div class="card shadow-lg" style="width: 14rem;">
        <img src="resources/iphone.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php echo ($d["fname"]) ?></h5>
            <p class="card-text"><?php echo ($d["email"]) ?></p> <a href="#" class="btn btn-primary"><?php echo ($d["mobile"]) ?></a>
        </div>
    </div>

<?php

}




?>