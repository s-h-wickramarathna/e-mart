<?php

session_start();
require "connection.php";

if(isset($_SESSION["user"])){

$o_id = $_POST["o"];
$p_id = $_POST["i"];
$mail = $_POST["u"];
$amount = $_POST["a"];
$qty = $_POST["q"];
$shipping = $_POST["s"];

$product_rs = Database::Search("SELECT * FROM `product` WHERE `id`='".$p_id."' ");
$product_data = $product_rs->fetch_assoc();

$current_qty = $product_data["qty"];
$new_qty = (int)$current_qty - (int)$qty;
Database::iud(" UPDATE `product` SET `qty`='".$new_qty."' WHERE `id`='".$p_id."' ");

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `invoice`
(`order_id`,`total`,`buy_qty`,`status`,`product_id`,`user_email`,`date_time`,`Delete_Number`,`shipping`) VALUES 
('".$o_id."','".$amount."','".(int)$qty."','0','".$p_id."','".$mail."','".$date."','1','".$shipping."')");

echo ("1");

}

?>