<?php
require "connection.php";

if(isset($_GET["n"])){
    $nic = $_GET["n"];

    $seller_rs = Database::Search("SELECT * FROM `seller` WHERE `nic`='".$nic."' ");
    $seller_data = $seller_rs->fetch_assoc();

    if($seller_data["s_status"] == 2){
        Database::iud("UPDATE `seller` SET `s_status`='3' WHERE `nic`='".$nic."' ");
        echo("Deactived");

    }else if($seller_data["s_status"] == 3){
        Database::iud("UPDATE `seller` SET `s_status`='2' WHERE `nic`='".$nic."' ");
        echo("Activated");
        
    }

}



?>