<?php
require "connection.php";
session_start(); 

$email = $_POST["e"];
$password = $_POST["p"];
$rememberMe = $_POST["rm"];

if (empty($email)) {
    echo ("Enter Your Email ???");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address ???");
} else if (strlen($email) > 100) {
    echo ("Email must have less than 100 characters ???");
} else if (empty($password)) {
    echo ("Enter Your Password ???");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Password must be between 5 - 20 charcters ???");
} else {

    $rs = Database::Search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `password` = '" . $password . "' ");
    $n = $rs->num_rows;

    if ($n == 1) {
        $data = $rs->fetch_assoc();

        if ($data["status"] == 2) {
            echo ("admin_deactivated");

        } else if ($data["status"] == 1) {
            $_SESSION["user"] = $data;

            if ($rememberMe == "true") {
                setcookie("email", $email, time() + (60 * 60 * 360));
                setcookie("password", $password, time() + (60 * 60 * 360));
            } else {
                setcookie("email", "", -1);
                setcookie("password", "", -1);
            }

            echo ("Success");
        }
    } else {
        echo ("Invalid Email Address or Password");
    }
}
