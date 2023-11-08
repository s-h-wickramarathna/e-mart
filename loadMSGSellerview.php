<?php
session_start();
require "connection.php";

if (isset($_GET["e"])) {
    $email  = $_GET["e"];
    $seller_nic = $_SESSION["seller"]["nic"];

    Database::iud("UPDATE `massage` SET `seller_status` ='0' WHERE `m_to`='".$email."' AND `m_from`='".$seller_nic."' ");

    $msg_rs = Database::Search("SELECT * FROM `massage` WHERE `m_from`='" . $seller_nic . "' OR `m_to`='".$seller_nic."' ");
    $msg_num = $msg_rs->num_rows;

?>
    <!-- contact_massages -->
    <div class="row">

        <div class="col-12 mt-1 mb-2 border-bottom shadow">
            <div class="row">
                <div class="col-4 col-md-3 col-lg-2 mb-1 text-center">
                    <?php
                    
                    $img_path = "resources/noImage.jpg";

                    $user_img = Database::Search("SELECT * FROM `profile_image` WHERE `user_email`='".$email."' ");
                    $user_img_num = $user_img->num_rows;

                    if($user_img_num != 0){
                        $user_img_data = $user_img->fetch_assoc();
                        $img_path = $user_img_data["user_profile_path"];
                    }

                    ?>
                    <img src="<?php echo($img_path) ?>" class="rounded-circle me-3" height="60px" style="background-position: center;">
                </div>
                <div class="col-8">
                    <?php
                    $user_rs = Database::Search("SELECT * FROM `user` WHERE `email`='" . $email . "' ");
                    $user_data = $user_rs->fetch_assoc();
                    ?>
                    <p class="m-0 mt-2 fw-bold"><?php echo ($user_data["fname"]." ".$user_data["lname"]) ?></p>
                    <p class="m-0">user ....</p>
                </div>
            </div>
        </div>

        <div class="col-12" style="height: 60vh;">
            <div class="row overflow-auto">

                <?php

                for ($x = 0; $x < $msg_num; $x++) {
                    $msg_data = $msg_rs->fetch_assoc();

                    if ($msg_data["m_to"] == $seller_nic && $msg_data["m_from"] == $email  ) {
                ?>
                        <!-- to -->
                        <div class="col-12 m-0">
                            <div class="row justify-content-end">
                                <div class="col-6">
                                    <div class="row justify-content-end p-2">
                                        <div class="w-auto bg-success rounded-2">
                                            <p class="m-0 text-white"><?php echo ($msg_data["content"]) ?></p>
                                        </div>
                                        <div class="col-12 text-end">
                                            <p class="m-0 fw-bold text-black-50"><?php echo ($msg_data["send_date_time"]) ?> <span class="text-dark">Me</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- to -->
                    <?php
                    } else if ($msg_data["m_from"] == $seller_nic && $msg_data["m_to"] == $email) {
                    ?>

                        <!-- from -->
                        <div class="col-12">
                            <div class="row justify-content-start">
                                <div class="col-6">
                                    <div class="row justify-content-start p-2">
                                        <div class="w-auto bg-warning rounded-2">
                                            <p class="m-0 text-white"><?php echo ($msg_data["content"]) ?></p>
                                        </div>
                                        <div class="col-12 text-start">
                                            <p class="m-0 fw-bold text-black-50"> <span class="text-dark"><?php echo ($user_data["fname"]) ?> </span><?php echo ($msg_data["send_date_time"]) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- from -->

                    <?php
                    }
                    ?>
                <?php
                }

                ?>



            </div>
        </div>

        <div class="col-12 border-top shadow">
            <div class="row">
                <div class="input-group mt-2 mb-2">
                    <input type="text" class="form-control" placeholder="Type Massage ...." id="sendMSGS<?php echo($email)?>">
                    <button class="btn btn-primary" type="button" onclick="senduserMSG('<?php echo($email) ?>');"><i class="bi bi-send-fill"></i></button>
                </div>
            </div>
        </div>

    </div>
    <!-- contact_massages -->
<?php



}


?>