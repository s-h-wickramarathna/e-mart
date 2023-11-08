<?php

session_start();
$s_nic = $_SESSION["seller"]["nic"];

require "connection.php";

$seller_rs = Database::Search("SELECT * FROM `seller` INNER JOIN `user` ON seller.user_email = user.email WHERE `nic`='" . $s_nic . "' ");
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

<body class="bg-light">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 border-bottom">
                <div class="row">

                    <div class=" col-12 col-lg-4 bg-light bg-gradient">
                        <div class="row bg-gradient">
                            <div class="col-12 logo_seller"></div>
                            <div class="col-12 text-center">
                                <p class="fs-1 title_01 text-center m-0"><span class="title_02">E</span>mart</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-8 bg-light bg-gradient text-dark p-4">
                        <div class="row d-flex justify-content-center mt-2 mb-2 shadow bg-light">
                            <div class="col-lg-7">
                                <div class="row ms-3 mt-1">
                                    <div class="col-12">
                                        <p class="fs-5 fw-bold m-0 p-2">My Detailes</p>
                                    </div>
                                    <div class="col-12 m-0">
                                        <hr class="m-0">
                                    </div>
                                    <div class="col-12">
                                        <p class="fs-6 m-0 p-1 mt-1"><span class="fw-bold">Seller Name :- </span><?php echo ($seller_data["fname"] . " " . $seller_data["lname"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="fs-6 m-0 p-1"><span class="fw-bold">Email :- </span><?php echo ($seller_data["email"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="fs-6 m-0 p-1"><span class="fw-bold">National ID No :- </span><?php echo ($seller_data["nic"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="fs-6 m-0 p-1"><span class="fw-bold">Shop Name :- </span><?php echo ($seller_data["shop_name"]) ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <?php

                                        $shop_img_rs = Database::Search("SELECT * FROM `shop_image` WHERE `seller_nic`='" . $s_nic . "' ");
                                        $shop_img_num = $shop_img_rs->num_rows;

                                        if ($shop_img_num > 0) {
                                            $shop_img_data = $shop_img_rs->fetch_assoc();
                                        ?>
                                            <img src="<?php echo ($shop_img_data["shop_img_path"]) ?>" height="160px" class="rounded-circle mt-3 mb-2">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="resources/user_profile_img/sana_634d54a6c8427.jpeg" height="160px" class="rounded-circle mt-3 mb-2">
                                        <?php
                                        }

                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 d-flex justify-content-end align-items-end mb-2">
                                <a class="btn btn-outline-dark" href="sellerProfile.php"><i class="bi bi-pen-fill"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 mt-3">
                <div class="row">

                    <div class="col-12 col-lg-3 col-xl-2 sticky-top">
                        <div class="row mt-1 mb-1 d-flex justify-content-center border-bottom border-end">
                            <div class="col-12 mt-2 pb-3">
                                <p class="m-0 fs-4 fw-bold">My Section</p>
                            </div>
                            <div class="col-12">
                                <hr class="mt-0">
                            </div>

                            <div class="col-5 col-lg-12">
                                <p class="ps-4 fw-bold cursor border" onclick="window.location='massageWithBuyers&Admin.php'">Massages
                                    <?php

                                    $msg_rs = Database::Search("SELECT * FROM `massage` WHERE `m_from`='" . $s_nic . "' AND `seller_status`='1' ");
                                    $msg_num = $msg_rs->num_rows;

                                    if ($msg_num != 0) {
                                    ?><span class="badge text-bg-primary"><?php echo ($msg_num) ?></span><?php
                                                                                                        }

                                                                                                            ?></p>

                            </div>
                            <div class="col-5 col-lg-12">
                                <p class="ps-4 fw-bold cursor border" onclick="window.location='addproduct.php'">Add Product</p>
                            </div>
                            <div class="col-5 col-lg-12">
                                <p onclick="activeDeactiveP();" class="ps-4 fw-bold cursor border">Deactive And Active Products</p>
                            </div>
                            <div class="col-5 col-lg-12">
                                <p class="ps-4 fw-bold cursor border">Reports</p>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-lg-9 col-xl-10 p-2">
                        <div class="row">
                            <div class="col-12 bgsellersub">
                                <div class="row justify-content-start">
                                    <div class="col-4 sellerSubImg d-none d-lg-block"></div>

                                    <div class="col-12 col-lg-8 pt-3">
                                        <div class="row">
                                            <div class="col-12 mt-3">
                                                <p class="fs-4 fw-bold">You can easily search, update and filter the products you have put up for sale and go to the search and filter section to simplify the process.</p>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end p-4">
                                                <button class="btn btn-outline-dark" onclick="SearchSellerStoreProducts();">Search All Products</button>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr>
                    </div>

                    <div class="col-12 mt-2 mb-4">
                        <div class="row d-flex justify-content-center gap-3" id="loadProductSection">

                            <?php

                            $p_rs = Database::Search("SELECT * FROM `product` WHERE `seller_nic`='" . $s_nic . "' ORDER BY `date_time` DESC LIMIT 5 OFFSET 0 ");
                            $p_num = $p_rs->num_rows;

                            if ($p_num == 0) {
                            ?>

                                <div class="col-12">
                                    <div class="row text-center">
                                        <p class="fw-bold fs-3 text-black-50">No Product Your Sell ?????</p>
                                    </div>
                                </div>

                                <?php
                            } else {

                                for ($i = 0; $i < $p_num; $i++) {
                                    $p_data = $p_rs->fetch_assoc();

                                    $p_img_rs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $p_data["id"] . "' ");
                                    $p_img_data = $p_img_rs->fetch_assoc();

                                    if ($p_data["admin_status"] == 2) {
                                        ?>

                                    <!-- card -->
                                    <div class="card cardHover cursor p-0 shadow-lg mt-4 mb-2 opacity-75" style="width: 15rem;">

                                        <?php

                                        if (isset($p_img_data["p_path"])) {
                                        ?>
                                            <img src="<?php echo ($p_img_data["p_path"]) ?>" class="card-img-top" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="resources/emptyProducts.png" class="card-img-top" height="190px" />
                                        <?php
                                        }
                                        ?>

                                        <div class="card-body text-center">
                                            <p class="card-title fs-6 fw-bold"><?php echo ($p_data["title"]) ?><span class="badge bg-danger">Blocked By Admin</span></p>

                                            <div class="col-12 text-success">
                                                <p>LKR : <b><?php echo ($p_data["price"]) ?></b></p>
                                            </div>
                                            <div class="col-12 text-secondary text-end fw-bolder" style="font-size: 12px;">
                                                <p><?php echo ($p_data["date_time"]) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- card -->

                            <?php
                                    } else {
                                ?>

                                        <!-- card -->
                                        <div class="card cardHover cursor p-0 shadow-lg mt-4 mb-2" style="width: 15rem;">

                                            <?php

                                            if (isset($p_img_data["p_path"])) {
                                            ?>
                                                <img src="<?php echo ($p_img_data["p_path"]) ?>" onclick="updateProduct(<?php echo ($p_data['id']) ?>);" class="card-img-top" />
                                            <?php
                                            } else {
                                            ?>
                                                <img src="resources/emptyProducts.png" onclick="updateProduct(<?php echo ($p_data['id']) ?>);" class="card-img-top" height="190px" />
                                            <?php
                                            }
                                            ?>

                                            <div class="card-body text-center">
                                                <p class="card-title fs-6 fw-bold"><?php echo ($p_data["title"]) ?></p>

                                                <div class="col-12 text-success">
                                                    <p>LKR : <b><?php echo ($p_data["price"]) ?></b></p>
                                                </div>
                                                <div class="col-12 text-secondary text-end fw-bolder" style="font-size: 12px;">
                                                    <p><?php echo ($p_data["date_time"]) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- card -->

                            <?php
                                    }
                                }
                            }
                            ?>

                            <div class="col-12">
                                <hr class="mb-3" />
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <?php include "footer.php" ?>

            <!-- Toast -->

            <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toast">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-secondary text-white">
                        <img src="resources/logo.svg" height="30px" class="rounded me-2" alt="...">
                        <strong class="me-auto">Emart</strong>
                        <small>Massage</small>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-dark fw-bold text-white" id="toastText">
                        Your Product Sucessfully Addedd ...
                    </div>
                </div>
            </div>

            <!-- Toast -->


        </div>
    </div>
    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>