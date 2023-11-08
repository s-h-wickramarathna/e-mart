<?php

require "connection.php";

if($_GET["c"] && $_GET["id"]){
   $status =  $_GET["c"];
   $pid =  $_GET["id"];

    
$p_rs = Database::Search("SELECT * FROM `product` WHERE `id`='".$pid."'");
$p_data = $p_rs->fetch_assoc();

if($p_data["status_s_id"]== 1){
    Database::iud("UPDATE `product` SET `status_s_id`='".$status."' WHERE `id`='".$pid."' ");
    echo("product Successfully Deactivated");

}else if ($p_data["status_s_id"]== 2){
    Database::iud("UPDATE `product` SET `status_s_id`='".$status."' WHERE `id`='".$pid."' ");
    echo("product Successfully Activated");
}


}else{
    echo("Somthing Went Wrong");
}


?>