<?php
require "connection.php";

if (isset($_POST["b"]) && !empty($_POST["b"])) {
    $txt = $_POST["b"];
    $ct_rs = Database::Search("SELECT * FROM `brand` WHERE `b_name` LIKE '%" . $txt . "%'");
    $ct_num = $ct_rs->num_rows;

    if ($ct_num == 0) {
        Database::iud("INSERT INTO `brand`(`b_name`) VALUES ('" . $txt . "')");
        echo ("1");
    } else {
        echo ("2");
    }
} else {
    echo ("Please Enter Brand");
}