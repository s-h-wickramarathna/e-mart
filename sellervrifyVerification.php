<?php
require "connection.php";

if (isset($_POST["c"]) && isset($_POST["n"])) {
    $code = $_POST["c"];
    $nic = $_POST["n"];
    $new_password = $_POST["np"];
    $Conform_password = $_POST["cp"];

    if (empty($new_password) || empty($new_password)) {
        echo ("Enter Passwords ????");
    } else if (strlen($new_password) < 5 && strlen($new_password) < 20) {
        echo ("Password Should Have Between 5-20 Charactors ????");
    } else if ($new_password != $Conform_password) {
        echo ("Password Does Not Matched ????");
    } else {
        $s_rs = Database::Search("SELECT * FROM `seller` WHERE `nic`='".$nic."' AND `s_verification_code`='" . $code . "'");
        $s_num = $s_rs->num_rows;

        if ($s_num != 0) {

            Database::iud("UPDATE `seller` SET `seller_password`='".$Conform_password."' WHERE `nic`='".$nic."' AND `s_verification_code`='" . $code . "'  ");
            echo ("success");
        } else {
            echo ("Invalid Verification Code");
        }
    }
}
