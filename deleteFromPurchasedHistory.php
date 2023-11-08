<?php
session_start();
require "connection.php";

if(isset($_GET["id"])){

    $invoice_id = $_GET["id"];
    $user_email = $_SESSION["user"]["email"];

    $invoice_rs = Database::iud(" UPDATE `invoice` SET `Delete_Number`='2' WHERE `invoice_id`='".$invoice_id."' AND `user_email`='".$user_email."' ");

    echo("Success");

}



?>