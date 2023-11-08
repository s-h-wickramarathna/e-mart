<?php

session_start();
$user_email = $_SESSION["user"]["email"];
require "connection.php";

    $new_seller_password = $_POST["snp"];
    $conform_seller_password = $_POST["scp"];
    $seller_NIC = $_POST["snic"];
    $seller_shop_name = $_POST["sShopn"];

 if (empty($new_seller_password)) {
        echo ("Enter New Seller Password ???");
    } else if (strlen($new_seller_password) < 5 || strlen($new_seller_password) > 20) {
        echo ("Password must have between 5 - 20 charactors ???");
    } else if (empty($conform_seller_password)) {
        echo ("Enter Your Conform Seller Password ???");
    } else if ($conform_seller_password != $new_seller_password) {
        echo ("Password Does Not Matched ???");
    } else if (empty($seller_NIC)) {
        echo ("Enter Your National ID ???");
    } else if (strlen($seller_NIC) > 13) {
        echo ("Invalid National ID ???");
    } else if (empty($seller_shop_name)) {
        echo ("Enter Your Shop Name ???");
    } else if (strlen($seller_shop_name) < 5 || strlen($seller_shop_name) > 20) {
        echo ("Shop Name Must Have between 5 - 20 Charactors ???");
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        $length = sizeof($_FILES);

        if ($length == 2) {

            Database::iud("INSERT INTO `seller` (`nic`,`user_email`,`account_create_datetime`,`shop_name`,`seller_password`,`s_status`,`s_verification_code`)VALUES
            ('" . $seller_NIC . "','" . $user_email . "','" . $date . "','" . $seller_shop_name . "','" . $new_seller_password . "','1','0')");

            $allowd_img_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");


            for ($x = 0; $x < $length; $x++) {

                if (isset($_FILES["img" . $x])) {
                    $img_file = $_FILES["img" . $x];
                    $file_extention = $img_file["type"];

                    if (in_array($file_extention, $allowd_img_extention)) {
                        $new_img_extension;

                        if ($file_extention == "image/jpg") {
                            $new_img_extension = ".jpg";
                        } else if ($file_extention == "image/jpeg") {
                            $new_img_extension = ".jpeg";
                        } else if ($file_extention == "image/png") {
                            $new_img_extension = ".png";
                        } else if ($file_extention == "image/svg+xml") {
                            $new_img_extension = ".svg";
                        }

                        $file_name = "resources//Seller_nic_images//" . $seller_shop_name . "_" . uniqid() . $new_img_extension;

                        move_uploaded_file($img_file["tmp_name"], $file_name);

                        Database::iud("INSERT INTO `nic_images` (`nic_path`,`seller_nic`) VALUES ('" . $file_name . "','" . $seller_NIC . "')");
                    } else {
                        echo ("Invalid Image Type ???");
                    }
                }
            }
            echo ("Admin will Cornform Your Seller Email Account Request");
        } else {
            echo ("Invalid Image Count ???");
        }
    }
