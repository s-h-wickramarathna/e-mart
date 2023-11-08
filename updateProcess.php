<?php
session_start();

$seller_nic = $_SESSION["seller"]["nic"];
require "connection.php";

$qty = $_POST["q"];
$d_fee_colombo = $_POST["dc"];
$d_fee_other = $_POST["do"];
$pid = $_POST["id"];
$desc = $_POST["decs"];
$title = $_POST["t"];

if(empty($qty) || empty($d_fee_colombo)){
    echo("error");
}else if( empty($d_fee_other) || empty($desc) || empty($title)){
    echo("error");
}else{

    Database::iud("UPDATE `product` SET `title`='" . $title . "',
`description`='" . $desc . "',
`qty`='" . $qty . "',
`cost_colombo`='" . $d_fee_colombo . "',
`cost_others`='" . $d_fee_other . "' WHERE `id`='" . $pid . "' ");

$length = sizeof($_FILES);
$allowed_img_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

if ($length <= 4) {

    Database::iud("DELETE FROM `product_images` WHERE `product_id` ='" . $pid . "' ");

    for ($x = 0; $x < $length; $x++) {
        if (isset($_FILES["i" . $x])) {

            $img_file = $_FILES["i" . $x];
            $file_type = $img_file["type"];

            if (in_array($file_type, $allowed_img_extention)) {

                $new_img_extention;

                if ($file_type == "image/jpg") {
                    $new_img_extention = ".jpg";
                } else if ($file_type == "image/jpeg") {
                    $new_img_extention = ".jpeg";
                } else if ($file_type == "image/png") {
                    $new_img_extention = ".png";
                } else if ($file_type == "image/svg+xml") {
                    $new_img_extention = ".svg";
                }

                $file_name = "resources//product_img//" . $title . "_" . $x . "_" . uniqid() . $new_img_extention;
                move_uploaded_file($img_file["tmp_name"], $file_name);

                Database::iud("INSERT INTO `product_images` (`p_path`,`product_id`)VALUES('" . $file_name . "','" . $pid . "') ");

            }
        }
    }
    echo("success");
}else{
    echo("Invalid Image Count");
}

}

