<?php
require "connection.php";
if(isset($_POST["m"])&& $_POST["m"] == 0){
    echo("Please Select Model Name");

}else if(isset($_POST["b"]) && $_POST["b"] == 0){
echo("Please Select Brand");

}else{

    $m_id = $_POST["m"];
    $b_id = $_POST["b"];
    $ct_rs = Database::Search("SELECT * FROM `model_has_brand` WHERE `model_id`= '" . $m_id . "' AND `brand_id`='".$b_id."'");
    $ct_num = $ct_rs->num_rows;

    if($ct_num == 0){
        Database::iud("INSERT INTO `model_has_brand`(`model_id`,`brand_id`) VALUES ('".$m_id."','".$b_id."')");
        echo("1");

    }else{
        echo("2");
    }
}