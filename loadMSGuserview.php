<?php
session_start();
require "connection.php";

if (isset($_GET["n"])) {
    $nic  = $_GET["n"];
    $user_email = $_SESSION["user"]["email"];

    Database::iud("UPDATE `massage` SET `user_status` ='0' WHERE `m_to`='".$nic."' AND `m_from`='".$user_email."' ");

    $msg_rs = Database::Search("SELECT * FROM `massage` WHERE `m_from`='" . $nic . "' OR `m_to`='" . $nic . "' ");
    $msg_num = $msg_rs->num_rows;

?>
    <!-- contact_massages -->
    <div class="row">

        <div class="col-12 mt-1 mb-3 border-bottom shadow">
            <div class="row">
                <div class="col-4 col-md-3 mb-1 col-lg-2 text-center">
                    <?php
                    $shop_img = "resources/noImage.jpg";

                    $shop_img_rs = Database::Search("SELECT * FROM `shop_image` WHERE `seller_nic`='" . $nic. "' ");
                    $shop_img_num = $shop_img_rs->num_rows;

                    if ($shop_img_num != 0) {
                        $shop_img_data = $shop_img_rs->fetch_assoc();
                        $shop_img = $shop_img_data["shop_img_path"];
                    }

                    ?>
                    <img src="<?php echo($shop_img) ?>" class="rounded-circle me-3" height="60px" style="background-position: center;">
                </div>
                <div class="col-8">
                    <?php
                    $seller_rs = Database::Search("SELECT * FROM `seller` WHERE `nic`='" . $nic . "' ");
                    $seller_data = $seller_rs->fetch_assoc();
                    ?>
                    <p class="m-0 mt-2 fw-bold"><?php echo ($seller_data["shop_name"]) ?></p>
                    <p class="m-0">Seller Account .... </p>
                </div>
            </div>
        </div>

        <div class="col-12" style="height: 60vh;">
            <div class="row overflow-auto">

                <?php

                for ($x = 0; $x < $msg_num; $x++) {
                    $msg_data = $msg_rs->fetch_assoc();

                    if ($msg_data["m_to"] == $user_email && $msg_data["m_from"] == $nic) {
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
                    } else if ($msg_data["m_from"] == $user_email && $msg_data["m_to"] == $nic) {
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
                                            <p class="m-0 fw-bold text-black-50"> <span class="text-dark"><?php echo ($seller_data["shop_name"]) ?> </span><?php echo ($msg_data["send_date_time"]) ?></p>
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
                    <input type="text" class="form-control" placeholder="Type Massage ...." id="sendMSGS<?php echo ($nic) ?>">
                    <button class="btn btn-primary" type="button" onclick="sendSellerMSG(<?php echo ($nic) ?>);"><i class="bi bi-send-fill"></i></button>
                </div>
            </div>
        </div>

    </div>
    <!-- contact_massages -->
<?php



}


?>