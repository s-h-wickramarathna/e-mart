<?php
sleep(2);
require "connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$password = $_POST["p"];
$mobile = $_POST["m"];
$gender = $_POST["g"];

if (empty($fname)) {
    echo ("Enter Your First Name ???");
} else if (strlen($fname) > 50) {
    echo ("First Name must have less than 50 characters ???");
} else if (empty($lname)) {
    echo ("Enter Your Last Name ???");
} else if (strlen($lname) > 50) {
    echo ("Last Name must have less than 50 characters ???");
} else if (empty($email)) {
    echo ("Enter Your Email Address ???");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address ???");
} else if (strlen($email) > 100) {
    echo ("Email must have less than 100 characters ???");
} else if (empty($password)) {
    echo ("Enter Your Password ???");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Password must be between 5 - 20 charcters ???");
} else if (empty($mobile)) {
    echo ("Enter Your Mobile Number ???");
}else if(strlen($mobile)!= 10){
    echo("Mobile Number must have 10 characters");
} else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {
    echo ("Invalid Mobile Number ???");
}else if($gender == 0){
    echo("Select Your Gender ???");
}else{

    $rs = Database::Search("SELECT * FROM `user` WHERE `email`='".$email."' AND `mobile`='".$mobile."' ");
    $n = $rs->num_rows; 
    
    if($n == 0){

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");
        
        Database::iud("INSERT INTO `user`
        (`fname`,`lname`,`email`,`password`,`mobile`,`gender_id`,`joined_date`,`status`) VALUES
        ('".$fname."','".$lname."','".$email."','".$password."','".$mobile."','".$gender."','".$date."','1')");

        echo("Success");

    }else{
        echo("Your Details Are Exist");
    }
}

