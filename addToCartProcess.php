<?php

session_start();
require "connection.php";

if (isset($_SESSION["user"]) && isset($_GET["i"])) {
    $user_email = $_SESSION["user"]["email"];
    $pid = $_GET["i"];



    $cart_rs = Database::Search("SELECT * FROM `cart` WHERE `product_id`='" . $pid . "' AND `user_email`='$user_email' ");
    $cart_num = $cart_rs->num_rows;

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H-i-s");

    if ($cart_num == 0) {
        Database::iud("INSERT INTO `cart` (`product_id`,`user_email`,`cart_datetime`,`cart_qty`,`veiw_status`) VALUES
        ('" . $pid . "','" . $user_email . "','" . $date . "','1','0') ");

        echo ("Successfully Insert From Cart");
    } else {
        $cart_data = $cart_rs->fetch_assoc();
        $curr_qty = $cart_data["cart_qty"];

        $product_rs = Database::Search("SELECT * FROM `product` WHERE `id`='$pid' ");
        $product_data = $product_rs->fetch_assoc();

        if ($curr_qty == $product_data["qty"]) {
            echo ("Allready Applied Maximum Quentity");
        } else {
            $new_qty = (int)$curr_qty + 1;

            Database::iud("UPDATE `cart` SET `cart_qty`='" . $new_qty . "', `cart_datetime`='" . $date . "', `veiw_status`='0' WHERE `product_id`='".$pid."' ");

            echo ("Successfully Update This Product Quentity");
        }
    }
} else {
    echo ("Login First");
}
