<?php

session_start();

require "Exception.php";
require "SMTP.php";
require "PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["c"])){
    $content = $_POST["c"];
    $email = $_SESSION["user"]["email"];

    
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sanchithaheashan655@gmail.com';
            $mail->Password = 'opdnhzvugdqurzky';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('sanchithaheashan655@gmail.com', 'Emart');
            $mail->addReplyTo('sanchithaheashan655@gmail.com', 'Emart');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Emart Your Purchased Invoice';
            $bodyContent = $content;
            $mail->Body = $bodyContent;
    
            if(!$mail->send()){
                echo ("Email Sending failed");
            }else{
                echo("Invoice Successfully Send Your Email");
            }


}


// app Key Password = opdnhzvugdqurzky


?>


