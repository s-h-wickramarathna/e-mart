<?php

session_start();
require "connection.php";

if(isset($_GET["i"])){
    $user_email = $_SESSION["user"]["email"];
    $pid = $_GET["i"];

    $watchlist_rs = Database::Search("SELECT * FROM `watchlist` WHERE `user_email`='".$user_email."' AND `product_id`='".$pid."' ");
    $watchlist_num = $watchlist_rs->num_rows;

    if($watchlist_num == 0){

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H-i-s");
        
        Database::iud("INSERT INTO `watchlist` (`user_email`,`product_id`,`w_view_status`,`w_datetime`) VALUES
        ('".$user_email."','".$pid."','1','".$date."') ");

        echo("Successfully add to Watchlist ....");

    }else{
        echo("This Product Already Exist In Watchlist ....");
    }

}
