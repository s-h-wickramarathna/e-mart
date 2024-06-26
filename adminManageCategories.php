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

    <title>Emart || Manage Categories ....</title>

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

        $query = "SELECT * FROM `category`";

    ?>

        <div class="container-fluid">
            <div class="row">
                <?php include "adminHeader.php"; ?>


                <div class="col-12 mt-3">
                    <div class="row">

                        <div class="col-12">
                            <p class="fs-5 fw-bold text-primary">Manage All Categories, Models & Brands</p>
                        </div>
                    </div>
                </div>
                <hr class="border border-2 border-dark">
                <div class="col-12 col-md-6 p-2">
                    <div class="col-12 d-flex"> 
                        <div class="col-6 p-2">
                            <p class="text-secondary">Category Type</p>
                            <select class="form-select shadow-none" id="selectCategoryType">
                                <option value="0" selected>Select Category Type</option>
                                <?php
                                $categoryType_rs = Database::Search("SELECT * FROM `category_type`");
                                $categoryType_num = $categoryType_rs->num_rows;

                                if ($categoryType_num != 0) {
                                    for ($ct = 0; $ct < $categoryType_num; $ct++) {
                                        $categoryType_data = $categoryType_rs->fetch_assoc();
                                ?>
                                        <option value="<?php echo ($categoryType_data["category_tid"]); ?>"><?php echo ($categoryType_data["type_of_category"]); ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <div class="input-group mb-2 mt-2">
                                <input type="text" class="form-control" id="ctId" placeholder="Enter New Category Type" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-dark" type="button" id="button-addon1" onclick="addCategoryType()">+ Add</button>
                            </div>
                        </div>
                        <div class="col-6 p-2">
                            <p class="text-secondary">Category</p>
                            <div class="input-group mb-2 mt-2">
                                <input type="text" class="form-control" id="cId" placeholder="Enter New Category" aria-label="Recipient's username" aria-describedby="button-addon2">

                            </div>

                        </div>
                        
                    </div>
                    <div class="col-12 text-end mb-2">
                            <button class="btn btn-outline-dark" type="button" id="button-addon2" onclick="addCategory()">+ Connection</button>
                        </div>
                    <div class="col-12">
                        <div class="table-responsive" style="height: 45vh;">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="bg-info text-white">Category Type Id</th>
                                        <th scope="col" class="bg-secondary text-white">Category Type Name</th>
                                        <th scope="col" class="bg-info text-white">Category Id</th>
                                        <th scope="col" class="bg-secondary text-white">Category Name</th>
                                    </tr>
                                </thead>
                                <tbody id="ProductSearchveiw">
                                    <?php
                                    $category_rs = Database::Search("SELECT * FROM `category` INNER JOIN `category_type` ON `category_type`.`category_tid`=`category`.`category_type_category_tid`");
                                    $category_num = $category_rs->num_rows;

                                    if ($category_num != 0) {

                                        for ($x = 0; $x < $category_num; $x++) {
                                            $category_data = $category_rs->fetch_assoc();

                                    ?>
                                            <tr>
                                                <td class="bg-info text-white"><?php echo ($category_data["category_tid"]) ?></td>
                                                <td class="bg-secondary text-white text-center"><?php echo ($category_data["type_of_category"]) ?></td>
                                                <td class="bg-info text-white"><?php echo ($category_data["ca_id"]) ?></td>
                                                <td class="bg-secondary text-white text-center"><?php echo ($category_data["ca_name"]) ?></td>

                                            </tr>

                                    <?php

                                        }
                                    }

                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 p-2 border border-3 border-bottom-0 border-top-0 border-end-0">
                    <div class="col-12 d-flex">
                        <div class="col-6 p-2">
                            <p class="text-secondary">Brand</p>
                            <select class="form-select shadow-none" id="selectBrandId">
                                <option value="0" selected>Select Brand</option>
                                <?php
                                $Brand_rs = Database::Search("SELECT * FROM `brand`");
                                $Brand_num = $Brand_rs->num_rows;

                                if ($Brand_num != 0) {
                                    for ($ct = 0; $ct < $Brand_num; $ct++) {
                                        $Brand_data = $Brand_rs->fetch_assoc();
                                ?>
                                        <option value="<?php echo ($Brand_data["b_id"]); ?>"><?php echo ($Brand_data["b_name"]); ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <div class="input-group mb-3 mt-2">
                                <input type="text" class="form-control" id="bId" placeholder="Enter New Brand" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-dark" type="button" id="button-addon2" onclick="addBrand()">+ Add</button>
                            </div>
                        </div>
                        <div class="col-6 p-2">
                            <p class="text-secondary">Model</p>
                            <select class="form-select shadow-none" id="selectModelId">
                                <option value="0" selected>Select Model</option>
                                <?php
                                $Model_rs = Database::Search("SELECT * FROM `model`");
                                $Model_num = $Model_rs->num_rows;

                                if ($Model_num != 0) {
                                    for ($ct = 0; $ct < $Model_num; $ct++) {
                                        $Model_data = $Model_rs->fetch_assoc();
                                ?>
                                        <option value="<?php echo ($Model_data["m_id"]); ?>"><?php echo ($Model_data["m_name"]); ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <div class="input-group mb-3 mt-2">
                                <input type="text" class="form-control" id="mId" placeholder="Enter New Model" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-dark" type="button" id="button-addon2" onclick="addModel()">+ Add</button>
                            </div>
                            <div class="col-12 text-end">
                                <button class="btn btn-outline-dark" type="button" id="button-addon2" onclick="addModelBrandConnection()">+ Connection</button>
                            </div>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="table-responsive" style="height: 45vh;">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="bg-info text-white">Brand Id</th>
                                        <th scope="col" class="bg-secondary text-white">Brand Name</th>
                                        <th scope="col" class="bg-info text-white">Model Id</th>
                                        <th scope="col" class="bg-secondary text-white">Model Name</th>
                                    </tr>
                                </thead>
                                <tbody id="ProductSearchveiw">
                                    <?php
                                    $model_rs = Database::Search("SELECT * FROM `model_has_brand` 
                                                                     INNER JOIN `model` ON `model`.`m_id`=`model_has_brand`.`model_id`
                                                                     INNER JOIN `brand` ON `brand`.`b_id`=`model_has_brand`.`brand_id`");
                                    $model_num = $model_rs->num_rows;

                                    if ($model_num != 0) {

                                        for ($x = 0; $x < $model_num; $x++) {
                                            $model_data = $model_rs->fetch_assoc();

                                    ?>
                                            <tr>
                                                <td class="bg-info text-white"><?php echo ($model_data["brand_id"]) ?></td>
                                                <td class="bg-secondary text-white text-center"><?php echo ($model_data["b_name"]) ?></td>
                                                <td class="bg-info text-white"><?php echo ($model_data["model_id"]) ?></td>
                                                <td class="bg-secondary text-white text-center"><?php echo ($model_data["m_name"]) ?></td>

                                            </tr>

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
    include "footer.php"
    ?>

    <!-- toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="resources/logo.svg" height="30px">
                <strong class="ms-auto fs-6 text-black-50 fw-bold"></strong>
                <small>1 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body fw-bold" id="toastCbody">
            </div>
        </div>
    </div>
    <!-- toast -->

    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>