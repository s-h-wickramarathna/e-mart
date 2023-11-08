<?php
sleep(2);
require "connection.php";

$email = $_POST["fe"];
$vCode = $_POST["fv"];

if (empty($vCode)) {
    echo ("Enter Your Verificaton Code ???");
} else {

    $rs = Database::Search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `verification_id`='" . $vCode . "'");
    $num = $rs->num_rows;

    if($num == 1){
        echo("success");
    }else{
        echo("Invalid Verification Code ???");
    }
}

?>
