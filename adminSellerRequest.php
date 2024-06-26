<?php
session_start();
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Emart || Manage Users ....</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="aos.css">
</head>

<body>
    <?php

    if (isset($_SESSION["admin"])) {
        $admin = $_SESSION["admin"];

    ?>

        <div class="container-fluid">
            <div class="row">
                <?php include "adminHeader.php" ?>

                <div class="col-12 mt-3">
                    <div class="row">

                        <div class="col-4">
                            <p class="fs-5 fw-bold text-primary">Manage Sellers</p>
                        </div>
                        <div class="col-8">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Enter Seller Nic No ...." id="adminSearchsellernic" onkeyup="adminSearchSeller(<?php echo ($status) ?>)">
                                <button class="btn btn-dark" type="button" onclick="adminSearchSeller(<?php echo ($status) ?>)">Search</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="table-responsive" style="height: 60vh;">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="bg-secondary text-white">#</th>
                                    <th scope="col" class="bg-info text-white">User Email</th>
                                    <th scope="col" class="bg-secondary text-white">NIC Image</th>
                                    <th scope="col" class="bg-info text-white">Nic No</th>
                                    <th scope="col" class="bg-secondary text-white">Shop Name</th>
                                    <th scope="col" class="bg-info text-white">Date</th>
                                    <th scope="col" class="bg-secondary text-white"></th>
                                    <th scope="col" class="bg-secondary text-white"></th>
                                </tr>
                            </thead>
                            <tbody id="contentFullDetails">

                                <?php
                                $seller_rs = Database::Search("SELECT * FROM `seller` WHERE `s_status`='1' ORDER BY `account_create_datetime` DESC ");
                                $seller_num = $seller_rs->num_rows;

                                if ($seller_num != 0) {

                                    for ($x = 0; $x < $seller_num; $x++) {
                                        $seller_data = $seller_rs->fetch_assoc();

                                        $user_rs = Database::Search("SELECT * FROM `user` WHERE `email`='" . $seller_data["user_email"] . "' ");
                                        $user_data = $user_rs->fetch_assoc();

                                        $gender = Database::Search("SELECT * FROM `gender` WHERE `id`='" . $user_data["gender_id"] . "' ");
                                        $gender_data = $gender->fetch_assoc();

                                        $city = "-------------------";
                                        $line1 = "------------------";
                                        $line2 = "------------------";

                                        $address_rs = Database::Search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $user_data["email"] . "' ");
                                        $address_num = $address_rs->num_rows;

                                        if ($address_num != 0) {
                                            $address_data = $address_rs->fetch_assoc();
                                            $line1 = $address_data["line_1"];
                                            $line2 = $address_data["line_2"];

                                            $city_rs = Database::Search("SELECT * FROM `city` WHERE `ci_id`='" . $address_data["city_id"] . "' ");
                                            $city_data = $city_rs->fetch_assoc();
                                            $city = $city_data["ci_name"];
                                        }

                                ?>

                                        <tr>
                                            <th scope="row" class="bg-secondary text-white"><?php echo ($x + 1); ?></th>
                                            <td class="bg-info text-white" onclick="UserSellerDetails('<?php echo ($seller_data['nic']) ?>');"><?php echo ($user_data['email']) ?></td>
                                            <td class="bg-secondary text-white text-center">
                                                <?php

                                                $shop_image[0] = "resources/noImage.jpg";
                                                $shop_image[1] = "resources/noImage.jpg";

                                                $S_img_rs = Database::Search("SELECT * FROM `nic_images` WHERE `seller_nic`='" . $seller_data['nic'] . "' ");
                                                $S_img_num = $S_img_rs->num_rows;

                                                if ($S_img_num != 0) {
                                                    for ($a = 0; $a < $S_img_num; $a++) {
                                                        $seller_nic_image = $S_img_rs->fetch_assoc();
                                                        $shop_image[$a] = $seller_nic_image["nic_path"];
                                                    }
                                                }

                                                ?>
                                                <img src="<?php echo ($shop_image[0]) ?>" onclick="veiwSellerNicImages('<?php echo ($seller_data['nic']) ?>');" class="rounded-circle" height="50px">
                                            </td>
                                            <td class="bg-info text-white"><?php echo ($seller_data['nic']) ?></td>
                                            <td class="bg-secondary text-white"><?php echo ($seller_data['shop_name']) ?></td>
                                            <td class="bg-info text-white"><?php echo ($seller_data['account_create_datetime']) ?></td>
                                            <td class="bg-secondary text-white text-center"><button class="btn btn-success" onclick="acceptSellerReqquest('<?php echo ($seller_data['nic']) ?>');">Accept</button></td>
                                            <td class="bg-secondary text-white text-center"><button class="btn btn-danger" onclick="RejectSellerReqquest('<?php echo ($seller_data['nic']) ?>');">Reject</button></td>
                                        </tr>

                                        <!-- user_Model -->

                                        <div class="modal" tabindex="-1" id="requestSeller<?php echo ($seller_data["nic"]) ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><?php echo ($user_data["fname"] . " " . $user_data["lname"]) ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 text-center mb-2">
                                                            <?php

                                                            $user_image = "resources/noImage.jpg";

                                                            $u_img = Database::Search("SELECT * FROM `profile_image` WHERE `user_email`='" . $user_data["email"] . "' ");
                                                            $u_img_num = $u_img->num_rows;

                                                            if ($u_img_num != 0) {
                                                                $u_data = $u_img->fetch_assoc();
                                                                $user_image = $u_data["user_profile_path"];
                                                            }

                                                            ?>
                                                            <img src="<?php echo ($user_image) ?>" class="rounded-circle" height="200px" />
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="row">

                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Full Name : </span><?php echo ($user_data["fname"] . " " . $user_data["lname"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Shop Name : </span><?php echo ($seller_data["shop_name"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Email : </span><?php echo ($user_data["email"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Mobile No : </span><?php echo ($user_data["mobile"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Gender : </span><?php echo ($gender_data["type"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">City : </span><?php echo ($city) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Addres Line 01 : </span><?php echo ($line1) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Addres Line 02 : </span><?php echo ($line2) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Account Create Date : </span><?php echo ($seller_data["account_create_datetime"]) ?></p>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="col-12 text-end">
                                                            <p class="fw-bold text-black-50">User Account ....</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- user_Model -->

                                        <!-- user_Model -->

                                        <div class="modal" tabindex="-1" id="requestSellerNICImages<?php echo ($seller_data["nic"]) ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">NIC Images</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 text-center mb-2">
                                                            <img src="<?php echo ($shop_image[0]) ?>"  width="90%" />
                                                            <img src="<?php echo ($shop_image[1]) ?>"  width="90%" />
                                                        </div>

                                                    
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <!-- user_Model -->

                                <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    <?php
    }

    ?>
    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>