<?php

require "connection.php";

if(isset($_GET["id"])){
    $size_id = $_GET["id"];

    $size_rs = Database::search("SELECT * FROM `category` WHERE `ca_id`='".$size_id."' ");
    $size_data = $size_rs->fetch_assoc();

    if($size_data["ca_name"]=="Aperals(Clothes)"){
        echo("Have Sizes");
    }else{
        echo("Havent Sizes");
    }


}else{
    echo("Somthing Went Wrong");
}


?>