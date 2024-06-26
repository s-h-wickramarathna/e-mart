<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emart || Super Deals</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="aos.css">

</head>

<body>

    <?php

    if (isset($_GET["s"])) {
        $status = $_GET["s"];

        require "connection.php";

    ?>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 mb-2 bg-light vh-100">
                    <div class="row d-flex justify-content-end">

                        <div class="col-3">
                            <div class="fs-3 mt-0"> <a href="#" class="aclass"><span class="namef">E</span>mart</a></div>
                        </div>

                        <div class="col-9 mt-4 text-end">
                            <?php
                            if ($status == 1) {
                            ?>
                                <p class="m-0 fs-4 fw-bold">Daily Deals ....</p>
                            <?php
                            } else {
                            ?>
                                <p class="m-0 fs-4 fw-bold">Weekly Deals ....</p>
                            <?php
                            }
                            ?>

                            <hr>
                        </div>

                        <div class="col-12">
                            <div class="row justify-content-center">

                                <?php
                                if ($status == 1) {
                                    $p_rs = Database::Search("SELECT * FROM `product` WHERE `status_s_id`='1' AND `admin_status`='1' ");
                                    $p_num = $p_rs->num_rows;

                                    if ($p_num != 0) {
                                        for ($x = 0; $x < $p_num; $x++) {
                                            $p_data = $p_rs->fetch_assoc();

                                            $p_date = $p_data["date_time"];

                                            $tdate = new DateTime();
                                             $tz = new DateTimeZone("Asia/Colombo");
                                            $tdate->setTimezone($tz);

                                            $start_date = new DateTime($p_date);
                                            $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                                            $defference = $end_date->diff($start_date);
                                            $count = $defference->format('%d');
                                            $date = $defference->format('%m');


                                            if ($count <= 1 && $date == 0) {
                                ?>

                                                <div class="card p-0 my-3 mx-2 cardHover cursor" style="width: 13rem;" onclick="goToSingleProductVeiw('<?php echo ($p_data['id']) ?>');">
                                                    <?php

                                                    $imgP = "resources/noImage.jpg";

                                                    $img_prs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $p_data["id"] . "' ");
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
                                                            <p class="fw-bold"><?php echo ($p_data["title"]) ?></p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p>LKR : <span class="fs-5 fw-bold"><?php echo ($p_data["price"]) ?></span></p>
                                                        </div>
                                                        <div class="col-12 text-end">
                                                            <p class="text-black-50"><?php echo ($p_date) ?></p>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php

                                            }
                                        }
                                    }
                                } else if ($status == 2) {
                                    $p_rs = Database::Search("SELECT * FROM `product` WHERE `status_s_id`='1' AND `admin_status`='1' ");
                                    $p_num = $p_rs->num_rows;

                                    if ($p_num != 0) {
                                        for ($x = 0; $x < $p_num; $x++) {
                                            $p_data = $p_rs->fetch_assoc();

                                            $p_date = $p_data["date_time"];

                                            $tdate = new DateTime();
                                            $tz = new DateTimeZone("Asia/Colombo");
                                            $tdate->setTimezone($tz);

                                            $start_date = new DateTime($p_date);
                                            $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                                            $defference = $end_date->diff($start_date);

                                            $count = $defference->format('%d');
                                            $date = $defference->format('%m');

                                            if ($count <= 7 && $date == 0) {
                                            ?>

                                                <div class="card p-0 my-3 mx-2 cardHover cursor" style="width: 13rem;" onclick="goToSingleProductVeiw('<?php echo ($p_data['id']) ?>');">
                                                    <?php

                                                    $imgP = "resources/noImage.jpg";

                                                    $img_prs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $p_data["id"] . "' ");
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
                                                            <p class="fw-bold"><?php echo ($p_data["title"]) ?></p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p>LKR : <span class="fs-5 fw-bold"><?php echo ($p_data["price"]) ?></span></p>
                                                        </div>
                                                        <div class="col-12 text-end">
                                                            <p class="text-black-50"><?php echo ($p_date) ?></p>
                                                        </div>
                                                    </div>
                                                </div>

                                <?php

                                            }
                                        }
                                    }
                                }

                                ?>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    <?php



    }
     include "footer.php"
    ?>
    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>