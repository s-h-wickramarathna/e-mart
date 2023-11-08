<?php

session_start();
require "connection.php";

if (isset($_GET["pid"]) && isset($_GET["q"])) {

    $pid = $_GET["pid"];
    $qty = $_GET["q"];
    $u_email = $_SESSION["user"]["email"];

    $array;

    $order_id = uniqid();

    $product_rs = Database::Search("SELECT * FROM `product` WHERE `id`='" . $pid . "' ");
    $product_data = $product_rs->fetch_assoc();

    $user_rs = Database::Search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $u_email . "' ");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {

        $user_data = $user_rs->fetch_assoc();

        $city_id = $user_data["city_id"];
        $address = $user_data["line_1"] . ", " . $user_data["line_2"];

        $district_rs = Database::Search("SELECT * FROM `city` WHERE `ci_id`='" . $city_id . "' ");
        $district_data = $district_rs->fetch_assoc();

        $district_id = $district_data["distric_id"];
        $delivary = "0";

        if ($district_id == "1") {
            $delivary = $product_data["cost_colombo"];
        } else {
            $delivary = $product_data["cost_others"];
        }

        $item = $product_data["title"];
        $amount = ((int)$product_data["price"] * (int)$qty) + (int)$delivary;

        $fname = $_SESSION["user"]["fname"];
        $lname = $_SESSION["user"]["lname"];
        $mobile = $_SESSION["user"]["mobile"];
        $city = $district_data["ci_name"];

        $array["id"] = $order_id;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["address"] = $address;
        $array["city"] = $city;
        $array["email"] = $u_email;

        echo (json_encode($array));
    } else {
        echo ("1");
    }
} else {
    echo ("2");
}
