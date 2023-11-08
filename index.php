<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Emart || Home</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="aos.css">

</head>

<body class="bg-light">



    <div class="container-fluid bg-light">
        <div class="row d-flex justify-content-center">

            <?php include "header.php" ?>

            <div class="mainSuperimgdiv">

            <div class="col-12">

                <div class="col-12 vh-100 row justify-content-center align-items-center">
                    <div class="row justify-content-center align-items-center">
                        <img src="resources/logo.svg" height="250px">
                        <div class="col-12 text-center mt-3">
                            <p class="fw-bold fs-5">Hi , Welcome To Emart, Your In The World Best E-commerce Platform</p>
                        </div>
                    </div>
                </div>
            </div>

            </div>
            


            <div class="col-12 bgup">
                <div class="row justify-content-center">

                    <div class="col-12">
                        <div class="row p-3 bg-light shadow m-4 text-center rounded-2">

                            <div class="col-4 border-end">
                                <i class="bi bi-cash-coin text-danger fs-2"></i><br>
                                <span class="fs-5 fw-bold">Safe And Relaible Payment</span>
                            </div>

                            <div class="col-4">
                                <i class="bi bi-truck text-danger fs-2"></i><br>
                                <span class="fs-5 fw-bold">Fast Delivary Service</span>
                            </div>

                            <div class="col-4 border-start">
                                <i class="bi bi-phone-vibrate text-danger fs-2"></i><br>
                                <span class="fs-5 fw-bold">24/7 Customer Service</span>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12">
                <div class="row justify-content-center mt-2 mb-2">

                    <div class="col-12 col-lg-3">
                        <div class="row mb-3 justify-content-center">

                            <div class="col-12 col-lg-11 bg-body rounded-2 shadow mb-4">
                                <div class="row mb-2">

                                    <div class="col-12 mt-1 mb-1">
                                        <p class="m-0 fs-5 fw-bold"><i class="bi bi-list-ul">&nbsp;&nbsp;</i>Categories</p>
                                    </div>

                                    <hr>

                                    <div class="col-12">
                                        <div class="row">

                                            <?php
                                            $category_rs = Database::Search("SELECT * FROM `category` ");
                                            $category_num = $category_rs->num_rows;

                                            for ($c = 0; $c < $category_num; $c++) {
                                                $category_data = $category_rs->fetch_assoc();
                                            ?>

                                                <div class="col-4 col-md-3 col-lg-12 mt-1 mb-1">
                                                    <a href="loadviewCategory.php?c=<?php echo ($category_data["ca_id"]) ?>" class="aclass aclass3"><?php echo ($category_data["ca_name"]) ?></a>
                                                </div>

                                            <?php
                                            }

                                            ?>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="col-lg-9 col-xl-7 d-none d-lg-block">
                        <div class="row">

                            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="true">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="resources/iphone12.jpg" class="d-block w-100 rounded-2" height="450px">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resources/cloths.webp" class="d-block w-100 rounded-2" height="450px">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resources/item3.webp" class="d-block w-100 rounded-2" height="450px">
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

                    <div class="col-12 col-xl-2 mb-2 m-3 m-lg-0 mt-lg-2 mb-lg-3">
                        <div class="row p-2 justify-content-center">

                            <div class="col-5 col-xl-12 mb-3 rounded-2 bg-body">
                                <div class="row g-2">

                                    <div class="col-12 text-center">
                                        <p class="fs-5 fw-bold">Welcome to Emart</p>
                                    </div>
                                    <div class="col-12 d-grid">
                                        <a href="signin.php" class="btn btn-outline-primary">Join</a>
                                    </div>
                                    <div class="col-12 mb-3 d-grid">
                                        <a href="signin.php" class="btn btn-outline-primary">Sign In</a>
                                    </div>

                                </div>
                            </div>

                            <div class="col-5 col-xl-12 mt-2 mt-md-2 mb-3 rounded-2 bg-body m-3 m-lg-0 mt-lg-2 mb-lg-3">
                                <div class="row g-2">

                                    <div class="col-12 text-center">
                                        <p class="fs-5 fw-bold">Super Deals ...</p>
                                    </div>
                                    <div class="col-12 mb-2 text-center">
                                        <span>Buy Weekly Super Products. </span>
                                    </div>
                                    <div class="col-12 mb-3 d-grid">
                                        <a href="superDeals.php?s=<?php echo (2) ?>" class="btn btn-outline-warning">Shop Now</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row d-flex justify-content-center">

                    <div class="col-11 shadow rounded-2 d-flex justify-content-center  mt-1 mb-4">
                        <div class="row">

                            <div class="col-8">
                                <div class="row">
                                    <p class="fs-3 fw-bold text-success mt-3">Speacial For You</p>
                                    <p class=" fs-5 fw-bold ms-3">Shop early bird offers to Daily Deals ...</p>
                                    <div class="col-12 d-flex">
                                        <a href="superDeals.php?s=<?php echo (1) ?>" class="btn btn-outline-dark ms-4 mt-2 mb-2 m-lg-4">Shop now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <img src="resources/imagephone.png" class="img-fluid">
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 mt-2">
                <div class="row my-2">

                    <div class="col-12 mb-3 shadow-sm bg-body border-warning rounded-3">
                        <div class="row">

                            <div class="col-12 mt-1 mb-1 border-bottom border-2">
                                <p class="fs-4 fw-bold text-primary">Explore Populer Brands ...</p>
                            </div>

                            <div class="col-12">
                                <div class="row justify-content-center mt-2 mb-2">

                                    <div class="col-6 col-md-4 col-lg-3 col-xl-2 text-center mt-2 mb-3 shadow">
                                        <img src="resources/appleLogo.jpg" height="100px">
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3 col-xl-2 text-center mt-2 mb-3 shadow">
                                        <img src="resources/smasungLogo.jpg" height="100px">
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3 col-xl-2 text-center mt-2 mb-3 shadow">
                                        <img src="resources/miLogo.webp" height="100px">
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3 col-xl-2 text-center mt-2 mb-3 shadow">
                                        <img src="resources/NikeLogo2.webp" height="100px">
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3 col-xl-2 text-center mt-2 mb-3 shadow">
                                        <img src="resources/addidaslogo3.jpg" height="100px">
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-3 col-xl-2 text-center mt-2 mb-3 shadow">
                                        <img src="resources/reebokLogo2.jpg" height="100px">
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-3 col-lg-5 pt-2">
                        <hr class="border border-3 border-danger">
                    </div>
                    <div class="col-6 col-lg-2 text-center">
                        <p class="fs-3 fw-bold">More to love</p>
                    </div>
                    <div class="col-3 col-lg-5 pt-2">
                        <hr class="border border-3 border-danger">
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row d-flex justify-content-center mt-2 mb-2">

                    <?php

                    $product_rs = Database::Search("SELECT * FROM `product` WHERE `status_s_id`='1' AND `admin_status`='1' ORDER BY `date_time` DESC ");
                    $product_num = $product_rs->num_rows;


                    for ($i = 0; $i < $product_num; $i++) {

                        $product_data = $product_rs->fetch_assoc();

                        $product_date = $product_data["date_time"];
                        $splid_date = explode(" ", $product_date);
                        $date = $splid_date[0];


                    ?>

                        <div class="card p-0 my-3 mx-2 cardHover cursor" style="width: 13rem;" onclick="goToSingleProductVeiw('<?php echo ($product_data['id']) ?>');">
                            <?php

                            $imgP = "resources/noImage.jpg";

                            $img_prs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $product_data["id"] . "' ");
                            $img_pnum = $img_prs->num_rows;

                            if ($img_pnum != 0) {
                                $img_pdata = $img_prs->fetch_assoc();
                                $imgP = $img_pdata["p_path"];
                            }

                            ?>
                            <img src="<?php echo ($imgP) ?>" class="card-img-top p_img_hover">
                            <div class="card-body">
                                <hr>
                                <div class="col-12">
                                    <p class="fw-bold"><?php echo ($product_data["title"]) ?></p>
                                </div>
                                <div class="col-12">
                                    <p>LKR : <span class="fs-5 fw-bold"><?php echo ($product_data["price"]) ?></span></p>
                                </div>
                                <div class="col-12 text-end">
                                    <p class="text-black-50"><?php echo ($date) ?></p>
                                </div>
                            </div>
                        </div>

                    <?php


                    }

                    ?>

                </div>
            </div>


            <?php include "footer.php" ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
</body>

</html>