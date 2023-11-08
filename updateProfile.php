<?php
session_start();

if (isset($_SESSION["user"])) {
   $email = $_SESSION["user"]["email"];

   require "connection.php";

   $fname = $_POST["f"];
   $lname = $_POST["l"];
   $mobile = $_POST["m"];
   $line1 = $_POST["l1"];
   $line2 = $_POST["l2"];
   $city = $_POST["city"];
   $pcode = $_POST["pcode"];

   if (empty($line1)) {
      echo ("error");
   } else if (empty($city)) {
      echo ("error");
   } else if (empty($pcode)) {
      echo ("error");
   } else {


      if (isset($_FILES["pimg"])) {
         $image = $_FILES["pimg"];

         $allowed_img_extension = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
         $file_ex = $image["type"];


         if (in_array($file_ex, $allowed_img_extension)) {

            $new_file_extention;

            if ($file_ex == "image/jpg") {
               $new_file_extention = ".jpg";
            } else if ($file_ex == "image/jpeg") {
               $new_file_extention = ".jpeg";
            } else if ($file_ex == "image/png") {
               $new_file_extention = ".png";
            } else if ($file_ex == "image/svg+xml") {
               $new_file_extention = ".svg";
            }


            $file_name = "resources//user_profile_img//" . $_SESSION["user"]["fname"] . "_" . uniqid() . $new_file_extention;
            move_uploaded_file($image["tmp_name"], $file_name);

            $profile_img_rs = Database::Search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "' ");
            $profile_img_num = $profile_img_rs->num_rows;

            if ($profile_img_num == 1) {
               Database::iud("UPDATE `profile_image` SET `user_profile_path`='" . $file_name . "' WHERE `user_email`='" . $email . "'");
            } else {
               Database::iud("INSERT INTO `profile_image` (`user_profile_path`,`user_email`) VALUES ('" . $file_name . "','" . $email . "') ");
            }
         } else {
            echo ("Invalid Image Type");
         }
      }

      $user_rs = Database::Search("SELECT * FROM `user` WHERE `email` = '" . $email . "'");
      $user_data = $user_rs->num_rows;

      if ($user_data == 1) {
         Database::Search(" UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`mobile`='" . $mobile . "' ");
      } else {
         echo ("Sign Up First");
      }

      $address_rs = Database::Search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $email . "'");
      $address_data = $address_rs->num_rows;

      if ($address_data == 1) {
         Database::iud("UPDATE `user_has_address` SET `city_id`='" . $city . "' WHERE `user_email`='" . $email . "' ");
         Database::iud("UPDATE `user_has_address` SET `line_1`='" . $line1 . "' WHERE `user_email`='" . $email . "' ");
         Database::iud("UPDATE `user_has_address` SET `line_2`='" . $line2 . "' WHERE `user_email`='" . $email . "' ");
         Database::iud("UPDATE `user_has_address` SET `postal_code`='" . $pcode . "' WHERE `user_email`='" . $email . "' ");
      } else {
         Database::iud("INSERT INTO `user_has_address`(`user_email`,`city_id`,`line_1`,`line_2`,`postal_code`) VALUES
   ('" . $email . "','" . $city . "','" . $line1 . "','" . $line1 . "','" . $pcode . "')");
      }

      echo ("Success");
   }
}
