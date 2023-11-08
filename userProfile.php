<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body>

    <?php
    session_start();
    require "connection.php";
    ?>

    <div class="container-fluid bg-light">
        <div class="row">

            <?php

            if (isset($_SESSION["user"])) {
                $data = $_SESSION["user"];

                $user = Database::Search("SELECT * FROM `user` INNER JOIN `gender` ON `user`.`gender_id` = `gender`.`id` WHERE `email` = '" . $data["email"] . "' ");
                $user_details = $user->fetch_assoc();
            ?>
                <!-- Personal Details -->
                <div class="col-12 col-lg-4 border-end mb-3">
                    <div class="row">
                        <div class="col-12 text-center mt-3 ">
                            <?php
                            $profile_img_rs = Database::Search("SELECT * FROM `profile_image` WHERE `user_email` ='" . $data["email"] . "' ");
                            $profile_img_num = $profile_img_rs->num_rows;


                            if ($profile_img_num != 0) {

                                $profile_img_data = $profile_img_rs->fetch_assoc();
                            ?>
                                <img src="<?php echo ($profile_img_data["user_profile_path"]); ?>" class="rounded-3 mt-5" style="height: 300px;" id="viewImg" />
                                <p class="text-danger d-none" style="font-size: 15px;" id="iniMage">Invalid Image Type ...</p>
                            <?php
                            } else {
                            ?>
                                <img src="resources/user_profile_img/userprofile.png" class="rounded-3 mt-5" style="width: 300px;" id="viewImg" />
                                <p class="text-danger d-none" style="font-size: 15px;" id="iniMage">Invalid Image Type ...</p>
                            <?php
                            }

                            ?>
                        </div>
                        <div class="col-12">
                            <div class="row mt-2 p-0">
                                <div class="col-12 text-center">
                                    <label><?php echo ($user_details["fname"] . " " . $user_details["lname"]); ?></label>
                                </div>
                                <div class="col-12 text-center p-0">
                                    <label class="text-black-50"><?php echo ($user_details["email"]); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="row text-center">
                                <div class="col-12">
                                    <input type="file" class="d-none" id="profileimg" accept="image/*" />
                                    <label for="profileimg" class="btn btn-primary" onclick="changeImage();">Upload New Photo</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-lg-none">
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="row">
                        <div class="col-12 mb-2 border-bottom border-2 border-dark">
                            <div class="row">
                                <div class="col-12 userdesign" style="height: 200px;"></div>
                                <div class="col-12 col-lg-8 position-absolute d-flex justify-content-center align-items-center" style="height: 200px;">
                                <div class="row">
                                <p class="fs-1 text-white fw-bold">Fill In Your Details Easily ....</p>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6 border-end">
                            <div class="row">

                                <div class="col-12 text-center">
                                    <p class="fs-5 text-decoration-underline fw-bold">Personal Details</p>
                                </div>

                                <div class="col-12">
                                    <div class="row ps-1">

                                        <div class="col-6">
                                            <div class="mb-2 pt-1">
                                                <label for="exampleFormControlInput1" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="fname" value="<?php echo ($user_details["fname"]); ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-2 pt-1">
                                                <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lname" value="<?php echo ($user_details["lname"]); ?>">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-2 pt-1">
                                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                                <input type="text" class="form-control" value="<?php echo ($user_details["email"]); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-2 pt-1">
                                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                                <input type="text" class="form-control" value="<?php echo ($user_details["password"]); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-2 pt-1">
                                                <label for="exampleFormControlInput1" class="form-label">Mobile</label>
                                                <input type="email" class="form-control" id="mobile" value="<?php echo ($user_details["mobile"]); ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-2 pt-1">
                                                <label for="exampleFormControlInput1" class="form-label">Gender</label>
                                                <input type="email" class="form-control" value="<?php echo ($user_details["type"]); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-2 pt-1">
                                                <label for="exampleFormControlInput1" class="form-label">Joined Date</label>
                                                <input type="email" class="form-control" value="<?php echo ($user_details["joined_date"]); ?>" readonly>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Personal Details -->

                        <!-- shipping Details -->


                        <div class="col-12 col-md-6 col-lg-6 border-end">
                            <div class="row">

                                <div class="col-12 text-center">
                                    <p class="fs-5 text-decoration-underline fw-bold">Shipping Details</p>
                                </div>

                                <div class="col-12">
                                    <div class="row ps-1">

                                        <div class="col-6">
                                            <div class="mb-2 pt-1">
                                                <label for="exampleFormControlInput1" class="form-label">Province</label>
                                                <select class="form-select" name="" id="p" onclick="loadDistrict();">
                                                    <?php

                                                    $user_rs = Database::Search("SELECT * FROM `user` 
                                                               INNER JOIN `user_has_address` ON `user`.`email`=`user_has_address`.`user_email` 
                                                               INNER JOIN `city` ON `user_has_address`.`city_id`=`city`.`ci_id` 
                                                               INNER JOIN `distric` ON `city`.`distric_id`=`distric`.`d_id` WHERE `email`='" . $data["email"] . "' ");
                                                    $user_data = $user_rs->fetch_assoc();


                                                    ?>
                                                    <?php


                                                    $p_rs = Database::Search("SELECT * FROM `province`");
                                                    $p_num = $p_rs->num_rows;
                                                    ?> <option value="0">Select Your Province</option> <?php
                                                                                                        for ($x = 0; $x < $p_num; $x++) {
                                                                                                            $p_data = $p_rs->fetch_assoc();
                                                                                                        ?><option value="<?php echo ($p_data["p_id"]) ?>" <?php if (!empty($user_data["province_p_id"])) {
                                                                                                                                                                if ($p_data["p_id"] == $user_data["province_p_id"]) { ?> selected <?php }
                                                                                                                                                                                                                            } ?>><?php echo ($p_data["p_name"]); ?></option><?php
                                                                                                                                                                                                                                                                        }

                                                                                                                                                                                                                                                                            ?>
                                                    <?php

                                                    ?>

                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-6">
                                            <div class="mb-2 pt-1">
                                                <label for="exampleFormControlInput1" class="form-label">District</label>
                                                <select class="form-select" name="" id="d" onchange="loadcities();">

                                                    <?php
                                                    if (!empty($user_data["d_id"])) {

                                                    ?>
                                                        <option value="<?php echo ($user_data["d_id"]) ?>"><?php echo ($user_data["d_name"]) ?></option>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="0">First Select Your District</option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-2 pt-1">
                                                <label for="exampleFormControlInput1" class="form-label">City</label>
                                                <select class="form-select" name="" id="city">

                                                    <?php

                                                    if (!empty($user_data["ci_id"])) {
                                                    ?>
                                                        <option value="<?php echo ($user_data["ci_id"]) ?>"><?php echo ($user_data["ci_name"]) ?></option>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="0">First Select Your District</option>

                                                    <?php
                                                    }

                                                    ?>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-2 pt-1">
                                                <?php

                                                $address_rs = Database::Search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $data["email"] . "'");
                                                $address_num = $address_rs->num_rows;
                                                $address_data = $address_rs->fetch_assoc();

                                                ?>
                                                <?php

                                                if (!empty($address_data["postal_code"])) {

                                                ?>
                                                    <label for="exampleFormControlInput1" class="form-label">Postal Code</label>
                                                    <input type="email" class="form-control" id="pcd" value="<?php echo ($address_data["postal_code"]) ?>">

                                                <?php

                                                } else {

                                                ?>
                                                    <label for="exampleFormControlInput1" class="form-label">Postal Code</label>
                                                    <input type="email" class="form-control" id="pcd" placeholder="Enter Posatl Code">

                                                <?php

                                                }

                                                ?>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-2 pt-1">

                                                <?php

                                                if (!empty($address_data["line_1"])) {

                                                ?>
                                                    <label for="exampleFormControlInput1" class="form-label">Address Line 01</label>
                                                    <input type="email" class="form-control" id="line1" value="<?php echo ($address_data["line_1"]) ?>" />
                                                <?php

                                                } else {
                                                ?>
                                                    <label for="exampleFormControlInput1" class="form-label">Address Line 01</label>
                                                    <input type="email" class="form-control" id="line1" placeholder="Enter your Address 01" />

                                                <?php
                                                }

                                                ?>

                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-2 pt-1">
                                                <?php

                                                if (!empty($address_data["line_2"])) {

                                                ?>
                                                    <label for="exampleFormControlInput1" class="form-label">Address Line 02</label>
                                                    <input type="email" class="form-control" id="line2" value="<?php echo ($address_data["line_2"]); ?>" />
                                                <?php

                                                } else {
                                                ?>
                                                    <label for="exampleFormControlInput1" class="form-label">Address Line 02</label>
                                                    <input type="email" class="form-control" id="line2" placeholder="Enter your Address 02" />

                                                <?php
                                                }

                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12 mb-3 mt-2">
                            <div class="row d-flex justify-content-center">
                                <div class="col-6 d-grid">
                                    <button class="btn btn-primary" onclick="user_profile_update();">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- shipping Details -->
            <?php

            } else {
                header("Location:index.php");
            }

            ?>

            <?php include "footer.php" ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>