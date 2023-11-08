<?php
sleep(2);
require "connection.php";

$password = $_POST["newp"];
$conformpassword = $_POST["Cnp"];
$email = $_POST["e"];

if (empty($password)) {
    echo ("Enter new Password ???");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Password must be between 5 - 20 charcters ???");
} else if (empty($conformpassword)) {
    echo ("Conform your Password ???");
} else if (strlen($conformpassword) < 5 || strlen($conformpassword) > 20) {
    echo ("Password must be between 5 - 20 charcters ???");
} else if ($password != $conformpassword) {
    echo ("Password does not matched ???");
} else {
    Database::iud("UPDATE `user` SET `password`= '" . $conformpassword . "' WHERE `email`='" . $email . "'");
    echo ("success");
}
?>