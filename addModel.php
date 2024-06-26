<?php
require "connection.php";

if (isset($_POST["m"]) && !empty($_POST["m"])) {
    $txt = $_POST["m"];
    $ct_rs = Database::Search("SELECT * FROM `model` WHERE `m_name` LIKE '%" . $txt . "%'");
    $ct_num = $ct_rs->num_rows;

    if ($ct_num == 0) {
        Database::iud("INSERT INTO `model`(`m_name`) VALUES ('" . $txt . "')");
        echo ("1");
    } else {
        echo ("2");
    }
} else {
    echo ("Please Enter model");
}