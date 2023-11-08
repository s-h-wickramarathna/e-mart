<?php

session_start();
require "connection.php";
$seller_nic = $_SESSION["seller"]["nic"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Emart || Massage</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="aos.css">
</head>

<body>

    <div class="container-fluid bg-light">
        <div class="row">

            <div class="col-12 vh-100">
                <div class="row">

                    <div class="col-12 mb-2 bg-light shadow-sm border-bottom">
                        <div class="row py-1 d-flex justify-content-end p-2">

                            <div class="col-3">
                                <div class="fs-3 mt-0"> <a href="#" class="aclass"><span class="namef">E</span>mart</a></div>
                            </div>

                            <div class="col-9 text-end">
                                <p class="fs-3 fw-bold m-0 mt-4"><i class="bi bi-mastodon">&nbsp;&nbsp;</i>Massage</p>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 col-md-4 offset-md-1 mt-3 mb-3 shadow rounded-start bgcolourcontact">
                                <div class="row">
                                    <div class="col-12 border-bottom shadow">
                                        <p class="m-0 mt-2 mb-2 fw-bold fs-5">Contacts >>></p>
                                    </div>
                                    <div class="col-12" style="height: 70vh;">
                                        <?php
                                        $msg_rs = Database::Search("SELECT DISTINCT `m_to` FROM `massage` WHERE `m_from`='" . $seller_nic . "' order BY `seller_status` DESC ");
                                        $msg_num = $msg_rs->num_rows;

                                        if ($msg_num == 0) {
                                        ?>
                                            <!-- no contact -->
                                            <div class="row">
                                                <div class="col-12 mt-4 text-center">
                                                    <p class="fs-5 fw-bold text-black-50">No Contact Yet ...</p>
                                                </div>
                                            </div>
                                            <!-- no contact -->
                                        <?php
                                        } else {
                                        ?>
                                            <!-- have_contact -->
                                            <div class="row overflow-auto">
                                                <?php

                                                for ($i = 0; $i < $msg_num; $i++) {
                                                    $msg_data = $msg_rs->fetch_assoc();
                                                    $user_rs = Database::Search("SELECT * FROM `user` WHERE `email`='" . $msg_data["m_to"] . "' ");
                                                    $user_data = $user_rs->fetch_assoc();

                                                    $status = Database::Search("SELECT * FROM `massage` WHERE `m_to` ='" . $user_data["email"] . "' AND `m_from`='" . $seller_nic . "' AND `seller_status`='1' ");
                                                    $status_num = $status->num_rows;

                                                    if ($status_num == 0) {
                                                ?>
                                                        <!-- contact -->
                                                        <div class="col-12 border cursor hoverMSGcontact" onclick="loadMSGSeller('<?php echo ($msg_data['m_to']) ?>');">
                                                            <div class="row mt-1 mb-1">
                                                                <div class="col-4 col-lg-3 text-center">
                                                                    <?php

                                                                    $img_path = "resources/noImage.jpg";

                                                                    $user_img = Database::Search("SELECT * FROM `profile_image` WHERE `user_email`='" . $user_data["email"] . "' ");
                                                                    $user_img_num = $user_img->num_rows;

                                                                    if ($user_img_num != 0) {
                                                                        $user_img_data = $user_img->fetch_assoc();
                                                                        $img_path = $user_img_data["user_profile_path"];
                                                                    }

                                                                    ?>
                                                                    <img src="<?php echo ($img_path) ?>" class="rounded-circle me-3" height="55px" style="background-position: center;">
                                                                </div>
                                                                <div class="col-8">
                                                                    <p class="m-0 mt-2 fw-bold"><?php echo ($user_data["fname"] . " " . $user_data["lname"]) ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- contact -->
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <!-- contact -->
                                                        <div class="col-12 border text-white bg-primary cursor hoverMSGcontact" onclick="loadMSGSeller('<?php echo ($msg_data['m_to']) ?>');">
                                                            <div class="row mt-1 mb-1">
                                                                <div class="col-4 col-lg-3 text-center">
                                                                    <?php

                                                                    $img_path = "resources/noImage.jpg";

                                                                    $user_img = Database::Search("SELECT * FROM `profile_image` WHERE `user_email`='" . $user_data["email"] . "' ");
                                                                    $user_img_num = $user_img->num_rows;

                                                                    if ($user_img_num != 0) {
                                                                        $user_img_data = $user_img->fetch_assoc();
                                                                        $img_path = $user_img_data["user_profile_path"];
                                                                    }

                                                                    ?>
                                                                    <img src="<?php echo ($img_path) ?>" class="rounded-circle me-3" height="55px" style="background-position: center;">
                                                                </div>
                                                                <div class="col-8">
                                                                    <p class="m-0 mt-2 fw-bold"><?php echo ($user_data["fname"] . " " . $user_data["lname"]) ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- contact -->
                                                <?php
                                                    }
                                                }

                                                ?>

                                            </div>
                                            <!-- have_contact -->


                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mt-3 mb-3 shadow rounded-end" id="massageappendDIV" style="height: 81vh;background-color: rgb(0,189,196);">

                                <!-- empty_massage -->

                                <div class="row d-flex justify-content-center">
                                    <div class="col-12 d-flex justify-content-center mt-4">
                                        <img src="resources/noMSGgif.gif" class="img-fluid">
                                    </div>
                                </div>

                                <!-- empty_massage -->

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>