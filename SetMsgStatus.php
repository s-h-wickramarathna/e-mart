<?php
require "connection.php";

if(isset($_GET["e"])){
    $email = $_GET["e"];

    Database::iud("UPDATE `inquiry` SET `admin_view_status`='1' WHERE `in_to`='".$email."' AND `in_from`='sanchithaheashan655@gmail.com' ");
    echo("Success");

}


?>