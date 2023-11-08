<?php
require "connection.php";

if(isset($_GET["n"])){
    $nic = $_GET["n"];
    
    Database::iud("DELETE FROM `nic_images` WHERE `seller_nic`='".$nic."' ");
    Database::iud("DELETE FROM `seller` WHERE `nic`='".$nic."' ");
    echo("succcess");
    
}


?>