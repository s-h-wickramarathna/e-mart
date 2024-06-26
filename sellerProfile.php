<?php

session_start();
$s_nic = $_SESSION["seller"]["nic"];

require "connection.php";

$seller_rs = Database::Search("SELECT * FROM `seller` WHERE `nic`='" . $s_nic . "' ");
$seller_data = $seller_rs->fetch_assoc();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emart Seller Store</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="aos.css">
</head>

<body class="sellerProfilebg">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="row">

                    <div class="col-12 col-lg-6 mt-2">
                        <div class="row justify-content-center">

                            <div class="col-10 my-4 bg-light shadow ">
                                <div class="row">

                                    <div class="col-12 text-center mt-2 mt-lg-5">
                                        <?php

                                        $shop_img_rs = Database::Search("SELECT * FROM `shop_image` WHERE `seller_nic`='" . $s_nic . "' ");
                                        $shop_img_num = $shop_img_rs->num_rows;

                                        if ($shop_img_num == 1) {
                                            $shop_img_data = $shop_img_rs->fetch_assoc();
                                        ?>
                                            <img src="<?php echo ($shop_img_data["shop_img_path"]) ?>" id="viewImg" class="rounded-5 shadow mt-5 mb-3" height="250px" alt="" srcset="">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="resources/noImage.jpg" id="viewImg" class="rounded-5 shadow mt-5 mb-3" height="250px" alt="" srcset="">
                                        <?php
                                        }

                                        ?>

                                    </div>

                                    <div class="col-12 text-center mt-2">
                                        <p class="m-0 fs-6 fw-bold"><?php echo ($seller_data["shop_name"]) ?></p>
                                    </div>
                                    <div class="col-12 text-center">
                                        <p class="m-0 fs-6 fw-bold"><?php echo ($seller_data["nic"]) ?></p>
                                    </div>
                                    <div class="col-12 text-center">
                                        <p class="m-0 fs-5 fw-bold text-black-50"><?php echo ($seller_data["user_email"]) ?></p>
                                    </div>

                                    <div class="col-12 text-center my-5">
                                        <input type="file" class="d-none" id="editProfileImg" accept="image/*">
                                        <label for="editProfileImg" class="btn btn-outline-primary" onclick="updateProfileImage();">Update Profile Image</label>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="row justify-content-center pt-4">

                            <div class="col-11 col-lg-11 my-4 shadow bg-light">
                                <div class="row">

                                    <div class="col-12 my-2">
                                        <p class="fs-4 fw-bold text-primary">My Details >> Seller ...</p>
                                    </div>
                                    <hr class="border border-2 border-primary">
                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-6 rounded-top slide_01_bg cursor" id="show_d_btn" onclick="showdetails();">
                                                <p class="fw-bold fs-6 mt-2">Shop Detals</p>
                                            </div>
                                            <div class="col-6 rounded-top slidebtn01_bg cursor" id="Show_NIC_btn" onclick="showNic();">
                                                <p class="fw-bold fs-6 mt-2">NIC Images</p>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 slide_01_bg rounded-end rounded-bottom shadow">
                                        <div class="row px-2" id="showdetails_S">

                                            <div class="col-12 mt-4">
                                                <p class="m-0 pb-2">Shop Name :-</p>
                                                <input type="text" class="form-control shadow-none ps-4" id="shopName" value="<?php echo ($seller_data["shop_name"]) ?>">
                                            </div>
                                            <div class="col-12 mt-4">
                                                <p class="m-0 pb-2">National ID No :-</p>
                                                <input type="text" class="form-control shadow-none ps-4" value="<?php echo ($seller_data["nic"]) ?>" readonly>
                                            </div>
                                            <div class="col-12 mt-4 mb-3">
                                                <p class="m-0 pb-2">Account Created Date_Time :-</p>
                                                <input type="text" class="form-control shadow-none ps-4" value="<?php echo ($seller_data["account_create_datetime"]) ?>" readonly>
                                            </div>

                                            <div class="col-12 mt-4 mb-3 text-end">
                                                <button class="btn btn-dark" onclick="updateSellerProfile();">Update</button>
                                            </div>

                                        </div>

                                        <div class="row px-2 d-none" id="NicSellerDetails_s">
                                            <div class="col-12 mb-4 mt-4">
                                                <!-- carousel -->
                                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active text-dark" aria-current="true" aria-label="Slide 1"></button>
                                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="active text-dark" aria-label="Slide 2"></button>
                                                    </div>
                                                    <div class="carousel-inner">
                                                        <?php
                                                        $nic_rs = Database::Search("SELECT * FROM `nic_images` WHERE `seller_nic`='" . $s_nic . "' ");
                                                        $nic_num = $nic_rs->num_rows;
                                                        if ($nic_num > 0) {
                                                            for ($x = 0; $x < $nic_num; $x++) {
                                                                $nic_data = $nic_rs->fetch_assoc();
                                                        ?>
                                                                <div class="carousel-item active text-center">
                                                                    <img src="<?php echo ($nic_data["nic_path"]) ?>" height="300px" alt="" srcset="">
                                                                </div>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>

                                                            <div class="carousel-item active text-center">
                                                                <img src="resources/no_Id.jpg" height="300px" alt="" srcset="">
                                                            </div>
                                                            <div class="carousel-item active text-center">
                                                                <img src="resources/no_Id.jpg" height="300px" alt="" srcset="">
                                                            </div>

                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                </div>
                                                <!-- carousel -->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>