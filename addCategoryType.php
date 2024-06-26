<?php
require "connection.php";

if (isset($_POST["ct"]) && !empty($_POST["ct"])) {
    $txt = $_POST["ct"];
    $ct_rs = Database::Search("SELECT * FROM `category_type` WHERE `type_of_category` LIKE '%" . $txt . "%'");
    $ct_num = $ct_rs->num_rows;

    if ($ct_num == 0) {
        Database::iud("INSERT INTO `category_type`(`type_of_category`) VALUES ('" . $txt . "')");
        echo ("1");
    } else {
        echo ("2");
    }
} else {
    echo ("Please Enter Category Type");
}
