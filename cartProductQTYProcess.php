<?php
session_start();
$user_email = $_SESSION["user"]["email"];
require "connection.php";

if (isset($_POST["s"])) {

    $status = $_POST["s"];

    if ($status == 1) {
        if (isset($_POST["i"]) && isset($_POST["q"])) {
            $product_id = $_POST["i"];
            $cart_qty = $_POST["q"];

            $p_rs = Database::Search("SELECT * FROM `product` WHERE `id`='" . $product_id . "' ");
            $p_data = $p_rs->fetch_assoc();

            if ($cart_qty >= $p_data["qty"]) {
                echo ($cart_qty);
                
            } else if ($cart_qty < $p_data) {

                $new_p_qty =  $cart_qty + 1;

                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d H-i-s");

                Database::iud("UPDATE `cart` SET `cart_qty`='" . $new_p_qty . "', `cart_datetime`='" . $date . "' WHERE `product_id`='" . $product_id . "' ");
                echo ($new_p_qty);
            }
        }
    } else if ($status == 2) {
        if (isset($_POST["id"]) && isset($_POST["qty"])) {
            $pid = $_POST["id"];
            $cartm_qty = $_POST["qty"];

            if ($cartm_qty <= 1) {
                echo ($cartm_qty);

            }else if($cartm_qty > 1){
                $new_mp_qty =  $cartm_qty - 1;

                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date2 = $d->format("Y-m-d H-i-s");

                Database::iud("UPDATE `cart` SET `cart_qty`='" . $new_mp_qty . "', `cart_datetime`='" . $date2 . "' WHERE `product_id`='" . $pid . "' ");
                echo ($new_mp_qty);
            }
        }
    }
}
