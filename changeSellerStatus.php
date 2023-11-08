<?php

require "connection.php";

if(isset($_GET["id"])){
    $invioce_id = $_GET["id"];

    $invioce_rs = Database::Search("SELECT * FROM `invoice` WHERE `invoice_id`='".$invioce_id."' ");
    $invioce_data = $invioce_rs->fetch_assoc();

    $status_id = $invioce_data["status"];

    $new_status = 0;

    if($status_id == 0){
        Database::iud("UPDATE `invoice` SET `status`='1' WHERE `invoice_id` = '".$invioce_id."' ");
        $new_status = 1;

    }else if($status_id == 1){
        Database::iud("UPDATE `invoice` SET `status`='2' WHERE `invoice_id` = '".$invioce_id."' ");
        $new_status = 2;

    }else if($status_id == 2){
        Database::iud("UPDATE `invoice` SET `status`='3' WHERE `invoice_id` = '".$invioce_id."' ");
        $new_status = 3;

    }else if($status_id == 3){
        Database::iud("UPDATE `invoice` SET `status`='4' WHERE `invoice_id` = '".$invioce_id."' ");
        $new_status = 4;

    }

    echo($new_status);

}


?>