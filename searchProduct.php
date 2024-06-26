<!DOCTYPE html>
<html>

<?php
session_start();
require "connection.php";
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emart || Search Products</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="icon" href="resources/logo.svg" />


</head>

<body>

    <div class="container-fluid bg-light">
        <div class="row">

            <?php


            $text = "0";
            $category;
            $q = "SELECT * FROM `product`";

            if (isset($_GET["t"])) {
                $text = $_GET["t"];
                $q .= " WHERE `title` LIKE '%" . $text . "%' AND `status_s_id`='1' AND `admin_status`='1' ";
                $category = 0;
            } else if (isset($_GET["text"])) {
                $text = $_GET["text"];
                $q .= " WHERE `title` LIKE '%" . $text . "%' AND `status_s_id`='1' AND `admin_status`='1' ";
                $category = 0;
            } else if (isset($_GET["txt"])) {
                $text = $_GET["txt"];
                $q .= " WHERE `title` LIKE '%" . $text . "%' AND `status_s_id`='1' AND `admin_status`='1' ";
                $category = 0;
            } else if (isset($_GET["c"])) {
                $category = $_GET["c"];
                $q .= " WHERE `category_ca_id`='" . $category . "' AND `status_s_id`='1' AND `admin_status`='1' ";
                $text = "0";
            }

            $product_rs = Database::Search($q);
            $product_num = $product_rs->num_rows;

            ?>

            <div class="col-12">
                <div class="row">

                    <div class="col-3 col-md-2 col-lg-2">
                        <div class="fs-3 ms-0 ms-lg-3"> <a href="#" class="aclass"><span class="namef">E</span>mart</a></div>
                    </div>

                    <div class="col-9 col-md-4">
                        <div class="input-group mt-3 pt-1">
                            <input type="text" class="form-control shadow-none" placeholder="Search ..." value="<?php if ($text != "0") {
                                                                                                                    echo ($text);
                                                                                                                } ?>" id="searchProduct">
                            <button class="btn btn-outline-primary" type="button" id="" onclick="SearchPRoducttxt();"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                    <div class="col-8 ms-3 ms-md-0 col-md-3 col-lg-4 mt-md-3">
                        <div class="row d-grid pt-1">
                            <select class="form-select shadow-none" id="category01" onchange="loadSearchCategory();">
                                <option value="0">Search Category</option>
                                <?php

                                $category_rs = Database::Search(" SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($i = 0; $i < $category_num; $i++) {
                                    $category_data = $category_rs->fetch_assoc();

                                    if ($category_data["ca_id"] == $category) {
                                ?>
                                        <option value="<?php echo ($category_data["ca_id"]) ?>" selected><?php echo ($category_data["ca_name"]) ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?php echo ($category_data["ca_id"]) ?>"><?php echo ($category_data["ca_name"]) ?></option>
                                <?php
                                    }
                                }

                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-3 ms-3 ms-md-0 col-md-3 col-lg-2 px-md-4 text-center mt-1 mt-md-2 mb-2">
                        <div class="row pt-0 pt-md-2 text-center">
                            <button type="button" class="btn btn-dark" onclick="window.location='cart.php'">
                                <i class="bi bi-cart4 cursor fs-5" ></i>
                                <?php

                                $veiw_s = Database::Search("SELECT * FROM `cart` WHERE `veiw_status`='0' ");
                                $veiw_num = $veiw_s->num_rows;
                                if ($veiw_num == 0) {
                                ?>
                                    <span class="badge text-bg-danger d-none"></span>
                                <?php
                                } else {
                                ?>
                                    <span class="badge text-bg-danger"><?php echo ($veiw_num); ?></span>
                                <?php
                                }
                                ?>

                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 mb-2">
                <div class="row">

                    <div class="col-9 col-md-10">
                        <hr>
                    </div>

                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 bg-body col-xl-3 mb-3 shadow rounded-end">
                <div class="row">

                    <div class="col-12 mt-2">
                        <p class="fs-5 fw-bold">Sort Products >></p>
                    </div>

                    <div class="col-12">
                        <hr class="border border-2 border-dark">
                    </div>

                    <div class="col-12">
                        <div class="row overflow-auto" style="height: 85vh;">
                            <div class="col-12">
                                <p class="ms-2 fw-bold">By Condition ...</p>
                            </div>

                            <div class="col-12 ps-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input shadow-none" type="checkbox" id="Bn" onchange="SearchPRoductfilter();">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Brandnew
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input shadow-none" type="checkbox" id="Us" onchange="SearchPRoductfilter();">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Used
                                    </label>
                                </div>
                            </div>

                            <div class="col-6">
                                <hr class="">
                            </div>

                            <div class="col-12">
                                <p class="ms-2 fw-bold">By Quentity ...</p>
                            </div>

                            <div class="col-12 ps-4">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="radio" name="flexRadioDefault" id="Hl" onchange="SearchPRoductfilter();">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        High to low
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="radio" name="flexRadioDefault" id="Lh" onchange="SearchPRoductfilter();">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Low to high
                                    </label>
                                </div>
                            </div>

                            <div class="col-6">
                                <hr class="">
                            </div>

                            <div class="col-12">
                                <p class="ms-2 fw-bold">By Colour ...</p>
                            </div>

                            <div class="col-12 ps-4">
                                <select class="form-select shadow-none" id="colourFilter" onchange="SearchPRoductfilter();">
                                    <option value="0">Search By Colour</option>
                                    <?php

                                    $colour_rs = Database::Search("SELECT * FROM `colour` ");
                                    $colour_num = $colour_rs->num_rows;

                                    for ($a = 0; $a < $colour_num; $a++) {
                                        $colour_data = $colour_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($colour_data["clr_id"]) ?>"><?php echo ($colour_data["clr_name"]) ?></option>
                                    <?php
                                    }

                                    ?>


                                </select>
                            </div>

                            <div class="col-6">
                                <hr class="">
                            </div>

                            <div class="col-6">
                                <hr class="">
                            </div>

                            <div class="col-12">
                                <p class="ms-2 fw-bold">By Price ...</p>
                            </div>

                            <div class="col-12 ps-4">
                                <div class="row">
                                    <div class="col-12 mb-1">

                                        <input type="number" class="form-control shadow-none" placeholder=" to" id="pt" onkeyup="SearchPRoductfilter();">

                                    </div>

                                    <div class="col-12 text-center mt-1 mb-1">
                                        <span>--- Price ---</span>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <input type="number" class="form-control shadow-none" placeholder=" from" id="pf" onkeyup="SearchPRoductfilter();">
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-6 col-sm-8 col-md-9 col-xl-9" style="height: 100vh;">
                <div class="row justify-content-center" id="loadSearchProductDiv">

                    <?php

                    if ($product_num == 0) {
                    ?>

                        <div class="col-12 bg-body">
                            <div class="row">
                                <div class="col-12 fs-5 fw-bold text-black-50 text-center  mt-3">
                                    Product Not Found
                                </div>
                                <div class="col-12 text-center">
                                    <img src="resources/emptySearchProducts.gif" height="500px" alt="" srcset="">
                                </div>
                            </div>
                        </div>

                    <?php

                    } else {

                    ?>

                        <?php

                        for ($i = 0; $i < $product_num; $i++) {

                            $product_data = $product_rs->fetch_assoc();

                            $p_img = "resources/emptyProducts.png";

                            $product_img_rs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $product_data["id"] . "' ");
                            $product_img_num = $product_img_rs->num_rows;

                            if ($product_img_num > 0) {
                                $product_img_data = $product_img_rs->fetch_assoc();
                                $p_img = $product_img_data["p_path"];
                            }

                        ?>

                            <div class="card p-0 d-lg-none shadow my-3 mx-2 cardHover" style="width: 13rem;" id="shortCard" onclick="goToSingleProductVeiw('<?php echo ($product_data['id']) ?>');">
                                <img src="<?php echo ($p_img) ?>" class="card-img-top p_img_hover img-fluid">
                                <div class="card-body">
                                    <div class="col-12">
                                        <?php
                                        $p_title_short = str_split($product_data["title"], 20);
                                        ?>
                                        <p class="fw-bold"><?php echo ($p_title_short[0] . " ...") ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="fs-5 fw-bold">LKR : <?php echo ($product_data["price"]) ?>.00</p>
                                    </div>
                                    <div class="col-12 text-end">
                                        <p class="text-black-50 fw-bold"><?php echo ($product_data["date_time"]) ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3 d-none d-lg-block shadow cardHover" style="max-width: 90%;" id="longCard" onclick="goToSingleProductVeiw('<?php echo ($product_data['id']) ?>');">
                                <div class="row g-0">
                                    <div class="col-md-4 col-lg-4 col-xl-3 overflow-hidden">
                                        <img src="<?php echo ($p_img) ?>" class="p_img_hover img-fluid">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">

                                            <div class="col-12 mb-2">
                                                <?php
                                                $p_title_long = str_split($product_data["title"], 50);
                                                ?>
                                                <a class="fw-bold textcolor mb-5"><?php echo ($p_title_long[0] . " ...") ?></a>
                                            </div>

                                            <div class="col-12">
                                                <p class="m-0">LKR : <span class="fs-4 fw-bold text"><?php echo ($product_data["price"]) ?>.00</span> Buy It Now</p>
                                            </div>

                                            <?php

                                            $ship;

                                            if (isset($_SESSION["user"])) {
                                                $user_email = $_SESSION["user"]["email"];

                                                $user_rs = Database::Search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `user_has_address`.`city_id`=`city`.`ci_id` WHERE `user_email`='" . $user_email . "' ");
                                                $user_num = $user_rs->num_rows;

                                                if ($user_num == 0) {
                                                    $ship = "$$$$$";
                                                } else {

                                                    $user_data = $user_rs->fetch_assoc();

                                                    if ($user_data["distric_id"] == 1) {
                                                        $ship = $product_data["cost_colombo"];
                                                    } else {
                                                        $ship = $product_data["cost_others"];
                                                    }
                                                }
                                            ?>
                                            <?php

                                            } else {

                                                $ship = "$$$$$";
                                            }
                                            ?>

                                            <div class="col-12">
                                                <p class="m-0">shipping : LKR . <?php echo ($ship) ?></p>
                                            </div>

                                            <?php

                                            $invoice_rs = Database::Search("SELECT * FROM `invoice` WHERE `product_id`='" . $product_data["id"] . "' ");
                                            $invoice_num = $invoice_rs->num_rows;

                                            ?>

                                            <div class="col-12">
                                                <p class="m-0"><?php echo ($invoice_num) ?> Sold</p>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-6">

                                                        <?php

                                                        $seller_from = "0";

                                                        $seller_rs = Database::Search("SELECT * FROM `seller` 
                                                    INNER JOIN `user` ON `seller`.`user_email`=`user`.`email`
                                                    INNER JOIN `user_has_address` ON `user`.`email`=`user_has_address`.`user_email`
                                                    INNER JOIN `city` ON `user_has_address`.`city_id`=`city`.`ci_id`
                                                    WHERE `nic` = '" . $product_data['seller_nic'] . "' ");
                                                        $seller_num = $seller_rs->num_rows;

                                                        if ($seller_num == 0) {
                                                            $seller_from = "---------";
                                                        } else {
                                                            $seller_data = $seller_rs->fetch_assoc();
                                                            $seller_from = $seller_data["ci_name"];
                                                        }


                                                        ?>

                                                        <p class=" mt-1">from : <?php echo ($seller_from) ?></p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="fw-bold">Top Rated Seller</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 text-end">
                                                <div class="row">
                                                    <div class="col-12 text-end">
                                                        <p class="text-black-50 fw-bold"><?php echo ($product_data["date_time"]) ?></p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                        }

                        ?>

                </div>

            <?php

                    }

            ?>



            </div>


            <div class="col-12 border-top border-3 border-dark mt-2">
                <div class="row mt-4 justify-content-center">

                    <div class="col-12">
                        <div class="row">
                            <div class="col-3 col-md-4">
                                <hr class="border border-3 border-dark">
                            </div>
                            <div class="col-6 col-md-4 fs-4 fw-bold text-center text-black-50">ALL PRODUCTS</div>
                            <div class="col-3 col-md-4">
                                <hr class="border border-3 border-dark">
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row justify-content-center">
                            <?php

                            $p_rs = Database::Search("SELECT * FROM `product` WHERE `status_s_id`='1' AND `admin_status`='1' ");
                            $p_num = $p_rs->num_rows;

                            $p_imgall = "resources/emptyProducts.png";

                            for ($x = 0; $x < $p_num; $x++) {
                                $p_data = $p_rs->fetch_assoc();

                                $p_img_rs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $p_data["id"] . "' ");
                                $p_img_num = $p_img_rs->num_rows;

                                if ($p_img_num > 0) {
                                    $p_img_data = $p_img_rs->fetch_assoc();
                                    $p_imgall = $p_img_data["p_path"];
                                    
                                }

                            ?>
                                <div class="card p-0 shadow my-3 mx-2 cardHover" style="width: 13rem;" id="shortCard" onclick="goToSingleProductVeiw('<?php echo ($product_data['id']) ?>');">
                                    <img src="<?php echo ($p_imgall) ?>" class="card-img-top p_img_hover img-fluid">
                                    <div class="card-body">
                                        <div class="col-12">
                                            <?php
                                            $p_title_shortall = str_split($p_data["title"], 18);
                                            ?>
                                            <p class="fw-bold"><?php echo ($p_title_shortall[0] . " ...") ?></p>
                                        </div>
                                        <div class="col-12">
                                            <p class="fs-5 fw-bold">LKR : <?php echo ($p_data["price"]) ?>.00</p>
                                        </div>
                                        <div class="col-12 text-end">
                                            <p class="text-black-50 fw-bold"><?php echo ($p_data["date_time"]) ?></p>
                                        </div>
                                    </div>
                                </div>

                            <?php

                            }

                            ?>
                        </div>
                    </div>

                </div>
            </div>


            <?php include "footer.php" ?>

        </div>
    </div>



    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>