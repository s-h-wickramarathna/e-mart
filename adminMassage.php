<?php

session_start();
require "connection.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Emart || Selling History ....</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="aos.css">
</head>

<body>

    <?php

    if (isset($_SESSION["admin"])) {
        $admin = $_SESSION["admin"];

    ?>


        <div class="container-fluid">
            <div class="row">
                <?php include "adminHeader.php" ?>

                <div class="col-12 mt-3">
                    <div class="row">

                        <div class="col-4">
                            <p class="fs-5 fw-bold text-primary">Help Section ....</p>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="table-responsive" style="height: 70vh;">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="bg-secondary text-white">#</th>
                                    <th scope="col" class="bg-info text-white">User Name</th>
                                    <th scope="col" class="bg-secondary text-white">User Email</th>
                                    <th scope="col" class="bg-info text-white">Content</th>
                                    <th scope="col" class="bg-secondary text-white">Date Time</th>
                                    <th scope="col" class="bg-info text-white"></th>
                                </tr>
                            </thead>
                            <tbody id="AdminMassageContent">

                                <?php

                                $msg_rs = Database::Search("SELECT DISTINCT `in_to` FROM `inquiry` WHERE `in_from`='sanchithaheashan655@gmail.com' ORDER BY `in_datetime` DESC ");
                                $msg_num = $msg_rs->num_rows;

                                if ($msg_num != 0) {

                                    for ($x = 0; $x < $msg_num; $x++) {
                                        $msg_data = $msg_rs->fetch_assoc();

                                        $user_rs = Database::Search("SELECT * FROM `user` WHERE `email`='" . $msg_data["in_to"] . "' ");
                                        $user_data = $user_rs->fetch_assoc();


                                        $gender = Database::Search("SELECT * FROM `gender` WHERE `id`='" . $user_data["gender_id"] . "' ");
                                        $gender_data = $gender->fetch_assoc();

                                        $city = "-------------------";
                                        $line1 = "------------------";
                                        $line2 = "------------------";

                                        $address_rs = Database::Search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $user_data["email"] . "' ");
                                        $address_num = $address_rs->num_rows;

                                        if ($address_num != 0) {
                                            $address_data = $address_rs->fetch_assoc();
                                            $line1 = $address_data["line_1"];
                                            $line2 = $address_data["line_2"];

                                            $city_rs = Database::Search("SELECT * FROM `city` WHERE `ci_id`='" . $address_data["city_id"] . "' ");
                                            $city_data = $city_rs->fetch_assoc();
                                            $city = $city_data["ci_name"];
                                        }

                                        $img = "resources/noImage.jpg";

                                        $image_rs = Database::Search("SELECT * FROM `profile_image` WHERE `user_email`='" . $user_data["email"] . "' ");
                                        $image_num = $image_rs->num_rows;

                                        if ($image_num != 0) {
                                            $image_data = $image_rs->fetch_assoc();
                                            $img = $image_data["user_profile_path"];
                                        }

                                ?>

                                        <tr>
                                            <th scope="row" class="bg-secondary text-white"><?php echo ($x + 1); ?></th>
                                            <td class="bg-info text-white text-center" onclick="showFullMSGUser('<?php echo ($user_data['email']) ?>')"><img src="<?php echo ($img) ?>" class="rounded-circle" height="50px"></td>
                                            <td class="bg-secondary text-white"><?php echo ($msg_data["in_to"]); ?></td>
                                            <td class="bg-info text-white">
                                                <?php
                                                $Usermsg_rs = Database::Search("SELECT * FROM `inquiry` WHERE `in_to`='" . $user_data["email"] . "' ORDER BY `in_datetime` DESC ");
                                                $Usermsg_num = $Usermsg_rs->num_rows;
                                                $Usermsg_data = $Usermsg_rs->fetch_assoc();
                                                $c = $Usermsg_data["in_content"];
                                                $content = str_split($c, 20);
                                                echo ($content[0] . " ....");
                                                ?>
                                            </td>
                                            <td class="bg-secondary text-white">2022-12-29 00:00:00</td>
                                            <td class="bg-info text-white text-center">
                                                <button type="button" class="btn btn-primary" onclick="veiwMSGContentAdmin('<?php echo ($msg_data['in_to']) ?>');">
                                                    Reply
                                                    <?php
                                                    $OnlyNummsg_rs = Database::Search("SELECT * FROM `inquiry` WHERE `in_to`='".$user_data["email"]."' AND `admin_view_status`='2' ");
                                                    $OnlyNummsg_num = $OnlyNummsg_rs->num_rows;
                                                    if ($OnlyNummsg_num != 0) {
                                                    ?>
                                                        <span class="badge text-bg-danger"><?php echo ($OnlyNummsg_num) ?></span>
                                                    <?php
                                                    }
                                                    ?>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- user_Model -->

                                        <div class="modal" tabindex="-1" id="uerMSGModel<?php echo ($user_data["email"]) ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><?php echo ($user_data["fname"] . " " . $user_data["lname"]) ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 text-center mb-2">
                                                            <img src="<?php echo ($img) ?>" class="rounded-circle" height="200px" />
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="row">

                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">First Name : </span><?php echo ($user_data["fname"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Last Name : </span><?php echo ($user_data["lname"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Email : </span><?php echo ($user_data["email"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Mobile No : </span><?php echo ($user_data["mobile"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Gender : </span><?php echo ($gender_data["type"]) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">City : </span><?php echo ($city) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Addres Line 01 : </span><?php echo ($line1) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Addres Line 02 : </span><?php echo ($line2) ?></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="m-0"><span class="fw-bold">Joined Date : </span><?php echo ($user_data["joined_date"]) ?></p>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="col-12 text-end">
                                                            <p class="fw-bold text-black-50">User Account ....</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- user_Model -->
                                        <!-- massageModel -->
                                        <div class="modal" tabindex="-1" id="veiwMSGadmin<?php echo ($msg_data["in_to"]) ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><?php echo ($msg_data["in_to"]) ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12" style="height: 300px;">
                                                            <div class="row overflow-auto" id="loadSendInquieryMSG<?php echo($user_data['email']) ?>">
                                                                <?php

                                                                $showmsg_rs = Database::Search("SELECT * FROM `inquiry` WHERE `in_to`='" . $user_data["email"] . "' OR `in_from`='" . $user_data["email"] . "' ");
                                                                $showmsg_num = $showmsg_rs->num_rows;

                                                                if ($showmsg_num != 0) {
                                                                    for ($c = 0; $c < $showmsg_num; $c++) {
                                                                        $showmsg_data = $showmsg_rs->fetch_assoc();

                                                                        if ($showmsg_data["in_to"] == 'sanchithaheashan655@gmail.com' && $showmsg_data["in_from"] == $user_data["email"]) {

                                                                ?>
                                                                            <!-- to -->
                                                                            <div class="col-12 m-0">
                                                                                <div class="row justify-content-end">
                                                                                    <div class="col-6">
                                                                                        <div class="row justify-content-end p-2">
                                                                                            <div class="w-auto bg-success rounded-2">
                                                                                                <p class="m-0 text-white"><?php echo ($showmsg_data["in_content"]); ?></p>
                                                                                            </div>
                                                                                            <div class="col-12 text-end">
                                                                                                <p class="m-0 fw-bold text-black-50"><?php echo ($showmsg_data["in_datetime"]); ?><span class="text-dark">Me</span></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- to -->

                                                                        <?php
                                                                        } else if ($showmsg_data["in_to"] == $user_data["email"] && $showmsg_data["in_from"] == 'sanchithaheashan655@gmail.com') {
                                                                        ?>
                                                                            <!-- from -->
                                                                            <div class="col-12">
                                                                                <div class="row justify-content-start">
                                                                                    <div class="col-6">
                                                                                        <div class="row justify-content-start p-2">
                                                                                            <div class="w-auto bg-primary rounded-2">
                                                                                                <p class="m-0 text-white"><?php echo ($showmsg_data["in_content"]); ?></p>
                                                                                            </div>
                                                                                            <div class="col-12 text-start">
                                                                                                <p class="m-0 fw-bold text-black-50"> <span class="text-dark">User </span><?php echo ($showmsg_data["in_datetime"]); ?></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- from -->
                                                                        <?php
                                                                        }

                                                                        ?>
                                                                <?php
                                                                    }
                                                                }

                                                                ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" placeholder="Type Massage" id="adminMSGSend<?php echo($user_data['email']) ?>">
                                                            <button class="btn btn-primary" type="button" onclick="sendMsgToUser('<?php echo($user_data['email']) ?>');"><i class="bi bi-send"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- massageModel -->

                                <?php

                                    }
                                }

                                ?>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>

    <?php

    } else {
    ?>
        <div class="w-100 vh-100 d-flex align-items-center justify-content-center">
            <div class="row text-center">
                <div class="col-12 text-center">
                    <p class="fs-4 fw-bold text-black-50">ERROR :( :( You Are Not A Admin .....</p>
                </div>
                <div class="col-12 text-center">
                    <a href="adminSignin.php" class="btn btn-primary">Log As Admin</a>
                </div>
            </div>
        </div>
    <?php
    }

    ?>
    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>