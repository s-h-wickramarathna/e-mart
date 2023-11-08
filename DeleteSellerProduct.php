<?php
session_start();
$s_nic = $_SESSION["seller"]["nic"];

require "connection.php";

if ($_GET["id"]) {
    $pid = $_GET["id"];

    $p_rs = Database::Search("SELECT * FROM `product` WHERE `id`='" . $pid . "' AND `seller_nic`='" . $s_nic . "' ");
    $p_num = $p_rs->num_rows;

    if ($p_num == 1) {
        $p_data = $p_rs->fetch_assoc();

        $p_img_rs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $p_data["id"] . "' ");
        $p_img_data = $p_img_rs->fetch_assoc();


        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `seller_delete_items` (`title`,`description`,`price`,`qty`,`colombo_cost`,`other_cost`,`date_time_added`,`model_has_brand_id`,`colour_clr_id`,`condition_co_id`,`category_ca_id`,`Size_size_id`,`seller_nic`,`product_id`,`img_path`)
        VALUES ('" . $p_data["title"] . "','" . $p_data["description"] . "','" . $p_data["price"] . "','" . $p_data["qty"] . "','" . $p_data["cost_colombo"] . "','" . $p_data["cost_others"] . "','" . $date . "','" . $p_data["model_has_brand_id"] . "','" . $p_data["colour_id"] . "','" . $p_data["condition_id"] . "','" . $p_data["category_ca_id"] . "','" . $p_data["Size_id"] . "','" . $p_data["seller_nic"] . "','" . $pid . "','" . $p_img_data["p_path"] . "') ");

        Database::iud("DELETE FROM `product_images` WHERE `product_id`='" . $p_data["id"] . "' ");
        Database::iud("DELETE FROM `product` WHERE `id`='" . $pid . "' AND `seller_nic`='" . $s_nic . "' ");

        echo ("success");
    }
}
