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

    <title>Emart || Selling History ....</title>

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
                            <p class="fs-5 fw-bold text-primary">Manage Sellings</p>
                        </div>
                        <div class="col-8">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Enter Order ID Or Invoice ID ....." id="SearchsellingHId" onkeyup="searchSellingHistory();">
                                <button class="btn btn-dark" type="button" onclick="searchSellingHistory();">Search</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="table-responsive" style="height: 60vh;">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="bg-info text-white">Order ID</th>
                                    <th scope="col" class="bg-secondary text-white">Buyer Email</th>
                                    <th scope="col" class="bg-info text-white">Produuct ID</th>
                                    <th scope="col" class="bg-secondary text-white">Product Title</th>
                                    <th scope="col" class="bg-info text-white">Seller NIC</th>
                                    <th scope="col" class="bg-secondary text-white">Total Price LKR</th>
                                    <th scope="col" class="bg-info text-white">Quentity</th>
                                    <th scope="col" class="bg-secondary text-white">Buy Date</th>
                                    <th scope="col" class="bg-dark text-white">Status</th>
                                </tr>
                            </thead>
                            <tbody id="SellingHistorydataRows">

                                <?php
                                $invoice_rs = Database::Search("SELECT * FROM `invoice` ");
                                $invoice_num = $invoice_rs->num_rows;

                                if ($invoice_num != 0) {

                                    for ($x = 0; $x < $invoice_num; $x++) {
                                        $invoice_data = $invoice_rs->fetch_assoc();

                                        $product_rs = Database::Search("SELECT * FROM `product` 
                                        INNER JOIN `category` ON `product`.`category_ca_id`=`category`.`ca_id`
                                        INNER JOIN `model_has_brand` ON `product`.`model_has_brand_id`=`model_has_brand`.`m_h_b_id`
                                        INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`b_id`
                                        INNER JOIN `model` ON `model_has_brand`.`model_id`=`model`.`m_id` 
                                        INNER JOIN `condition` ON `product`.`condition_id`=`condition`.`co_id` WHERE `id`='" . $invoice_data["product_id"] . "' ");
                                        $product_data = $product_rs->fetch_assoc();

                                        $seller_rs = Database::Search("SELECT * FROM `seller`
                                        INNER JOIN `user` ON `seller`.`user_email`=`user`.`email`
                                        WHERE `nic`='" . $product_data["seller_nic"] . "' ");
                                        $seller_data = $seller_rs->fetch_assoc();

                                        $user_rs = Database::Search("SELECT * FROM `user` WHERE `email`='" . $invoice_data["user_email"] . "' ");
                                        $user_data = $user_rs->fetch_assoc();

 
                                ?>
                                        <tr>
                                            <th scope="row" class="bg-info text-white"><?php echo ($invoice_data["order_id"]); ?></th>
                                            <th scope="row" class="bg-secondary text-white cursor" onclick="VeiwBuyeSellingHistory('<?php echo ($user_data['email']) ?>')"><?php echo ($user_data["email"]); ?></th>
                                            <td class="bg-info text-white cursor" onclick="SellingHProductView(<?php echo ($product_data['id']) ?>)"><?php echo ($invoice_data["product_id"]); ?></td>
                                            <td class="bg-secondary text-white"><?php
                                                                                $t = str_split($product_data["title"], 10);
                                                                                echo ($t[0] . " ...");
                                                                                ?></td>
                                            <td class="bg-info text-white cursor" onclick="viewSELLERDetails('<?php echo ($seller_data['nic']) ?>');"><?php echo ($product_data["seller_nic"]) ?></td>
                                            <td class="bg-secondary text-white"><?php echo ($invoice_data["total"]); ?></td>
                                            <td class="bg-info text-white"><?php echo ($invoice_data["buy_qty"]); ?></td>
                                            <td class="bg-secondary text-white"><?php echo ($invoice_data["date_time"]); ?></td>
                                            <td class="bg-dark text-white text-center">
                                                <?php
                                                if ($invoice_data["status"] == 0) {
                                                ?>
                                                    <button class="btn btn-success fw-bold mt-1 mb-1" onclick="changeSellingStatus(<?php echo ($invoice_data['invoice_id']); ?>);" id="btn<?php echo ($invoice_data["invoice_id"]); ?>">Confirm Order</button>
                                                <?php
                                                } else if ($invoice_data["status"] == 1) {
                                                ?>
                                                    <button class="fw-bold mt-1 mb-1 btn btn-warning" onclick="changeSellingStatus(<?php echo ($invoice_data['invoice_id']); ?>);" id="btn<?php echo ($invoice_data["invoice_id"]); ?>">Packing</button>
                                                <?php
                                                } else if ($invoice_data["status"] == 2) {
                                                ?>
                                                    <button class="btn btn-info fw-bold mt-1 mb-1" onclick="changeSellingStatus(<?php echo ($invoice_data['invoice_id']); ?>);" id="btn<?php echo ($invoice_data["invoice_id"]); ?>">Dispatch</button>
                                                <?php
                                                } else if ($invoice_data["status"] == 3) {
                                                ?>
                                                    <button class="btn btn-primary fw-bold mt-1 mb-1" onclick="changeSellingStatus(<?php echo ($invoice_data['invoice_id']); ?>);" id="btn<?php echo ($invoice_data["invoice_id"]); ?>">Shipping</button>
                                                <?php
                                                } else if ($invoice_data["status"] == 4) {
                                                ?>
                                                    <button class="btn btn-danger fw-bold mt-1 mb-1" disabled onclick="changeSellingStatus(<?php echo ($invoice_data['invoice_id']); ?>);" id="btn<?php echo ($invoice_data["invoice_id"]); ?>">Delivered</button>
                                                <?php
                                                }

                                                ?>
                                            </td>
                                        </tr>

                                        <!-- Seller_Model -->

                                        <div class="modal" tabindex="-1" id="SellinghistorysellerModel<?php echo ($seller_data["nic"]) ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><?php echo ($seller_data["fname"] . " " . $seller_data["lname"]) ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 text-center mb-2">
                                                            <?php

                                                            $shop_image = "resources/noImage.jpg";

                                                            $S_img_rs = Database::Search("SELECT * FROM `shop_image` WHERE `seller_nic`='" . $seller_data['nic'] . "' ");
                                                            $S_img_num = $S_img_rs->num_rows;

                                                            if ($S_img_num != 0) {
                                                                $seller_shop_image = $S_img_rs->fetch_assoc();
                                                                $shop_image = $seller_shop_image["shop_img_path"];
                                                            }

                                                            ?>
                                                            <img src="<?php echo ($shop_image) ?>" class="rounded-circle" height="200px" />
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="row">

                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Full Name : </span><?php echo ($seller_data["fname"] . " " . $seller_data["lname"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Shop Name : </span><?php echo ($seller_data["shop_name"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Email : </span><?php echo ($seller_data["email"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Mobile No : </span><?php echo ($seller_data["mobile"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <?php

                                                                    $gender_rs = Database::Search("SELECT * FROM `gender` WHERE `id`='" . $seller_data["gender_id"] . "' ");
                                                                    $gender_data = $gender_rs->fetch_assoc();

                                                                    ?>
                                                                    <p class="m-0"><span class="fw-bold">Gender : </span><?php echo ($gender_data["type"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <?php
                                                                    $city = "-------------------";
                                                                    $line1 = "------------------";
                                                                    $line2 = "------------------";

                                                                    $address_rs = Database::Search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $seller_data["email"] . "' ");
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
                                                            <p class="fw-bold text-black-50">Seller Account ....</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Seller_Model -->

                                        <!-- product_model -->

                                        <div class="modal" tabindex="-1" id="SellingProductModel<?php echo ($product_data["id"]) ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><?php echo ($product_data["title"]) ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 text-center mb-2">
                                                            <div class="row">
                                                                <?php
                                                                $img[0] = "resources/noImage.jpg";
                                                                $img[1] = "resources/noImage.jpg";
                                                                $img[2] = "resources/noImage.jpg";
                                                                $img[3] = "resources/noImage.jpg";

                                                                $image_rs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $product_data["id"] . "' ");
                                                                $image_num = $image_rs->num_rows;

                                                                if ($image_num != 0) {
                                                                    for ($i = 0; $i < $image_num; $i++) {
                                                                        $image_data = $image_rs->fetch_assoc();
                                                                        $img[$i] = $image_data["p_path"];
                                                                    }
                                                                } ?>
                                                                <div class="col-6 text-center"><img src="<?php echo ($img[0]) ?>" width="90%"></div>
                                                                <div class="col-6 text-center"><img src="<?php echo ($img[1]) ?>" width="90%"></div>
                                                                <div class="col-6 text-center"><img src="<?php echo ($img[2]) ?>" width="90%"></div>
                                                                <div class="col-6 text-center"><img src="<?php echo ($img[3]) ?>" width="90%"></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12" style="height: 20vh;">
                                                            <div class="row overflow-auto">

                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Title : </span><?php echo ($product_data["title"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Condition : </span><?php echo ($product_data["co_name"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Category : </span><?php echo ($product_data["ca_name"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Brand : </span><?php echo ($product_data["b_name"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Model : </span><?php echo ($product_data["m_name"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Price : </span><?php echo ($product_data["price"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Delivary Fee Colombo LKR : </span><?php echo ($product_data["cost_colombo"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Delivary Fee Other LKR : </span><?php echo ($product_data["cost_others"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Publish Date : </span><?php echo ($product_data["date_time"]) ?></p>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product_Model -->
                                        <!-- user_Model -->

                                        <div class="modal" tabindex="-1" id="SellingHuerModel<?php echo ($user_data["email"]) ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><?php echo ($user_data["fname"] . " " . $user_data["lname"]) ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 text-center mb-2">
                                                            <?php
                                                            $img = "resources/noImage.jpg";

                                                            $image_rs = Database::Search("SELECT * FROM `profile_image` WHERE `user_email`='" . $user_data["email"] . "' ");
                                                            $image_num = $image_rs->num_rows;

                                                            if ($image_num != 0) {
                                                                $image_data = $image_rs->fetch_assoc();
                                                                $img = $image_data["user_profile_path"];
                                                            }

                                                            ?>
                                                            <img src="<?php echo ($img) ?>" class="rounded-circle" height="200px" />
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="row">

                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">First Name : </span><?php echo ($user_data["fname"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Last Name : </span><?php echo ($user_data["lname"]) ?></p>
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
                                                                    <p class="m-0"><span class="fw-bold">Joined Date : </span><?php echo ($user_data["joined_date"]) ?></p>
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

    } else {
    ?>
        <div class="w-100 vh-100 d-flex align-items-center justify-content-center">
            <div class="row text-center">
                <div class="col-12 text-center">
                    <p class="fs-4 fw-bold text-black-50">ERROR :( :( You Are Not A Admin .....</p>
                </div>
                <div class="col-12 text-center">
                    <a href="adminSignin.php" class="btn btn-primary">Log As Admin</a>
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