<?php

session_start();
require "connection.php";

if (isset($_POST["o"]) && isset($_POST["a"])&& isset($_POST["s"])) {
    # code...

    $u_email = $_SESSION["user"]["email"];

    $array;
    $order_id = $_POST["o"];
    $amount = $_POST["a"];
    $shipping = $_POST["s"];


    $user_rs = Database::Search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $u_email . "' ");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {

        $cart_rs = Database::Search("SELECT * FROM `cart` WHERE `user_email`='" . $u_email . "' ");
        $cart_num = $cart_rs->num_rows;

        if ($cart_num != 0) {
            for ($i = 0; $i < $cart_num; $i++) {
                $cart_data = $cart_rs->fetch_assoc();

                $cart_pid = $cart_data["product_id"];
                $cart_qty = $cart_data["cart_qty"];

                $product_rs = Database::Search("SELECT * FROM `product` WHERE `id`='" . $cart_pid . "' ");
                $product_data = $product_rs->fetch_assoc();

                $current_qty = $product_data["qty"];
                $new_qty = (int)$current_qty - (int)$cart_qty;
                Database::iud(" UPDATE `product` SET `qty`='" . $new_qty . "' WHERE `id`='" . $cart_pid . "' ");

                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d H:i:s");

                Database::iud("INSERT INTO `invoice`
            (`order_id`,`total`,`buy_qty`,`status`,`product_id`,`user_email`,`date_time`,`Delete_Number`,`shipping`) VALUES 
            ('" . $order_id . "','" . $amount . "','" . (int)$cart_qty . "','0','" . $cart_pid . "','" . $u_email . "','" . $date . "','1','".$shipping."')");

            }

            Database::iud("DELETE FROM `cart` WHERE `user_email`='" . $u_email . "' ");
        }
        echo (1);
    } else {
        echo ("Please Update Your Profile Details");
    }
}
