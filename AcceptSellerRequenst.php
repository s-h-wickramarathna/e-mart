<?php
require "connection.php";

if(isset($_GET["n"])){
    $nic = $_GET["n"];
    
    Database::iud("UPDATE `seller` SET `s_status`='2' WHERE `nic`='".$nic."' ");
    echo("succcess");
    
}


?>