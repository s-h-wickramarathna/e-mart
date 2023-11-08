<?php
session_start();
require "connection.php";

if(isset($_SESSION["user"])){

    $u_email = $_SESSION["user"]["email"];

    Database::iud("UPDATE `invoice` SET `Delete_Number`='2' WHERE `user_email`='".$u_email."' ");

    echo("Success Update");
}

?>