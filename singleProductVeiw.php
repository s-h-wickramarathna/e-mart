<?php
session_start();
require "connection.php";

$user_Shipping = 0;
$unit_price = 0;
$isAddressHave = false;

if (isset($_GET["pid"]) && isset($_GET["s"])) {
    $p_id = $_GET["pid"];
    $review_count = $_GET["s"];



    $product_rs = Database::Search("SELECT * FROM `product` 
    INNER JOIN `seller` ON `product`.`seller_nic` = `seller`.`nic` 
    INNER JOIN `condition` ON `product`.`condition_id`=`condition`.`co_id` 
    INNER JOIN `colour` ON `product`.`colour_id`=`colour`.`clr_id`
    INNER JOIN `size`  ON `product`.`Size_id`=`size`.`size_id`
    INNER JOIN `model_has_brand` ON `product`.`model_has_brand_id`=`model_has_brand`.`m_h_b_id`
    INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`b_id` WHERE `id`='" . $p_id . "' ");

    $product_data = $product_rs->fetch_assoc();

    $seller = $product_data["nic"];

?>




    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Emart || Single Product View</title>

        <link rel="icon" href="resources/logo.png" />

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 mb-2 bg-light">
                    <div class="row py-1 d-flex justify-content-end p-2">

                        <div class="col-6 col-lg-3 border-end">
                            <div class="fs-3 mt-0"> <a href="#" class="aclass"><span class="namef">E</span>mart</a></div>
                        </div>
                        <div class="col-6 col-lg-5">
                            <div class="row">
                                <div class="col-12 mt-2">
                                    <p class="m-0 fw-bold fs-5"><?php echo ($product_data["shop_name"]); ?></p>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-md-4 mt-3">
                            <div class="row text-center">
                                <?php if (isset($_SESSION["user"])) {
                                ?>
                                    <div class="col-6 d-grid">
                                        <button class="btn btn-secondary text-white" onclick="addToCart('<?php echo ($p_id) ?>');"><i class="bi bi-cart-plus-fill fs-5"></i></button>
                                    </div>
                                    <div class="col-6 d-grid">
                                        <button class="btn btn-warning text-white" onclick="addToWatchList('<?php echo ($p_id) ?>');"><i class="bi bi-suit-heart-fill fs-5"></i></button>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-12">
                                        <button class="btn btn-outline-primary">Go SignIn Or SignUp To Access Cart & Watchlist</button>
                                    </div>
                                <?php
                                } ?>

                            </div>
                        </div>

                    </div>
                </div>

                <?php

                $img = array();

                $img[0] = "resources/noImage.jpg";
                $img[1] = "resources/noImage.jpg";
                $img[2] = "resources/noImage.jpg";
                $img[3] = "resources/noImage.jpg";

                $p_images_rs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $p_id . "' ");
                $p_images_num = $p_images_rs->num_rows;

                for ($x = 0; $x < $p_images_num; $x++) {
                    $p_images_data = $p_images_rs->fetch_assoc();

                    $img[$x] = $p_images_data["p_path"];
                }


                ?>

                <div class="col-12">
                    <div class="row">

                        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="5000">
                                    <div class="col-12 d-flex justify-content-center">
                                        <img src="<?php echo ($img[0]) ?>" class="d-block" height="400px">
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="5000">
                                    <div class="col-12 d-flex justify-content-center">
                                        <img src="<?php echo ($img[1]) ?>" class="d-block" height="400px">
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="5000">
                                    <div class="col-12 d-flex justify-content-center">
                                        <img src="<?php echo ($img[2]) ?>" class="d-block" height="400px">
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="5000">
                                    <div class="col-12 d-flex justify-content-center">
                                        <img src="<?php echo ($img[3]) ?>" class="d-block" height="400px">
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="row ms-1 mt-3 me-1">

                        <div class="col-12">
                            <div class="row">

                                <div class="col-12">
                                    <p class="m-0 mb-2 mt-2 fw-bold"><?php echo ($product_data["title"]); ?></p>
                                </div>
                                <div class="col-12">
                                    <span><i class="bi bi-eye-fill text-info"></i>&nbsp;&nbsp;</span>

                                    <?php

                                    $r_rs = Database::Search("SELECT * FROM `review` WHERE `product_id`='" . $p_id . "' ");
                                    $r_num = $r_rs->num_rows;

                                    $in_rs = Database::Search("SELECT * FROM `invoice` WHERE `product_id`='" . $p_id . "'  ");
                                    $in_num = $in_rs->num_rows;

                                    ?>

                                    <span class="fw-bold text-black-50"><?php echo ($r_num) ?> Reviews & <?php echo ($in_num) ?> items Sold</span>
                                </div>
                                <div class="col-12 mt-2">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <span class="cursor" onclick="showAllRates('<?php echo ($p_id) ?>');">All Rates >></span>
                                </div>


                                <div class="col-12 text-end">
                                    <span class="fw-bold text-black-50">Post On <?php echo ($product_data["date_time"]); ?></span>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 border-top border-bottom mb-3">
                            <p class="fw-bold fs-3 m-0 mt-1 mb-1">LKR :
                                <?php
                                $unit_price = $product_data["price"];
                                echo ($product_data["price"]);
                                ?>.00
                            </p>
                        </div>

                        <div class="col-6 mt-1 mb-1">
                            <span class="fw-bold">Condition :-</span> <?php echo ($product_data["co_name"]); ?>
                        </div>

                        <div class="col-6 mt-1 mb-1">
                            <span class="fw-bold">Colour :-</span> <?php echo ($product_data["clr_name"]); ?>
                        </div>

                        <div class="col-6 mt-1 mb-1">
                            <span class="fw-bold">Brand :-</span> <?php echo ($product_data["b_name"]); ?>
                        </div>

                        <div class="col-6 mt-1 mb-1">
                            <span class="fw-bold">Size :-</span> <?php echo ($product_data["size_name"]); ?>
                        </div>
                        <div class="col-12 col-lg-6 mt-1 mb-1">
                            <div class="row">
                                <div class="col-12">
                                    <span class="fw-bold">Quentity :</span><span class="text-black-50 fw-bold"> <?php echo ($product_data["qty"]) ?> Pieces Available</span>
                                </div>
                                <div class="col-5 mt-2">
                                    <input type="number" class="form-control shadow-none" value="1" min="1" max="<?php echo ($product_data["qty"]) ?>" id="buy_qty" oninput="handleQuantityChange(this)" />
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-1 mb-1">
                            <?php

                            if (isset($_SESSION["user"])) {

                                $user_email = $_SESSION["user"]["email"];

                                $rew_rs = Database::Search("SELECT * FROM `review` WHERE `product_id`='" . $p_id . "' AND `user_email`='" . $user_email . "' ");
                                $rew_num = $rew_rs->num_rows;

                                if ($rew_num == 0) {
                                    Database::iud("INSERT INTO `review` (`product_id`,`user_email`) VALUES
                                    ('" . $p_id . "','" . $user_email . "') ");
                                }

                                $user_rs = Database::Search("SELECT * FROM `user` 
                                INNER JOIN `user_has_address` ON `user`.`email`=`user_has_address`.`user_email`
                                INNER JOIN `city` ON `user_has_address`.`city_id`=`city`.`ci_id`
                                WHERE `email`='" . $user_email . "' ");
                                $user_num = $user_rs->num_rows;

                                if ($user_num == 0) {
                                    $isAddressHave = false;
                            ?>
                                    <span class="fw-bold">Ship to :-</span> <i class="bi bi-geo-alt-fill text-danger"></i><span>-----------</span>
                                    <p class="fs-4 fw-bold border-top border-bottom mt-2"><span class="fw-bold fs-5">Shipping</span> LKR : ------</p>

                                <?php
                                } else {
                                    $isAddressHave = true;
                                    $user_data = $user_rs->fetch_assoc();

                                    if ($user_data["ci_id"] == 1 && $user_data["ci_name"] == "Colombo") {

                                        $user_Shipping = $product_data["cost_colombo"];
                                    } else {
                                        $user_Shipping = $product_data["cost_others"];
                                    }

                                ?>
                                    <span class="fw-bold">Ship to :-</span> <i class="bi bi-geo-alt-fill text-danger"></i><span> <?php echo ($user_data["ci_name"]); ?></span>
                                    <p class="fs-4 fw-bold border-top border-bottom mt-2"><span class="fw-bold fs-5">Shipping</span> LKR : <?php echo ($user_Shipping); ?>.00</p>
                                <?php

                                }
                            } else {
                                ?>
                                <span class="fw-bold">Ship to :-</span> <i class="bi bi-geo-alt-fill text-danger"></i><span>-----------</span>
                                <p class="fs-4 fw-bold border-top border-bottom mt-2"><span class="fw-bold fs-5">Shipping</span> LKR : ------</p>

                            <?php
                            }

                            ?>

                        </div>

                        <div class="col-12 mb-3 fs-5 ps-4 text-end text-lg-start text-success">
                            <i class="bi bi-shield-fill-check text-success">&nbsp;&nbsp;</i><span class="fs-6"><span class="fw-bold">7 Days</span> Buyer Protection</span>
                        </div>

                        <div class="col-12">
                            <div class="row">

                                <div class="offset-8 col-4 d-grid">
                                    <?php

                                    if (isset($_SESSION["user"])) {
                                        if ($isAddressHave) {
                                    ?>
                                            <div id="paypal-button-container"></div>
                                        <?php
                                        } else {
                                        ?>
                                            <div id="paypal-button-container" hidden></div>
                                            <button type="button" class="btn btn-primary" onclick="window.location = 'userProfile.php'">Fill Shipping Information Before By</button>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div id="paypal-button-container" hidden></div>
                                        <button type="button" class="btn btn-primary" onclick="window.location = 'signin.php'">You Must Sign In Or Sign Up For Buy This Item</button>
                                    <?php
                                    }

                                    ?>

                                </div>

                            </div>

                        </div>

                        <div class="col-12">
                            <hr>
                        </div>

                        <div class="col-12">
                            <div class="row mb-3">

                                <!-- description -->

                                <div class="col-12 col-xl-6 mt-3">
                                    <div class="row">
                                        <div class="col-12 fw-bold fs-5">Description :-</div>

                                        <div class="col-12 border" style="height: 304px;">
                                            <div class="row overflow-auto">
                                                <p class="fs-6 p-3"><?php echo ($product_data["description"]) ?></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- description -->

                                <!-- feedbacks -->

                                <div class="col-12 col-xl-6 p-2 mt-2">
                                    <div class="row ms-1 me-1">
                                        <div class="col-12 fw-bold fs-5">Feedbacks :-</div>
                                        <div class="col-12 border">
                                            <div class="row justify-content-center overflow-auto" style="height: 300px;">

                                                <?php

                                                $feedaback_rs = Database::Search("SELECT * FROM `feedbacks`
                                                INNER JOIN `user` ON `feedbacks`.`user_email`=`user`.`email` WHERE `product_id`='" . $p_id . "' ");
                                                $feedaback_num = $feedaback_rs->num_rows;

                                                if ($feedaback_num == 0) {

                                                ?>

                                                    <div class="col-11 mb-3 mt-2 border" style="height: 130px;">
                                                        <div class="row m-0">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <p class="m-0 fs-6 fw-bold"></p>
                                                                    </div>
                                                                    <div class="col-6 text-end text-black-50"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 m-0 border-top">
                                                                <div class="row">
                                                                    <p class="fs-4 fw-bold text-black-50"> No Feedbacks Yet</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php

                                                } else {

                                                    for ($c = 0; $c < $feedaback_num; $c++) {
                                                        $feedaback_data = $feedaback_rs->fetch_assoc();

                                                    ?>

                                                        <div class="col-11 mb-3 mt-2 border" style="height: 130px;">
                                                            <div class="row m-0">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <p class="m-0 fs-6 fw-bold"><?php echo ($feedaback_data["fname"] . " " . $feedaback_data["lname"]) ?></p>
                                                                        </div>
                                                                        <div class="col-6 text-end text-black-50"><?php echo ($feedaback_data["f_datetime"]) ?></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 m-0 border-top" style="height: 100px;">
                                                                    <div class="row">
                                                                        <p><?php echo ($feedaback_data["f_content"]) ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                <?php

                                                    }
                                                }

                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- feedbacks -->

                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-6">
                    <p class="fw-bold border-bottom fs-5">Seller Other Products :-</p>
                </div>

                <div class="col-12">
                    <div class="row justify-content-center gap-3">

                        <?php

                        $s_img = "resources/emptyProducts.png";

                        $seller_product_rs = Database::Search("SELECT * FROM `product` WHERE `id`<>'" . $p_id . "' AND `seller_nic`='" . $seller . "' ORDER BY `date_time` DESC LIMIT 5 OFFSET 0 ");
                        $seller_product_num = $seller_product_rs->num_rows;

                        if ($seller_product_num == 0) {
                        ?>
                            <div class="col-12 text-center">
                                <p class="fs-3 fw-bold text-black-50">This Seller Has Not Other Products ....</p>
                            </div>
                            <?php
                        } else {

                            for ($x = 0; $x < $seller_product_num; $x++) {
                                $seller_product_data = $seller_product_rs->fetch_assoc();

                                $pimgs_rs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $seller_product_data["id"] . "' ");
                                $pimgs_num = $pimgs_rs->num_rows;

                                if ($pimgs_num == 0) {
                                    $w_img = "resources/emptyProducts.png";
                                } else {
                                    $pimgs_data = $pimgs_rs->fetch_assoc();
                                    $s_img = $pimgs_data["p_path"];
                                }

                            ?>

                                <div class="card p-0 shadow my-3 mx-2 cardHover" style="width: 13rem;" id="shortCard">
                                    <img src="<?php echo ($s_img) ?>" class="card-img-top p_img_hover img-fluid" onclick="goToSingleProductVeiw('<?php echo ($seller_product_data['id']) ?>');">
                                    <div class="card-body">
                                        <?php
                                        $p_title_seller = str_split($seller_product_data["title"], 18);
                                        ?>
                                        <div class="col-12">
                                            <p class="fw-bold"><?php echo ($p_title_seller[0] . " ....") ?></p>
                                        </div>
                                        <div class="col-12">
                                            <p class="fs-5 fw-bold">LKR : <?php echo ($seller_product_data["price"]) ?>.00</p>
                                        </div>
                                        <div class="col-12 text-end">
                                            <p class="text-black-50 fw-bold"><?php echo ($seller_product_data["date_time"]) ?></p>
                                        </div>
                                    </div>

                                </div>

                        <?php

                            }
                        }


                        ?>

                    </div>
                </div>

                <?php include "footer.php" ?>

                <!-- model Rates -->

                <div class="modal" tabindex="-1" id="rate_model<?php echo ($p_id) ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <?php
                                // all rates Count
                                $frs = Database::Search("SELECT * FROM `feedbacks` WHERE `product_id`='" . $p_id . "' AND  `ratings_r_id` <> '0'");
                                $f_num = $frs->num_rows;
                                // all rates Count

                                if ($f_num > 0) {
                                    //Bad Precentage
                                    $bf_rs = Database::Search("SELECT * FROM `feedbacks` WHERE `product_id`='" . $p_id . "' AND  `ratings_r_id`='1'");
                                    $bf_num = $bf_rs->num_rows;

                                    $bad_f = (100 / (int)$f_num) * (int)$bf_num;
                                    $badfeedback = round($bad_f);
                                    //Bad Precentage

                                    //good Precentage
                                    $gf_rs = Database::Search("SELECT * FROM `feedbacks` WHERE `product_id`='" . $p_id . "' AND  `ratings_r_id`='2'");
                                    $gf_num = $gf_rs->num_rows;

                                    $good_f = (100 / (int)$f_num) * (int)$gf_num;
                                    $goodfeedback = round($good_f);
                                    //good Precentage

                                    //very good Precentage
                                    $v_gf_rs = Database::Search("SELECT * FROM `feedbacks` WHERE `product_id`='" . $p_id . "' AND  `ratings_r_id`='3'");
                                    $v_gf_num = $v_gf_rs->num_rows;;

                                    $very_good_f = (100 / (int)$f_num) * (int)$v_gf_num;
                                    $verygoodFeedback = round($very_good_f);
                                    //very good Precentage

                                    //Execelent Precentage
                                    $ef_rs = Database::Search("SELECT * FROM `feedbacks` WHERE `product_id`='" . $p_id . "' AND  `ratings_r_id`='4'");
                                    $ef_num = $ef_rs->num_rows;

                                    $Excelent_f = (100 / (int)$f_num) * (int)$ef_num;
                                    $ecelentfeedback = round($Excelent_f);
                                    //Execelent Precentage
                                } else {
                                    $badfeedback = 0;
                                    $goodfeedback = 0;
                                    $verygoodFeedback = 0;
                                    $ecelentfeedback = 0;
                                }





                                ?>

                                <h5 class="modal-title">
                                    <div class="col-12">

                                        <span class="fw-bold text-black-50">All Rates ------ <span class="text-primary"><?php echo ($f_num) ?></span></span>

                                    </div>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-12 mb-1">
                                            <span class="text-danger fw-bold">Bad &nbsp;&nbsp;&nbsp;<i class="bi bi-star-fill text-warning"></i></span>
                                        </div>
                                        <div class="col-10">
                                            <div class="progress">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php if ($f_num < 0) {
                                                                                                                            echo (0);
                                                                                                                        } else {
                                                                                                                            echo ($badfeedback);
                                                                                                                        } ?>%"></div>
                                            </div>
                                        </div>

                                        <div class="col-2"><?php echo ($badfeedback . "%") ?></div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 mb-1">
                                            <span class="fw-bold">Good &nbsp;&nbsp;&nbsp;
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </span>
                                        </div>
                                        <div class="col-10">
                                            <div class="progress">
                                                <div class="progress-bar bg-dark" role="progressbar" style="width: <?php if ($f_num < 0) {
                                                                                                                        echo (0);
                                                                                                                    } else {
                                                                                                                        echo ($goodfeedback);
                                                                                                                    } ?>%"></div>
                                            </div>
                                        </div>
                                        <div class="col-2"><?php echo ($goodfeedback . "%") ?></div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 mb-1">
                                            <span class="fw-bold text-info">Very Good &nbsp;&nbsp;&nbsp;
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </span>
                                        </div>
                                        <div class="col-10">
                                            <div class="progress">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: <?php if ($f_num < 0) {
                                                                                                                        echo (0);
                                                                                                                    } else {
                                                                                                                        echo ($very_good_f);
                                                                                                                    } ?>%"></div>
                                            </div>
                                        </div>
                                        <div class="col-2"><?php echo ($verygoodFeedback . "%") ?></div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 mb-1">
                                            <span class="fw-bold text-success">Excelent &nbsp;&nbsp;&nbsp;
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </span>
                                        </div>
                                        <div class="col-10">
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php if ($f_num < 0) {
                                                                                                                            echo (0);
                                                                                                                        } else {
                                                                                                                            echo ($ecelentfeedback);
                                                                                                                        } ?>%"></div>
                                            </div>
                                        </div>
                                        <div class="col-2"><?php echo ($ecelentfeedback . "%") ?></div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>


                <!-- model Rates -->

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

            </div>
        </div>

        <script src="https://www.paypal.com/sdk/js?client-id=Ae8w3dvmEp3wwc0CEZHElfvSLjJd67zVPqIl4uhPqdLUoOOsHrXvrKcWiRgy-2nT_wS9nlvAI6u6QWb4&currency=USD"></script>
        <script src="bootstrap.js"></script>
        <script src="script.js"></script>
    </body>
    <script>
        var amount = 0.00;
        var lkrAmount = 0.00;
        var b_qty = 1;
        var unitprice = <?= $unit_price ?>;
        var ship = <?= $user_Shipping ?>;

        window.onload = async function() {
            lkrAmount = (b_qty * unitprice) + ship;
            var usdamount = await convertCurrency(lkrAmount);
            amount = usdamount;
        };

        async function handleQuantityChange(input) {
            let inputValue = parseInt(input.value);

            const min = parseInt(input.min);
            const max = parseInt(input.max);

            if (inputValue < min) {
                inputValue = min;
            } else if (inputValue > max) {
                inputValue = max;
            }
            input.value = inputValue;
            b_qty = inputValue;
            lkrAmount = (b_qty * unitprice) + ship;
            var usdamount = await convertCurrency(lkrAmount);
            amount = usdamount;
        }

        paypal.Buttons({
            createOrder: function(data, actions) {
                // Set up the transaction
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: amount // Set the amount to be paid
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // Capture the transaction
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    console.log('Transaction completed by ' + details.payer.name.given_name);
                    console.log(details); // Log details for further processing or record keeping
                    saveInvoice('<?= uniqid() ?>', <?= $p_id ?>, '<?= $user_email ?>', lkrAmount, b_qty, ship);
                });
            },
            onError: function(err) {
                // Show an error message
                console.error('An error occurred during the transaction:', err);
            }
        }).render('#paypal-button-container');
        // This function displays Smart Payment Buttons on your web page.
    </script>

    </html>

<?php

} else {
    header("Location:index.php");
}



?>