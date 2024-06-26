<?php
require "connection.php";
if(isset($_POST["c"])&& empty($_POST["c"])){
    echo("Please Enter Category Name");

}else if(isset($_POST["ct"]) && $_POST["ct"] == 0){
echo("Please Select Category Type");

}else{

    $c_txt = $_POST["c"];
    $ct_id = $_POST["ct"];
    $ct_rs = Database::Search("SELECT * FROM `category` WHERE `ca_name` LIKE '%" . $c_txt . "%' AND `category_type_category_tid`='".$ct_id."'");
    $ct_num = $ct_rs->num_rows;

    if($ct_num == 0){
        Database::iud("INSERT INTO `category`(`ca_name`,`category_type_category_tid`) VALUES ('".$c_txt."','".$ct_id."')");
        echo("1");

    }else{
        echo("2");
    }
}
