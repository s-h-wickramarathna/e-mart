<?php
sleep(2);
require "connection.php";

require "Exception.php";
require "SMTP.php";
require "PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;


$email = $_GET["e"];

if (empty($email)) {
    echo ("Enter Your Email Address ???");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address ???");
} else if (strlen($email) > 100) {
    echo ("Email must have less than 100 characters ???");
} else {

    $rs = Database::Search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
    $n = $rs->num_rows;
    
    if($n == 1){

        $Vcode = uniqid();

        Database::iud("UPDATE `user` SET `verification_id`='".$Vcode."' WHERE `email`='".$email."'");

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
        $mail->Subject = 'Emart Forgot Password Verification Code';
        $bodyContent = '<h1 style="font-family:Arial;">Your Code Is :- '.$Vcode.'</h1>';
        $mail->Body    = $bodyContent;

        if(!$mail->send()){
            echo ("Verification code sending failed ???");
        }else{
            echo("Verification Code Successfully Send Your Email");
        }


    }else{
        echo("Invalid Email Address");
    }
}

?>
<!-- dvshqaqhhyagyqqk -->