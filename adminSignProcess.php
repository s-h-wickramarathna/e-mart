<?php
require "connection.php";

require "Exception.php";
require "SMTP.php";
require "PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["ae"]) && isset($_POST["ap"])) {

    $admin_email = $_POST["ae"];
    $admin_password = $_POST["ap"];

    $admin_rs = Database::Search("SELECT * FROM `admin` WHERE `email`='" . $admin_email . "' AND `admn_password`='" . $admin_password . "' ");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num == 1) {

        $code = uniqid();
        Database::iud("UPDATE `admin` SET `admin_verification_code`='" . $code . "' WHERE `email`='" . $admin_email . "' AND `admn_password`='" . $admin_password . "' ");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sanchithaheashan655@gmail.com';
        $mail->Password = 'pgyf sffi stti ppjw';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('sanchithaheashan655@gmail.com', 'Emart');
        $mail->addReplyTo('sanchithaheashan655@gmail.com', 'Emart');
        $mail->addAddress($admin_email);
        $mail->isHTML(true);
        $mail->Subject = 'Emart Admin Verification Code';
        $bodyContent = '<h1 style="font-family:Arial;">Admin Verification Code Is :- ' . $code . '</h1>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo ("Verification code sending failed ???");
        } else {
            echo ("Verification Code Successfully Send Your Email");
        }
    } else {
        echo ("Invalid Email Or Password ???");
    }
}
// pgyf sffi stti ppjw