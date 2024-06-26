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

    <title>Emart || Manage Products ....</title>

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

        $query = "SELECT * FROM `product` 
        INNER JOIN `category` ON `product`.`category_ca_id`=`category`.`ca_id`
        INNER JOIN `model_has_brand` ON `product`.`model_has_brand_id`=`model_has_brand`.`m_h_b_id`
        INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`b_id`
        INNER JOIN `model` ON `model_has_brand`.`model_id`=`model`.`m_id` 
        INNER JOIN `condition` ON `product`.`condition_id`=`condition`.`co_id` ";
        $status = 1;

        if (isset($_GET["s"])) {
            $status = $_GET["s"];

            if ($status == 2) {
                $query .= " WHERE `admin_status`='2' ";
            } else if ($status == 3) {
                $query .= " WHERE `admin_status`='1' ";
            }
        }

    ?>

        <div class="container-fluid">
            <div class="row">
                <?php include "adminHeader.php"; ?>

                <div class="col-12 mt-3">
                    <div class="row">

                        <div class="col-4">
                            <p class="fs-5 fw-bold text-primary">Manage products</p>
                        </div>
                        <div class="col-8">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Enter Product Id ...." id="searchProductAdmin" onkeyup="SearchAdminproduct(<?php echo ($status) ?>);">
                                <button class="btn btn-dark" type="button" onclick="SearchAdminproduct(<?php echo ($status) ?>);">Search</button>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="row justify-content-end">
                                <div class="col-6 offset-6 col-md-4 offset-md-8">
                                    <select class="form-select shadow-none" id="selectPproductStatus" onchange="redirectProducts();">
                                        <?php
                                        if ($status == 1) {
                                        ?>
                                            <option value="1" selected>Select Method</option>
                                            <option value="2">Block Products</option>
                                            <option value="3">Unblock Products</option>
                                        <?php
                                        } else if ($status == 2) {
                                        ?>
                                            <option value="1">Select Method</option>
                                            <option value="2" selected>Block Products</option>
                                            <option value="3">Unblock Products</option>
                                        <?php
                                        } else if ($status == 3) {
                                        ?>
                                            <option value="1">Select Method</option>
                                            <option value="2">Block Products</option>
                                            <option value="3" selected>Unblock Products</option>
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
                    <div class="table-responsive" style="height: 60vh;">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="bg-info text-white">Product Id</th>
                                    <th scope="col" class="bg-secondary text-white">product Image</th>
                                    <th scope="col" class="bg-info text-white">Title</th>
                                    <th scope="col" class="bg-secondary text-white">Category</th>
                                    <th scope="col" class="bg-info text-white">Brand</th>
                                    <th scope="col" class="bg-secondary text-white">Model</th>
                                    <th scope="col" class="bg-info text-white">price LKR</th>
                                    <th scope="col" class="bg-secondary text-white"></th>
                                </tr>
                            </thead>
                            <tbody id="ProductSearchveiw">
                                <?php
                                $product_rs = Database::Search($query);
                                $product_num = $product_rs->num_rows;

                                if ($product_num != 0) {

                                    for ($x = 0; $x < $product_num; $x++) {
                                        $product_data = $product_rs->fetch_assoc();

                                ?>
                                        <tr>
                                            <td class="bg-info text-white"><?php echo ($product_data["id"]) ?></td>
                                            <td class="bg-secondary text-white text-center">
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
                                                }
 
                                                ?>
                                                <img src="<?php echo ($img[0]) ?>" onclick="veiwFullProductDetails(<?php echo ($product_data['id']) ?>);" class="rounded-circle" height="50px">
                                            </td>
                                            <td class="bg-info text-white"><?php
                                                                            $t = str_split($product_data["title"], 10);
                                                                            echo ($t[0] . " ...");
                                                                            ?></td>
                                            <td class="bg-secondary text-white"><?php echo ($product_data["ca_name"]) ?></td>
                                            <td class="bg-info text-white"><?php echo ($product_data["b_name"]) ?></td>
                                            <td class="bg-secondary text-white"><?php echo ($product_data["m_name"]) ?></td>
                                            <td class="bg-info text-white"><?php echo ($product_data["price"]) ?></td>
                                            <td class="bg-secondary text-white text-center"><?php
                                                                                            if ($product_data["admin_status"] == 1) {
                                                                                            ?>
                                                    <button class="btn btn-danger" id="Productb&Ubtn<?php echo ($product_data["id"]) ?>" onclick="block_Unblock_Product('<?php echo ($product_data['id']) ?>');">Block</button>
                                                <?php
                                                                                            } else if ($product_data["admin_status"] == 2) {
                                                ?>
                                                    <button class="btn btn-success" id="Productb&Ubtn<?php echo ($product_data["id"]) ?>" onclick="block_Unblock_Product('<?php echo ($product_data['id']) ?>');">Unblock</button>
                                                <?php
                                                                                            }
                                                ?>
                                            </td>
                                        </tr>

                                        <!-- user_Model -->

                                        <div class="modal" tabindex="-1" id="ProductModel<?php echo ($product_data["id"]) ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><?php echo ($product_data["title"]) ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 text-center mb-2">
                                                            <div class="row">
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
                                                                    <p class="m-0"><span class="fw-bold">Seller Nic No : </span><?php echo ($product_data["seller_nic"]) ?></p>
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