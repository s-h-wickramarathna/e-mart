<?php
session_start();
require "connection.php";

if(isset($_GET["i"])){
    $pid = $_GET["i"];
    Database::iud("DELETE FROM `watchlist` WHERE `user_email`='".$_SESSION["user"]["email"]."' AND  `product_id`='".$pid."' ");
    echo("Success");
}
