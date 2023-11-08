<?php
require "connection.php";

if(isset($_GET["e"])){
    $email = $_GET["e"];

    $user_rs = Database::Search("SELECT * FROM `user` WHERE `email`='".$email."' ");
    $user_data = $user_rs->fetch_assoc();

    if($user_data["status"] == 1){
        Database::iud("UPDATE `user` SET `status`='2' WHERE `email`='".$email."' ");
        echo("Deactived");
    }else if($user_data["status"] == 2){
        Database::iud("UPDATE `user` SET `status`='1' WHERE `email`='".$email."' ");
        echo("Activated");
    }

}



?>