<?php
session_start();
require "connection.php";

if (isset($_SESSION["seller"])) {
    $seller_mic = $_SESSION["seller"]["nic"];

    if (isset($_GET["c"]) && isset($_GET["e"])) {
        $content = $_GET["c"];
        $email = $_GET["e"];

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H-i-s");

        Database::iud("INSERT INTO `massage` (`content`,`send_date_time`,`m_to`,`m_from`,`user_status`,`seller_status`) VALUES
        ('" . $content . "','" . $date . "','" . $seller_mic . "','" . $email . "','1','0') ");

echo("success");

    }
}
