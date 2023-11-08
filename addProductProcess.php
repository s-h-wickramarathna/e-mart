<?php
session_start();
$seller_nic = $_SESSION["seller"]["nic"];

require "connection.php";

if (isset($_POST["size"])) {
    $category = $_POST["ca"];
    $brand = $_POST["b"];
    $model = $_POST["m"];
    $price = $_POST["price"];
    $condition = $_POST["con"];
    $colour = $_POST["clur"];
    $quentity = $_POST["qty"];
    $colombo_cost = $_POST["dwc"];
    $other_cost = $_POST["doc"];
    $desc = $_POST["desc"];
    $title = $_POST["title"];
    $p_size = $_POST["size"];


    if (empty($category)) {
        echo ("empty");
    } else if (empty($brand)) {
        echo ("empty");
    } else if (empty($model)) {
        echo ("empty");
    } else if (empty($price)) {
        echo ("empty");
    } else if (empty($p_size)) {
        echo ("empty");
    } else if (empty($condition)) {
        echo ("empty");
    } else if (empty($colour)) {
        echo ("empty");
    } else if (empty($quentity)) {
        echo ("empty");
    } else if (empty($colombo_cost)) {
        echo ("empty");
    } else if (empty($other_cost)) {
        echo ("empty");
    } else if (empty($desc)) {
        echo ("empty");
    } else {

        $model_has_brand_rs = Database::Search("SELECT * FROM `model_has_brand` WHERE `model_id`='" . $model . "' AND `brand_id`='" . $brand . "' ");
        $model_has_brand_data = $model_has_brand_rs->fetch_assoc();

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H-i-s");

        $status = 1;

        Database::iud("INSERT INTO `product` 
    (`model_has_brand_id`,`colour_id`,`condition_id`,`title`,`description`,`price`,`qty`,`cost_colombo`,`cost_others`,`category_ca_id`,`Size_id`,`seller_nic`,`status_s_id`,`date_time`) VALUES
    ('" . $model_has_brand_data["id"] . "','" . $colour . "','" . $condition . "','" . $title . "','" . $desc . "','" . $price . "','" . $quentity . "','" . $colombo_cost . "','" . $other_cost . "','" . $category . "','" . $p_size . "','" . $seller_nic . "','1','" . $date . "') ");

        $product_id = Database::$connection->insert_id;

        $length = sizeof($_FILES);

        if ($length <= 4 && $length > 0) {

            $allowed_img_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

            for ($x = 0; $x < $length; $x++) {

                if (isset($_FILES["img" . $x])) {

                    $img_file = $_FILES["img" . $x];
                    $file_extention = $img_file["type"];

                    if (in_array($file_extention, $allowed_img_extention)) {

                        $new_img_extension;

                        if ($file_extention == "image/jpg") {
                            $new_img_extension = ".jpg";
                        } else if ($file_extention == "image/jpeg") {
                            $new_img_extension = ".jpeg";
                        } else if ($file_extention == "image/png") {
                            $new_img_extension = ".png";
                        } else if ($file_extention == "image/svg+xml") {
                            $new_img_extension = ".svg";
                        }

                        $file_name = "resources//product_img//" . $title . "_" . $x . "_" . uniqid() . $new_img_extension;
                        move_uploaded_file($img_file["tmp_name"], $file_name);

                        Database::iud(" INSERT INTO `product_images` (`p_path`,`product_id`) VALUES ('" . $file_name . "','" . $product_id . "') ");
                    }
                }
            }
            echo("success");
        }else{
            echo("invalid Image Count");
        }
    }
} else {

    $category = $_POST["ca"];
    $brand = $_POST["b"];
    $model = $_POST["m"];
    $price = $_POST["price"];
    $condition = $_POST["con"];
    $colour = $_POST["clur"];
    $quentity = $_POST["qty"];
    $colombo_cost = $_POST["dwc"];
    $other_cost = $_POST["doc"];
    $desc = $_POST["desc"];
    $title = $_POST["title"];

    if (empty($category)) {
        echo ("empty");
    } else if (empty($brand)) {
        echo ("empty");
    } else if (empty($model)) {
        echo ("empty");
    } else if (empty($price)) {
        echo ("empty");
    } else if (empty($condition)) {
        echo ("empty");
    } else if (empty($colour)) {
        echo ("empty");
    } else if (empty($quentity)) {
        echo ("empty");
    } else if (empty($colombo_cost)) {
        echo ("empty");
    } else if (empty($other_cost)) {
        echo ("empty");
    } else if (empty($desc)) {
        echo ("empty");
    } else {

        $model_has_brand_rs = Database::Search("SELECT * FROM `model_has_brand` WHERE `model_id`='" . $model . "' AND `brand_id`='" . $brand . "' ");
        $model_has_brand_data = $model_has_brand_rs->fetch_assoc();

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H-i-s");

        $status = 1;

        Database::iud("INSERT INTO `product` 
          (`model_has_brand_id`,`colour_id`,`condition_id`,`title`,`description`,`price`,`qty`,`cost_colombo`,`cost_others`,`category_ca_id`,`Size_id`,`seller_nic`,`status_s_id`,`date_time`,`admin_status`) VALUES
          ('" . $model_has_brand_data["id"] . "','" . $colour . "','" . $condition . "','" . $title . "','" . $desc . "','" . $price . "','" . $quentity . "','" . $colombo_cost . "','" . $other_cost . "','" . $category . "','1','" . $seller_nic . "','1','" . $date . "','1') ");

        $product_id = Database::$connection->insert_id;

        $length = sizeof($_FILES);

        if ($length <= 4 && $length > 0) {

            $allowed_img_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

            for ($x = 0; $x < $length; $x++) {

                if (isset($_FILES["img" . $x])) {

                    $img_file = $_FILES["img" . $x];
                    $file_extention = $img_file["type"];

                    if (in_array($file_extention, $allowed_img_extention)) {

                        $new_img_extension;

                        if ($file_extention == "image/jpg") {
                            $new_img_extension = ".jpg";
                        } else if ($file_extention == "image/jpeg") {
                            $new_img_extension = ".jpeg";
                        } else if ($file_extention == "image/png") {
                            $new_img_extension = ".png";
                        } else if ($file_extention == "image/svg+xml") {
                            $new_img_extension = ".svg";
                        }

                        $file_name = "resources//product_img//" . $title . "_" . $x . "_" . uniqid() . $new_img_extension;
                        move_uploaded_file($img_file["tmp_name"], $file_name);

                        Database::iud(" INSERT INTO `product_images` (`p_path`,`product_id`) VALUES ('" . $file_name . "','" . $product_id . "') ");
                    }
                }
            }
            echo("success");
        }else{
            echo("invalid Image Count");
        }
    }
}
