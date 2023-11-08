<?php
session_start();
$s_nic = $_SESSION["seller"]["nic"];
require "connection.php";

$shop_name = $_POST["s"];

if (isset($_FILES["sellerimage"])) {
    $image = $_FILES["sellerimage"];

    $allowed_img_extension = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
    $file_ex = $image["type"];


    if (in_array($file_ex, $allowed_img_extension)) {

        $new_file_extention;

        if ($file_ex == "image/jpg") {
            $new_file_extention = ".jpg";
        } else if ($file_ex == "image/jpeg") {
            $new_file_extention = ".jpeg";
        } else if ($file_ex == "image/png") {
            $new_file_extention = ".png";
        } else if ($file_ex == "image/svg+xml") {
            $new_file_extention = ".svg";
        }


        $file_name = "resources//shop_images//" . $_SESSION["seller"]["nic"] . "_" . uniqid() . $new_file_extention;
        move_uploaded_file($image["tmp_name"], $file_name);

        $shop_img_rs = Database::Search("SELECT * FROM `shop_image` WHERE `seller_nic`='" . $s_nic . "' ");
        $shop_img_num = $shop_img_rs->num_rows;

        if ($shop_img_num == 1) {
            Database::iud("UPDATE `shop_image` SET `shop_img_path`='" . $file_name . "' WHERE `seller_nic`='" . $s_nic . "'");
        } else {
            Database::iud("INSERT INTO `shop_image` (`shop_img_path`,`seller_nic`) VALUES ('" . $file_name . "','" . $s_nic . "') ");
        }
    } else {
        echo ("Invalid Image Type");
    }
}

Database::iud("UPDATE `seller` SET `shop_name`='" . $shop_name . "' WHERE `nic`='" . $s_nic . "' ");

echo ("Success");
