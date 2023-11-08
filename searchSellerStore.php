<?php

session_start();
$s_nic = $_SESSION["seller"]["nic"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emart Seller Search Products</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="aos.css">
</head>

<body class="bg-body">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light">
                <div class="row mt-2 mb-1">

                    <div class="col-12 col-lg-4">
                        <div class="row text-center">
                            <div class="col-12"><img src="resources/user_profile_img/userprofile.png" height="200px"></div>
                            <p class="fw-bold fs-4 text-black-50">Sarasavi.pvt.ltd</p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 mt-3">
                        <div class="row">
                            <div class="col-12 text-center text-lg-start">
                                <p class="fs-2 fw-bold">Search Your Own Products ....</p>
                            </div>
                            <div class="col-12 text-center text-lg-start">
                                <p class="fs-5">You can sell any kind of product that you like in the way you like through our website in the most profitable way. But there are conditions. </p>
                            </div>
                            <div class="col-12 d-flex justify-content-center justify-content-lg-end align-items-end mt-2 mt-lg-4">
                                <button class="btn btn-outline-dark" onclick="window.location='sellerpanel.php'">Go To Home Page</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3 col-xl-3 bg-light mt-4 mb-3 rounded-2 shadow border border-3 border-dark">
                <div class="row">
                    <div class="col-12 my-2">
                        <p class="fs-4 fw-bold">Filter Products >></p>
                    </div>
                    <hr>
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control shadow-none" placeholder="Search Product ...." id="search_bar" />
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="EraseFilterSearchText();"><i class="bi bi-x-lg"></i></button>
                        </div>

                    </div>
                    <hr>
                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 mt-3 mb-2">
                                <p class="m-0 fs-6 fw-bold">By condition :-</p>
                            </div>
                            <div class="col-12 ps-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input shadow-none" type="checkbox" id="brandnew">
                                    <label class="form-check-label" for="inlineCheckbox1">Brandnew</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input shadow-none" type="checkbox" id="used">
                                    <label class="form-check-label" for="inlineCheckbox1">Used</label>
                                </div>
                            </div>
                            <div class="col-12 mt-2 mb-2">
                                <p class="m-0 fs-6 fw-bold">By Category :-</p>
                            </div>
                            <div class="col-12 mb-3">
                                <select class="form-control shadow-none" id="category">
                                    <option value="0">Select Category</option>
                                    <?php

                                    require "connection.php";

                                    $ca_rs = Database::Search("SELECT * FROM `category` ");
                                    $ca_num = $ca_rs->num_rows;

                                    for ($i = 0; $i < $ca_num; $i++) {
                                        $ca_data = $ca_rs->fetch_assoc();

                                    ?>
                                        <option value="<?php echo ($ca_data["ca_id"]) ?>"><?php echo ($ca_data["ca_name"]) ?></option>
                                    <?php

                                    }

                                    ?>

                                </select>
                            </div>

                            <div class="col-12 mt-2 mb-2">
                                <p class="m-0 fs-6 fw-bold">By Brand :-</p>
                            </div>
                            <div class="col-12 mb-3">
                                <select class="form-control shadow-none" id="brand" onchange="sellerFilterbrand();">
                                    <option value="">Select Brand</option>
                                    <?php

                                    $brand_rs = Database::Search("SELECT * FROM `brand` ");
                                    $brand_num = $brand_rs->num_rows;

                                    for ($x = 0; $x < $brand_num; $x++) {
                                        $brand_data = $brand_rs->fetch_assoc();

                                    ?>
                                        <option value="<?php echo ($brand_data["b_id"]) ?>"><?php echo ($brand_data["b_name"]) ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>

                            <div class="col-12 mt-2 mb-2">
                                <p class="m-0 fs-6 fw-bold">By Model :-</p>
                            </div>
                            <div class="col-12 mb-3">
                                <select class="form-control shadow-none" id="model">
                                    <option value="0">Select Model</option>
                                </select>
                            </div>

                            <div class="col-12 mt-2 mb-2">
                                <p class="m-0 fs-6 fw-bold">By Colour :-</p>
                            </div>
                            <div class="col-12 mb-3">
                                <select class="form-control shadow-none" id="colour">
                                    <option value="">Select Colour</option>
                                    <?php

                                    $colour_rs = Database::Search("SELECT * FROM `colour` ");
                                    $colour_num = $colour_rs->num_rows;

                                    for ($x = 0; $x < $colour_num; $x++) {
                                        $colour_data = $colour_rs->fetch_assoc();

                                    ?>
                                        <option value="<?php echo ($colour_data["clr_id"]) ?>"><?php echo ($colour_data["clr_name"]) ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>

                            <div class="col-12 mt-2 mb-2">
                                <p class="m-0 fs-6 fw-bold">By Quentity :-</p>
                            </div>
                            <div class="col-12 mb-3">
                                <select class="form-control shadow-none" id="quentity">
                                    <option value="0">Select Quentity</option>
                                    <option value="1">High to Low</option>
                                    <option value="2">Low to High</option>
                                </select>
                            </div>
                            <div class="col-12 mt-2 mb-2">
                                <p class="m-0 fs-6 fw-bold">By Price : LKR :-</p>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="number" class="form-control shadow-none" placeholder="To" id="priceTo" />
                            </div>
                            <div class="col-6 mb-3">
                                <input type="number" class="form-control shadow-none" placeholder="From" id="PriceFrom" />
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 d-grid mt-2 mb-2">
                                <button class="btn btn-outline-dark" onclick="window.location.reload();">Cancel</button>
                            </div>
                            <div class="col-6 d-grid mt-2 mb-2">
                                <button class="btn btn-primary" onclick="sellerProductfiter(1);">Search</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 col-xl-9 bg-body">
                <div class="row" id="loadProducts">

                    <div class="col-12 mb-2">
                        <div class="row mb-2 d-flex justify-content-center gap-2 gap-lg-4 mt-4">

                            <?php

                            $pageno = 1;


                            $pd_rs = Database::Search("SELECT * FROM `product` WHERE `seller_nic`='" . $s_nic . "' ");
                            $pd_num = $pd_rs->num_rows;

                            $result_per_page = 8;
                            $number_of_pages = ceil($pd_num / $result_per_page);

                            $page_result = ($pageno - 1) * $result_per_page;

                            $p_rs = Database::Search("SELECT * FROM `product` WHERE `seller_nic`='" . $s_nic . "' LIMIT " . $result_per_page . " OFFSET " . $page_result . " ");
                            $p_num = $p_rs->num_rows;

                            if ($p_num == 0) {
                            ?>

                                <div class="col-12 mt-5">
                                    <div class="row text-center">
                                    <p class="fw-bold fs-3 text-black-50 mb-5">No Product Found ?????</p>
                                        <div class="col-12"><img src="resources/EmptyPurchasedGIF.gif" class="img-fluid rounded-2"></div>
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

                    <div class="col-12 mt-3 mb-3 d-flex justify-content-center">
                        <div class="row text-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" <?php if ($pageno <= 1) {
                                                                    echo ("#");
                                                                } else {
                                                                ?> onclick="paginationSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                        } ?> aria-label="Previous">
                                            <span aria-hidden="true" class="cursor">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php

                                    for ($x = 1; $x <= $number_of_pages; $x++) {
                                        if ($x == $pageno) {
                                    ?>
                                            <li class="page-item active cursor">
                                                <a class="page-link" onclick="paginationSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                                            </li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="page-item cursor">
                                                <a class="page-link" onclick="paginationSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }

                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                                    echo ("#");
                                                                } else {
                                                                ?> onclick="paginationSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                        } ?> aria-label="Next">
                                            <span aria-hidden="true" class="cursor">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
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