<?php
session_start();
require "connection.php";

$user_email = $_SESSION["user"]["email"];
$f_text = $_POST["f"];
$r_count = $_POST["r"];
$product_id = $_POST["i"];


$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `feedbacks` (`product_id`,`user_email`,`ratings_r_id`,`f_content`,`f_datetime`) VALUES
('".$product_id."','".$user_email."','".$r_count."','".$f_text."','".$date."') ");

echo("Success");


?>