<?php
session_start();
require "connection.php";

if(isset($_POST["v"]) && isset($_POST["a"]) && isset($_POST["p"])){
    $email = $_POST["a"];
    $password = $_POST["p"];
    $vcode = $_POST["v"];

    $admin_rs = Database::Search("SELECT * FROM `admin` WHERE `email`='" . $email . "' AND `admn_password`='" . $password . "' AND `admin_verification_code`='".$vcode."' ");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num == 1) {
        $admin_data = $admin_rs->fetch_assoc();

        $_SESSION["admin"] = $admin_data;

         echo("success");
    }

}


?>