<?php
require "connection.php";

require "Exception.php";
require "SMTP.php";
require "PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["n"])){
    $nic = $_POST["n"];

    $seller_rs = Database::Search("SELECT * FROM `seller` WHERE `nic`='".$nic."' ");
    $seller_num = $seller_rs->num_rows;

    if($seller_num == 0){
        echo("invalid NIC No ???");
    }else{

        $seller_data = $seller_rs->fetch_assoc();
        $email = $seller_data["user_email"];
        $code = uniqid(); 
        Database::iud("UPDATE `seller` SET `s_verification_code`='".$code."' ");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sanchithaheashan655@gmail.com';
        $mail->Password = 'dvshqaqhhyagyqqk';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('sanchithaheashan655@gmail.com', 'Emart');
        $mail->addReplyTo('sanchithaheashan655@gmail.com', 'Emart');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Emart Forgot Seller Password Verification Code';
        $bodyContent = '<h1 style="font-family:Arial;">Your Code Is :- '.$code.'</h1>';
        $mail->Body    = $bodyContent;

        if(!$mail->send()){
            echo ("Verification code sending failed ???");
        }else{
            echo("Verification Code Successfully Send Your User Email");
        }

    }

}
