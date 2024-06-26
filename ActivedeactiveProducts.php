<?php

session_start();
$s_nic = $_SESSION["seller"]["nic"];

require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emart Active / Deactive Products</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="aos.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light">
                <div class="row mt-2 mb-1">

                    <div class="col-12 col-lg-4 bg-light">
                        <div class="row text-center">
                            <div class="col-12"><img src="resources/logo.svg" height="200px"></div>
                            <p class="fw-bold fs-4 text-black-50">Emart.pvt.ltd</p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 mt-3">
                        <div class="row">
                            <div class="col-12 text-center text-lg-start">
                                <p class="fs-2 fw-bold">Active Or Deactive Your Own Products ....</p>
                            </div>
                            <div class="col-12 text-center text-lg-start">
                                <p class="fs-5">All the items you have put up for sale on our website are on this page. You can activate and deactivate the items as per your need ....</p>
                            </div>
                            <div class="col-12 d-flex justify-content-center justify-content-lg-end align-items-end mt-2 mt-lg-4">
                                <button class="btn btn-dark" onclick="window.location = 'searchSellerStore.php'">Manage Products...</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row">


                    <div class="col-12 mt-4 mb-3">
                        <div class="row d-flex justify-content-center">

                            <div class="col-6">
                                <input type="text" class="form-control shadow-none" onkeyup="productMethod();" placeholder="Select Your Own Activated Or Deatctivated Products ..." id="ad_product_search" />
                            </div>
                            <div class="col-6 col-lg-2">
                                <select class="form-select shadow-none" id="ad_product_method" onchange="productMethod();">
                                    <option value="0">Select Method</option>
                                    <?php

                                    $status_rs = Database::Search("SELECT * FROM `status`");
                                    $status_num = $status_rs->num_rows;

                                    for ($x = 0; $x < $status_num; $x++) {
                                        $status_data = $status_rs->fetch_assoc();

                                    ?>
                                        <option value="<?php echo ($status_data["s_id"]) ?>"><?php echo ($status_data["s_name"]) ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12">
                <div class="row d-flex justify-content-center gap-2 gap-lg-3" id="showProductCards">

                    <?php

                    $p_rs = Database::Search("SELECT * FROM `product` WHERE `seller_nic`='" . $s_nic . "' ORDER BY `date_time` DESC");
                    $p_num = $p_rs->num_rows;

                    if ($p_num == 0) {
                    ?>

                        <div class="col-12">
                            <div class="row text-center">
                                <p class="fw-bold fs-3 text-black-50">No Product Found ?????</p>
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
                                <div class="card cardHover cursor p-0 shadow-lg mt-4 mb-2" style="width: 14rem;">
    
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
    
                                    if ($p_data["status_s_id"] == 1) {
                                    ?>
                                        <div class="col-12 d-flex justify-content-end">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input shadow-none" type="checkbox" role="switch" disabled>
                                            </div>
                                        </div>
                                    <?php
    
                                    } else if ($p_data["status_s_id"] == 2) {
                                    ?>
                                        <div class="col-12 d-flex justify-content-end">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input shadow-none" type="checkbox" role="switch" disabled>
                                            </div>
                                        </div>
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
                            }else{
                                ?>

                                <!-- card -->
                                <div class="card cardHover cursor p-0 shadow-lg mt-4 mb-2" style="width: 14rem;">
    
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
     
                                    if ($p_data["status_s_id"] == 1) {
                                    ?>
                                        <div class="col-12 d-flex justify-content-end">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input shadow-none" type="checkbox" role="switch" id="<?php echo ("activeProduct" . $i) ?>" onchange="ProductActive(<?php echo ($i . ',' . $p_data['id']) ?>);" checked>
                                            </div>
                                        </div>
                                    <?php
    
                                    } else if ($p_data["status_s_id"] == 2) {
                                    ?>
                                        <div class="col-12 d-flex justify-content-end">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input shadow-none" type="checkbox" role="switch" id="<?php echo ("activeProduct" . $i) ?>" onchange="ProductActive(<?php echo ($i . ',' . $p_data['id']) ?>);">
                                            </div>
                                        </div>
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