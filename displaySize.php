<?php

require "connection.php";

if(isset($_GET["id"])){
    $size_id = $_GET["id"];

    $size_rs = Database::search("SELECT * FROM `category` INNER JOIN `category_type` ON `category_type`.`category_tid`=`category`.`category_type_category_tid` WHERE `ca_id`='".$size_id."' ");
    $size_data = $size_rs->fetch_assoc();

    if($size_data["type_of_category"]=="Apperals"){
        echo("Have Sizes");
    }else{
        echo("Havent Sizes");
    }


}else{
    echo("Somthing Went Wrong");
}


?>