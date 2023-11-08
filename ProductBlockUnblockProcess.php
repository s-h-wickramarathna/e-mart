<?php
require "connection.php";

if(isset($_GET["i"])){
    $id = $_GET["i"];

    $product_rs = Database::Search("SELECT * FROM `product` WHERE `id`='".$id."' ");
    $product_data = $product_rs->fetch_assoc();

    if($product_data["admin_status"] == 1){
        Database::iud("UPDATE `product` SET `admin_status`='2' WHERE `id`='".$id."' ");
        echo("Deactived");

    }else if($product_data["admin_status"] == 2){
        Database::iud("UPDATE `product` SET `admin_status`='1' WHERE `id`='".$id."' ");
        echo("Activated");
        
    }

}



?>