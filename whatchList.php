<?php
session_start();
require "connection.php";

Database::iud("UPDATE `watchlist` SET `w_view_status`='2' WHERE `user_email`='" . $_SESSION["user"]["email"] . "' ")

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emart || Watchlist</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="aos.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 mb-2 bg-light shadow-sm border-bottom">
                <div class="row py-1 d-flex justify-content-end p-2">

                    <div class="col-3">
                        <div class="fs-3 mt-0"> <a href="#" class="aclass"><span class="namef">E</span>mart</a></div>
                    </div>

                    <div class="col-9 text-end">
                        <p class="fs-3 fw-bold m-0 mt-4"><i class="bi bi-box2-heart-fill text-danger">&nbsp;&nbsp;</i>My Watchlist ...</p>
                    </div>

                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-9 offset-3 col-md-6 offset-md-6">
                        <div class="input-group mt-2">
                            <input type="text" class="form-control shadow-none" placeholder="Find Your Favorite Items ...." id="watchlistbar" onkeyup="searchfromwatchlist();">
                            <button class="btn btn-primary" type="button" id="button-addon2" onclick="searchfromwatchlist();">Search</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <hr class="border border-3 border-primary">
            </div>

            <div class="col-12">
                <div class="row justify-content-center" id="watchlistresulDIV">

                    <?php
                    $w_img = "0";

                    $watchlist_rs = Database::Search("SELECT * FROM `watchlist` 
                                     INNER JOIN `product` ON `watchlist`.`product_id`=`product`.`id`
                                     WHERE `user_email`='" . $_SESSION["user"]["email"] . "' ");

                    $watchlist_num = $watchlist_rs->num_rows;

                    if ($watchlist_num == 0) {
                    ?>
                        <div class="col-12 d-flex justify-content-center">
                            <img src="resources/emptyWatchList.gif" height="300px" />
                        </div>
                        <div class="col-12 text-center">
                            <p class="fs-3 fw-bold text-black-50">No Product In Here .....</p>
                        </div>
                        <?php
                    } else {

                        for ($x = 0; $x < $watchlist_num; $x++) {
                            $watchlist_data = $watchlist_rs->fetch_assoc();

                            $pimg_rs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='".$watchlist_data["id"]."' ");
                            $pimg_num = $pimg_rs->num_rows;

                            if($pimg_num == 0){
                                $w_img = "resources/emptyProducts.png";
                            }else{
                                $pimg_data = $pimg_rs->fetch_assoc();
                                $w_img = $pimg_data["p_path"];
                            }

                        ?>

                            <div class="card p-0 shadow my-3 mx-2 cardHover" style="width: 13rem;" id="shortCard">
                                <img src="<?php echo($w_img) ?>" class="card-img-top p_img_hover img-fluid" onclick="goToSingleProductVeiw('<?php echo ($watchlist_data['id']) ?>');">
                                <div class="card-body">
                                    <?php
                                    $p_title_whatlist = str_split($watchlist_data["title"], 18);
                                    ?>
                                    <div class="col-12">
                                        <p class="fw-bold"><?php echo ($p_title_whatlist[0] . " ....") ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="fs-5 fw-bold">LKR : <?php echo ($watchlist_data["price"]) ?>.00</p>
                                    </div>
                                    <div class="col-12 text-end">
                                        <p class="text-black-50 fw-bold"><?php echo ($watchlist_data["w_datetime"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 d-grid">
                                                <button class="btn btn-outline-danger" onclick="removeFromWatchlist('<?php echo($watchlist_data['id']) ?>')">Remove</button>
                                            </div>
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


    <script src="script.js"></script>
</body>

</html>