<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- navBar -->
            <div class="col-12 fixed-top bg-transparent transition" id="navigation_bar" style="z-index: 100;">
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <div class="fs-3"> <a href="#" class="aclass"><span class="namef">E</span>mart</a></div>

                            <?php
                            session_start();
                            require "connection.php";

                            $in_msg = Database::Search("SELECT * FROM `inquiry` WHERE `in_from`='" . $_SESSION["user"]["email"] . "' AND `user_view_status`='2' ");
                            $in_msg_num = $in_msg->num_rows;

                            ?>

                        </div>
                    </div>

                    <div class="col-3 pe-0 pe-lg-5">
                        <div class="row ">
                            <div class="col-12 mt-4 text-center text-lg-end"><button type="button" class="btn btn-dark"><a href="index.php" class="aclass2">Home</a></button></div>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="row text-center align-content-center mt-4 mt-lg-3 pt-1">
                            <div class="col-3 fs-3"> <a href="#" class="text-dark"><i class="bi bi-search cursor" onclick="showserachBar();"></i></a></div>
                            <div class="col-3">
                                <div>
                                    <i class="bi bi-cart4 cursor fs-3" onclick="window.location='cart.php'"></i>
                                    <?php

                                    $veiw_s = Database::Search("SELECT * FROM `cart` WHERE `veiw_status`='0' ");
                                    $veiw_num = $veiw_s->num_rows;
                                    if ($veiw_num == 0) {
                                    ?>
                                        <span class="badge text-bg-danger position-absolute d-none"></span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="badge text-bg-danger position-absolute"><?php echo ($veiw_num); ?></span>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="col-3 fs-3"><i class="bi bi-person-fill cursor" onclick="sidemenu();"></i></i></div>
                            <div class="col-3"><i class="bi bi-water cursor fs-3" onclick="upmenu();">&nbsp;</i><?php
                                                                                                                if ($in_msg_num != 0) {
                                                                                                                ?>
                                    <span class="badge text-bg-danger position-absolute"><?php echo ($in_msg_num) ?></span></a>
                                <?php
                                                                                                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- navBar -->

            <?php
            if (isset($_SESSION["user"])) {
                $d = $_SESSION["user"];
            ?>

                <!-- sideMenu Profile -->
                <div class="sidemain1 col-8 col-md-6 col-lg-4 col-xl-3 shadow-lg" id="menuSide" style="z-index: 300;">
                    <div class="row text-center">
                        <div class="col-12 fs-3 position-absolute p-2 ps-2 text-end"><i class="bi bi-x cursor" onclick="closesideMenu();"></i></div>
                        <div class="col-12 text-center pt-3">
                            <?php
                            $user_P = Database::Search("SELECT * FROM `profile_image` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' ");
                            $user_p_num = $user_P->num_rows;

                            if ($user_p_num != 0) {
                                $user_P_data = $user_P->fetch_assoc();
                            ?>
                                <img src="<?php echo ($user_P_data["user_profile_path"]) ?>" class="profile_img">
                            <?php
                            } else {
                            ?>
                                <img src="resources/user_profile_img/userprofile.png" class="profile_img">
                            <?php
                            }

                            ?>
                        </div>
                        <div class="fs-6 mt-3"><?php echo ($d["fname"] . " " . $d["lname"]); ?></div>
                        <div class="fs-6 mt-0"><?php echo ($d["email"]); ?></div>
                        <div class="fs-6 fw-bold mt-1"></div>
                        <div class="text-center my-3"><a href="userProfile.php" class="btn btn-primary">Edit Profile</a></div>

                        <div class="col-12 p-3 border-top"><a href="purchasedHistory.php" class="aclass">Purchesd Histroy</a></div>
                        <div class="col-12 p-3 border-top"><a href="massageWithSellers&admin.php" class="aclass">Massage </a>
                            <?php

                            $msg_rs = Database::Search("SELECT * FROM `massage` WHERE `m_from`='" . $_SESSION["user"]["email"] . "' AND `user_status`='1' ");
                            $msg_num = $msg_rs->num_rows;

                            if ($msg_num != 0) {
                            ?><span class="badge text-bg-primary"><?php echo ($msg_num) ?></span><?php
                                                                                                }

                                                                                                    ?></div>

                        <div class="col-12 p-3 border-top">
                            <a href="whatchList.php" class="aclass">Watchlist </a>
                            <?php

                            $watch_list = Database::Search("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' AND `w_view_status`='1' ");
                            $watch_num = $watch_list->num_rows;

                            if ($watch_num == 0) {
                            ?>
                                <span class="badge text-bg-secondary d-none"></span>
                            <?php
                            } else {
                            ?>
                                <span class="badge text-bg-info"><?php echo ($watch_num) ?></span>
                            <?php
                            }

                            ?>
                        </div>

                        <?php

                        $seller_rs = Database::Search("SELECT * FROM `seller` WHERE `user_email` ='" . $d["email"] . "' ");
                        $seller_num = $seller_rs->num_rows;

                        if ($seller_num != 0) {
                            $seller_data = $seller_rs->fetch_assoc();
                            if ($seller_data["s_status"] != 1) {
                        ?>
                                <div class="col-12 p-3 border-top"><a href="sellerSignin.php" class="aclass">Switch to seller Account</a></div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="col-12 p-3 border-top d-none"><a href="sellerSignin.php" class="aclass">Switch to seller Account</a></div>
                        <?php
                        }

                        ?>

                        <div class="col-12 border-top p-3">
                            <button class="btn btn-outline-dark" onclick="signout();">Log Out &nbsp;&nbsp;<i class="bi bi-box-arrow-right"></i></button>
                        </div>

                    </div>
                </div>
                <!-- sideMenu Profile -->

            <?php
            } else {

            ?>

                <!-- sideMenu Profile -->
                <div class="sidemain1 col-8 col-md-6 col-lg-4 col-xl-3 shadow-lg" id="menuSide" style="z-index: 1000;">
                    <div class="row text-center">
                        <div class="col-12 fs-3 position-absolute p-2 ps-2 text-end"><i class="bi bi-x cursor" onclick="closesideMenu();"></i></div>
                        <div class="col-12 text-center pt-5 mt-2">
                                <img src="resources/user_profile_img/userprofile.png" class="profile_img">
                        </div>
                        <div class="fs-6 mt-3">
                        </div>
                        <div class="fs-6 fw-bold mt-5">You have to sign In to access other super facilities</div>

                        <div class="text-center my-3"><a href="signin.php" class="btn btn-primary">SignIn Or Register</a></div>
                    </div>
                </div>
                <!-- sideMenu Profile -->

            <?php

            }
            ?>



            <!-- SideMenu Menu -->

            <div class="sidemain1 col-8 col-md-6 col-lg-4 col-xl-3 shadow-lg" id="menuSideUp"style="z-index: 1000;">
                <div class="row rounded-start shadow-lg bg-light">
                    <div class="col-12">
                        <i class="bi bi-x text-end fs-3 mt-1 position-absolute crossbar2 cursor me-3" onclick="upmenuClose();"></i>
                    </div>

                    <div class="col-12 p-md-2 mt-5">
                        <div class="row py-2 ps-1 py-md-0 ps-md-0 cursor">
                            <div class="col-4 d-flex justify-content-end align-items-center"><i class="bi bi-binoculars-fill fs-5 cursor"></i></div>
                            <div class="col-8 fw-bold d-flex justify-content-start align-items-center"><a href="advancedSearch.php" class="aclass">Advanced Search</a></div>
                        </div>
                    </div>
                    <div class="col-12 p-md-2">
                        <div class="row py-2 ps-1 py-md-0 ps-md-0 cursor">
                            <div class="col-4 d-flex justify-content-end align-items-center"><i class="bi bi-telephone-fill fs-5 cursor"></i></div>
                            <div class="col-8 fw-bold d-flex justify-content-start align-items-center"><a href="contactUs.php" class="aclass">Contact Us</a></div>
                        </div>
                    </div>
                    <div class="col-12 p-md-2">
                        <div class="row py-2 ps-1 py-md-0 ps-md-0 cursor">
                            <div class="col-4 d-flex justify-content-end align-items-center"><i class="bi bi-people-fill fs-5 cursor"></i></div>
                            <div class="col-8 fw-bold d-flex justify-content-start align-items-center"><a href="aboutUs.php" class="aclass">About Us</a></div>
                        </div>
                    </div>
                    <div class="col-12 p-md-2">
                        <div class="row py-2 ps-1 py-md-0 ps-md-0 cursor">
                            <a href=""></a>
                            <div class="col-4 d-flex justify-content-end align-items-center"><i class="bi bi-envelope-paper-fill fs-5 cursor"></i></div>
                            <div class="col-8 fw-bold d-flex justify-content-start align-items-center"><a href="inquery.php" class="aclass">Help & Report Us <?php
                                                                                                                                                        if ($in_msg_num != 0) {
                                                                                                                                                        ?>
                                        <span class="badge text-bg-danger"><?php echo ($in_msg_num) ?></span></a>
                            <?php
                                                                                                                                                        }
                            ?></div>
                        </div>
                    </div>
                    <div class="col-12 p-md-2">
                        <div class="row py-2 ps-1 py-md-0 ps-md-0 cursor">
                            <a href=""></a>
                            <div class="col-4 d-flex justify-content-end align-items-center"><i class="bi bi-envelope-paper-fill fs-5 cursor"></i></div>
                            <div class="col-8 fw-bold d-flex justify-content-start align-items-center"><a href="sellerRegistration.php" class="aclass">Create Seller Account</a></div>
                        </div>
                    </div>
                    <div class="col-12 p-md-2 mb-5">
                        <div class="row py-2 ps-1 py-md-0 ps-md-0 cursor">
                            <a href=""></a>
                            <div class="col-4 d-flex justify-content-end align-items-center"><i class="bi bi-envelope-paper-fill fs-5 cursor"></i></div>
                            <div class="col-8 fw-bold d-flex justify-content-start align-items-center"><a href="adminSignin.php" class="aclass">Log As Admin</a></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>



    <!-- SideMenu Menu -->

    <!-- search Bar -->

    <div class="col-12 bg-transparent searchmainBox1" id="showbar" style="z-index: 1000;">
        <i class="bi bi-x-lg fs-4 position-absolute crossbar cursor" onclick="closeserachBar();"></i>
        <div class="row d-flex justify-content-center">
            <div class="col-10 mt-3 pb-2">
                <div class="input-group p-3">
                    <input type="text" class="form-control" id="searchText" onkeyup="searchproduct();" placeholder="Search Your Favorite Products ...">
                    <button class="btn btn-outline-dark" type="button" onclick="eraseSearchText();"><i class="bi bi-x-lg"></i></button>
                    <a class="btn btn-primary d-none" id="searchBTN" onclick="searchproductitems();" type="button"><i class="bi bi-search"></i></a>
                </div>

                <div class="col-12 p-3 rounded shadow-sm bg-light d-none" id="productitemlist">

                </div>

            </div>
        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

<script>
    window.addEventListener('scroll', () => {

        var scrolled = window.scrollY;
        console.log(scrolled);
        if (scrolled <= 0) {
            document.getElementById("navigation_bar").className = "col-12 fixed-top bg-transparent transition"
            // alert("0 ta wadi");
        } else {
            document.getElementById("navigation_bar").className = "col-12 fixed-top bg-white transition shadow"
            // alert("0 ta adui");
        }
    });
</script>

</html>