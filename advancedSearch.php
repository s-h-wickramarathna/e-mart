<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emart || Advanced Search</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="aos.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 mb-2 bg-light">
                <div class="row py-1 d-flex justify-content-end p-2">

                    <div class="col-3">
                        <div class="fs-3 mt-0"> <a href="#" class="aclass"><span class="namef">E</span>mart</a></div>
                    </div>

                    <div class="col-9 text-end">
                        <p class="fs-3 fw-bold m-0 mt-4">My Advanced Search ...</p>
                    </div>



                </div>
            </div>

            <!-- search Options -->
            <div class="col-12">
                <div class="row">

                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button fs-4 fw-bold bg-light text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">Filter Options ....</button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">

                                    <div class="col-12">
                                        <div class="row">

                                            <!-- options -->
                                            <div class="col-4 col-md-3 mt-3 border-end">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="m-0 fw-bold mb-2">Select Category</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <select class="form-select shadow-none" id="p_category" onchange="showSize();">
                                                            <option value="0">all category</option>
                                                            <?php

                                                            require "connection.php";

                                                            $category_rs = Database::Search("SELECT * FROM `category`");
                                                            $category_num = $category_rs->num_rows;

                                                            for ($c = 0; $c < $category_num; $c++) {
                                                                $category_data = $category_rs->fetch_assoc();

                                                            ?>
                                                                <option value="<?php echo ($category_data["ca_id"]) ?>"><?php echo ($category_data["ca_name"]) ?></option>
                                                            <?php
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- options -->

                                            <!-- options -->
                                            <div class="col-4 col-md-3 mt-3 border-end">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="m-0 fw-bold mb-2">Select Brand</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <select class="form-select shadow-none" id="p_brand" onchange="loadAmodels();">
                                                            <option value="0">all brand</option>
                                                            <?php

                                                            $brand_rs = Database::Search("SELECT * FROM `brand`");
                                                            $brand_num = $brand_rs->num_rows;

                                                            for ($c = 0; $c < $brand_num; $c++) {
                                                                $brand_data = $brand_rs->fetch_assoc();

                                                            ?>
                                                                <option value="<?php echo ($brand_data["b_id"]) ?>"><?php echo ($brand_data["b_name"]) ?></option>
                                                            <?php
                                                            }

                                                            ?>
                                                        </select>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- options -->

                                            <!-- options -->
                                            <div class="col-4 col-md-3 mt-3 border-end">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="m-0 fw-bold mb-2">Select Model</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <select class="form-select shadow-none" id="p_model">
                                                            <option value="0">first select brand</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- options -->

                                            <!-- options -->
                                            <div class="col-4 col-md-3 mt-3 border-end">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="m-0 fw-bold mb-2">Select Colour</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <select class="form-select shadow-none" id="p_colour">
                                                            <option value="0">all colour</option>
                                                            <?php

                                                            $colour_rs = Database::Search("SELECT * FROM `colour`");
                                                            $colour_num = $colour_rs->num_rows;

                                                            for ($c = 0; $c < $colour_num; $c++) {
                                                                $colour_data = $colour_rs->fetch_assoc();

                                                            ?>
                                                                <option value="<?php echo ($colour_data["clr_id"]) ?>"><?php echo ($colour_data["clr_name"]) ?></option>
                                                            <?php
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- options -->

                                            <!-- options -->
                                            <div class="col-4 col-md-3 mt-3 border-end">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="m-0 fw-bold mb-2">Select Condition</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <select class="form-select shadow-none" id="p_condition">
                                                            <option value="0">all Condition</option>
                                                            <?php

                                                            $condition_rs = Database::Search("SELECT * FROM `condition`");
                                                            $condition_num = $condition_rs->num_rows;

                                                            for ($c = 0; $c < $condition_num; $c++) {
                                                                $condition_data = $condition_rs->fetch_assoc();

                                                            ?>
                                                                <option value="<?php echo ($condition_data["co_id"]) ?>"><?php echo ($condition_data["co_name"]) ?></option>
                                                            <?php
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- options -->
                                            <!-- options -->
                                            <div class="col-4 col-md-3 mt-3 border-end">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="m-0 fw-bold mb-2">Select Quentity</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <select class="form-select shadow-none" id="p_qty">
                                                            <option value="0">all quentity</option>
                                                            <option value="1">High To Low</option>
                                                            <option value="2">Low To High</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- options -->
                                            <!-- options -->
                                            <div class="col-4 col-md-3 mt-3 border-end">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="m-0 fw-bold mb-2">Price To</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="number" class="form-control shadow-none" placeholder="LKR : 00.00" id="p_priceto">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- options -->
                                            <!-- options -->
                                            <div class="col-4 col-md-3 mt-3 border-end">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="m-0 fw-bold mb-2">Price From</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="number" class="form-control shadow-none" placeholder="LKR : 00.00" id="p_pricefrom">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- options -->
                                            <!-- options -->
                                            <div class="col-4 col-md-3 mt-3 border-end d-none" id="siziDiv">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="m-0 fw-bold mb-2">Select Size</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <select class="form-select shadow-none" id="p_size">

                                                            <?php

                                                            $size_rs = Database::Search("SELECT * FROM `size`");
                                                            $size_num = $size_rs->num_rows;

                                                            for ($s = 0; $s < $size_num; $s++) {
                                                                $size_data = $size_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo ($size_data["size_id"]) ?>"><?php echo ($size_data["size_name"]) ?></option>
                                                            <?php
                                                            }

                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- options -->
                                            <!-- options -->
                                            <div class="col-9 col-md-6 offset-3 offset-md-6 mt-3" id="SearchbarDIV">
                                                <div class="input-group">
                                                    <input type="text" class="form-control shadow-none" placeholder="Search Products ...." id="p_searchtxt">
                                                    <button class="btn btn-primary" onclick="AdvancedSearch();">Search</button>
                                                </div>
                                            </div>
                                            <!-- options -->

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- search Options -->

            <div class="col-12">
                <div class="row justify-content-center" id="veiw_resultDIV">

                    <!-- before Search -->
                    <div class="col-12 bg-light">
                        <div class="row text-center">

                            <div class="col-12">
                                <img src="resources/before_advanced_search.gif" class="img-fluid">
                            </div>

                        </div>
                    </div>
                    <!-- before Search -->

                </div>
            </div>

            <?php include "footer.php"; ?>

        </div>
    </div>


    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>