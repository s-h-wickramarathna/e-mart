<?php
session_start();
require "connection.php";

$sellerNIC = $_POST["se"];
$sellerpassword = $_POST["sp"];
$sellerRememberme = $_POST["sr"];

if (empty($sellerNIC)) {
    echo ("Enter Your NIC Number ???");
} else if (empty($sellerpassword)) {
    echo ("Enter Your Password ???");
} else {

    $seller_rs = Database::Search(" SELECT * FROM `seller` WHERE `nic`='" . $sellerNIC . "' AND `seller_password`='" . $sellerpassword . "' ");
    $seller_num = $seller_rs->num_rows;

    if ($seller_num == 1) {
        $seller_data = $seller_rs->fetch_assoc();

        if($seller_data["s_status"] == 3){
            echo("blocked");
            
        }else if($seller_data["s_status"] == 2){
            $_SESSION["seller"] = $seller_data;

            if ($sellerRememberme == "true") {
                setcookie("snic", $sellerNIC, time() + (60 * 60 * 360));
                setcookie("spassword", $sellerpassword, time() + (60 * 60 * 360));
            } else {
                setcookie("snic", "", -1);
                setcookie("spassword", "", -1);
            }
    
            echo ("success");

        }

    } else {
        echo ("Invalid Email Or Password ???");
    }
}
