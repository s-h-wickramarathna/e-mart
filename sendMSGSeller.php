<?php
session_start();
require "connection.php";

if (isset($_SESSION["user"])) {
    $user_email = $_SESSION["user"]["email"];

    if (isset($_GET["c"]) && isset($_GET["n"])) {
        $content = $_GET["c"];
        $nic = $_GET["n"];

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H-i-s");

        Database::iud("INSERT INTO `massage` (`content`,`send_date_time`,`m_to`,`m_from`,`user_status`,`seller_status`) VALUES
        ('" . $content . "','" . $date . "','" . $user_email . "','" . $nic . "','0','1') ");

echo("success");

    }
}
