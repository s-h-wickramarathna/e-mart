<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emart || Add Products</title>

    <link rel="icon" href="resources/company-logo.png" />

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/logo.svg">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light">
                <div class="row mt-2 mb-1">

                    <div class="col-12 col-lg-4 bg-light">
                        <div class="row text-center">
                            <div class="col-12"><img src="resources/user_profile_img/userprofile.png" height="200px"></div>
                            <p class="fw-bold fs-4 text-black-50">Sarasavi.pvt.ltd</p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 mt-3">
                        <div class="row">
                            <div class="col-12 text-center text-lg-start">
                                <p class="fs-2 fw-bold">Add Your Own Products ....</p>
                            </div>
                            <div class="col-12 text-center text-lg-start">
                                <p class="fs-5">You can sell any kind of product that you like in the way you like through our website in the most profitable way. But there are conditions ..... </p>
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

                    <!-- row -->
                    <div class="col-12 border-bottom">
                        <div class="row mt-2 mb-2">

                            <?php
                            require "connection.php";

                            $catedory_rs = Database::Search("SELECT * FROM `category`");
                            $catedory_num = $catedory_rs->num_rows;

                            ?>

                            <!-- item -->
                            <div class="col-6 col-lg-4 border-end mt-3 mb-3">
                                <p class="fw-bold">Select Product Category :-</p>
                                <select class="form-select shadow-none" id="a_category" onchange="seeproductSize();">
                                    <option>Select Your Category</option>
                                    <?php

                                    for ($i = 0; $i < $catedory_num; $i++) {
                                        $catedory_data = $catedory_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($catedory_data["ca_id"]) ?>"><?php echo ($catedory_data["ca_name"]) ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <!-- item -->
                            <!-- item -->
                            <div class="col-6 col-lg-4 mt-3 mb-3">
                                <p class="fw-bold">Select Product Brand :-</p>
                                <?php
                                $brand_rs = Database::Search("SELECT * FROM `brand`");
                                $brand_num = $brand_rs->num_rows;
                                ?>
                                <select class="form-select shadow-none" id="a_brand" onchange="filter_model();">
                                    <option>Select Your Brand</option>
                                    <?php

                                    for ($x = 0; $x < $brand_num; $x++) {
                                        $brand_data = $brand_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($brand_data["b_id"]) ?>"><?php echo ($brand_data["b_name"]) ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <!-- item -->
                            <!-- item -->
                            <div class="col-12 col-lg-4 mt-3 mb-3">
                                <p class="fw-bold">Select Product Model :-</p>
                                <?php
                                $model_rs = Database::Search("SELECT * FROM `model`");
                                $model_num = $model_rs->num_rows;
                                ?>
                                <select class="form-select shadow-none" id="a_model">
                                    <option value="">Select model</option>
                                    <?php

                                    for ($s = 0; $s < $model_num; $s++) {
                                        $model_data = $model_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($model_data["m_id"]) ?>"><?php echo ($model_data["m_name"]) ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <!-- item -->

                        </div>
                    </div>
                    <!-- row -->
                    <div class="col-12 border-bottom">
                        <div class="row mt-2 mb-2">

                            <div class="col-12 mt-3 mb-3">
                                <p class="fw-bold">Enter Product Title :-</p>
                                <input type="text" class="form-control me-3 shadow-none" id="p_title">
                            </div>

                            <hr>

                            <!-- item -->
                            <div class="col-6 col-lg-4 border-end mt-3 mb-3">
                                <p class="fw-bold">Select Product Condition :-</p>
                                <?php
                                $condition_rs = Database::Search("SELECT * FROM `condition`");
                                $condition_num = $condition_rs->num_rows;
                                ?>
                                <select class="form-select shadow-none" id="a_condition">
                                    <option value="">Select Condition</option>
                                    <?php

                                    for ($y = 0; $y < $condition_num; $y++) {
                                        $condition_data = $condition_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($condition_data["co_id"]) ?>"><?php echo ($condition_data["co_name"]) ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <!-- item -->
                            <!-- item -->
                            <div class="col-6 col-lg-4 mt-3 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="fw-bold">Select Product Colour :-</p>
                                        <?php
                                        $colour_rs = Database::Search("SELECT * FROM `colour`");
                                        $colour_num = $colour_rs->num_rows;
                                        ?>
                                        <select class="form-select mt-3 mb-3 shadow-none" id="a_colour">
                                            <option value="">Select Colour</option>
                                            <?php

                                            for ($za = 0; $z < $colour_num; $z++) {
                                                $colour_data = $colour_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo ($colour_data["clr_id"]) ?>"><?php echo ($colour_data["clr_name"]) ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="new colour ...." id="addColourbar">
                                            <button class="btn btn-secondary" type="button" onclick="AddColour();">+ Add</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- item -->
                            <!-- item -->
                            <div class="col-12 col-lg-4 mt-3 mb-3">
                                <p class="fw-bold">Enter Product Quentity :-</p>
                                <input type="number" min="1" class="form-control shadow-none" placeholder="Enter Quentity" id="a_quentity">
                            </div>
                            <!-- item -->

                        </div>
                    </div>
                    <!-- row -->
                    <!-- row -->
                    <div class="col-12 border-bottom">
                        <div class="row mt-2 mb-2">

                            <!-- item -->
                            <div class="col-6 col-lg-3 border-end mt-3 mb-3 d-none" id="p_size_field">
                                <p class="fw-bold">Enter Product Size :-</p>
                                <?php
                                $size_rs = Database::Search("SELECT * FROM `size`");
                                $size_num = $size_rs->num_rows;
                                ?>
                                <select class="form-select shadow-none" id="a_productSize">
                                    <option value="">Select Size</option>
                                    <?php

                                    for ($z = 0; $z < $size_num; $z++) {
                                        $size_data = $size_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($size_data["size_id"]) ?>"><?php echo ($size_data["size_name"]) ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <!-- item -->
                            <!-- item -->
                            <div class="col-6 col-lg-4 border-end mt-3 mb-3" id="p_field">
                                <p class="fw-bold">Enter Product Price :-</p>
                                <input type="text" class="form-control shadow-none" placeholder="Rs : " id="a_price" />
                            </div>
                            <!-- item -->
                            <!-- item -->
                            <div class="col-6 col-lg-4 mt-3 mb-0" id="dc_field1">
                                <p class="fw-bold">Enter Delivary Cost :-</p>
                                <input type="text" class="form-control mt-1 mt-lg-0 shadow-none" placeholder=" Within Colombo" id="a_dc_cost" />
                            </div>
                            <!-- item -->
                            <!-- item -->
                            <div class="col-10 col-lg-4 mt-0 mt-lg-3 mb-3 offset-1 offset-lg-0" id="dc_field2">
                                <p class="fw-bold mt-lg-4 "></p>
                                <input type="text" class="form-control shadow-none" placeholder="Without Colombo" id="a_dw_cost" />
                            </div>
                            <!-- item -->
                        </div>
                    </div>
                    <!-- row -->
                    <div class="col-12 mt-3">
                        <p class="fw-bold">Product Description :-</p>
                        <textarea class="col-12 p-3" cols="30" rows="10" placeholder="Enter Your Own Valueble Product Description ...." id="a_desc"></textarea>
                    </div>
                    <!-- row -->
                    <div class="col-12 border-bottom mt-3 mb-3">
                        <div class="row mt-2 mb-2 d-flex justify-content-center">
                            <!-- item -->
                            <div class="col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center" id="addImg1">
                                <img src="resources/emptyProducts.png" height="150px" id="a_img0">
                            </div>
                            <!-- item -->
                            <!-- item -->
                            <div class="col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center" id="addImg2">
                                <img src="resources/emptyProducts.png" height="150px" id="a_img1">
                            </div>
                            <!-- item -->
                            <!-- item -->
                            <div class="col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center" id="addImg3">
                                <img src="resources/emptyProducts.png" height="150px" id="a_img2">
                            </div>
                            <!-- item -->
                            <!-- item -->
                            <div class="col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center" id="addImg4">
                                <img src="resources/emptyProducts.png" height="150px" id="a_img3">
                            </div>
                            <!-- item -->
                        </div>
                    </div>
                    <!-- row -->
                    <!-- row -->
                    <div class="col-12 mt-3 mb-3">
                        <div class="row text-center d-flex justify-content-center">
                            <div class="col-6 col-lg-4 d-grid">
                                <input type="file" class="d-none" id="a_imgChooser" multiple />
                                <label for="a_imgChooser" class="btn btn-primary" onclick="productImageView();">Upload Product Images</label>
                            </div>
                        </div>
                    </div>
                    <!-- row -->
                    <!-- row -->
                    <div class="col-12 mt-3">
                        <div class="row text-center d-flex justify-content-center">
                            <p class="fs-5 fw-bold text-black-50"> Notice :- We are taking 5% of the product from price from every product as a service charge</p>
                        </div>
                    </div>
                    <!-- row -->
                    <!-- row -->
                    <div class="col-12 border-bottom mt-3 mb-3">
                        <div class="row mt-2 mb-2 d-flex justify-content-center">

                            <div class="col-6">
                                <div class="row d-flex justify-content-center">
                                    <!-- item -->
                                    <div class="col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center">
                                        <img src="resources/payment_methods/visa_img.png" height="60px" alt="" srcset="">
                                    </div>
                                    <!-- item -->
                                    <!-- item -->
                                    <div class="col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center">
                                        <img src="resources/payment_methods/paypal_img.png" height="60px" alt="" srcset="">
                                    </div>
                                    <!-- item -->
                                    <!-- item -->
                                    <div class="col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center">
                                        <img src="resources/payment_methods/mastercard_img.png" height="60px" alt="" srcset="">
                                    </div>
                                    <!-- item -->
                                    <!-- item -->
                                    <div class="col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center">
                                        <img src="resources/payment_methods/american_express_img.png" height="60px" alt="" srcset="">
                                    </div>
                                    <!-- item -->
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- row -->

                    <div class="col-12 text-center mb-3">
                        <button class="btn btn-primary" onclick="addProduct();">Add Product</button>
                    </div>

                </div>
            </div>


            <hr class="mt-2 mb-2">

            <?php include "footer.php"; ?>

            <div class="toast-container position-fixed bottom-0 end-0 p-3" id="Ptoast">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-secondary text-white">
                        <img src="resources/logo.svg" height="30px" class="rounded me-2" alt="...">
                        <strong class="me-auto">Emart</strong>
                        <small>Massage</small>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-dark fw-bold text-white">
                        Your Product Sucessfully Addedd ...
                    </div>
                </div>
            </div>

            <!-- colour toast -->
            <!-- toast -->
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToastcolour" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <img src="resources/logo.svg" height="30px">
                        <strong class="ms-auto fs-6 text-black-50 fw-bold"></strong>
                        <small>1 mins ago</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body fw-bold" id="toastCbody">
                        Colour Successfully added ....
                    </div>
                </div>
            </div>
            <!-- toast -->
            <!-- colour toast -->

        </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>