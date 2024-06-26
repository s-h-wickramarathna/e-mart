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

    <title>Emart || Manage Users ....</title>

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

        $query = "SELECT * FROM `user`";
        $status = 1;

        if (isset($_GET["s"])) {
            $status = $_GET["s"];

            if ($status == 2) {
                $query .= " WHERE `status`='2' ";
            } else if ($status == 3) {
                $query .= " WHERE `status`='1' ";
            }
        }

    ?>


        <div class="container-fluid">
            <div class="row">
                <?php include "adminHeader.php" ?>

                <div class="col-12 mt-3">
                    <div class="row">

                        <div class="col-4">
                            <p class="fs-5 fw-bold text-primary">Manage Users</p>
                        </div>
                        <div class="col-8">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Enter Mobile Number Or Email ...." id="u_MobileEmail" onkeyup="SearchAdminUsers(<?php echo($status) ?>);">
                                <button class="btn btn-dark" type="button" onclick="SearchAdminUsers(<?php echo($status) ?>);">Search</button>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="row justify-content-end">
                                <div class="col-6 offset-6 col-md-4 offset-md-8">
                                    <select class="form-select shadow-none" onchange="redirectAdminUser();" id="pageValue">

                                        <?php
                                        if ($status == 1) {
                                        ?>
                                            <option value="1" selected>Select Method</option>
                                            <option value="2">Block Users</option>
                                            <option value="3">Unblock Users</option>
                                        <?php
                                        } else if ($status == 2) {
                                        ?>
                                            <option value="1">Select Method</option>
                                            <option value="2" selected>Block Users</option>
                                            <option value="3">Unblock Users</option>
                                        <?php
                                        } else if ($status == 3) {
                                        ?>
                                            <option value="1">Select Method</option>
                                            <option value="2">Block Users</option>
                                            <option value="3" selected>Unblock Users</option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="table-responsive" style="height: 60vh;">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="bg-secondary text-white">#</th>
                                    <th scope="col" class="bg-info text-white">First Name</th>
                                    <th scope="col" class="bg-secondary text-white">Last Name</th>
                                    <th scope="col" class="bg-info text-white">Email</th>
                                    <th scope="col" class="bg-secondary text-white">Mobile No</th>
                                    <th scope="col" class="bg-info text-white">Gender</th>
                                    <th scope="col" class="bg-secondary text-white"></th>
                                </tr>
                            </thead>
                            <tbody id="UserdataRows">

                                <?php
                                $user_rs = Database::Search($query);
                                $user_num = $user_rs->num_rows;

                                if ($user_num != 0) {

                                    for ($x = 0; $x < $user_num; $x++) {
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

                                ?>
                                        <tr>
                                            <th scope="row" class="bg-secondary text-white"><?php echo ($x + 1); ?></th>
                                            <td class="bg-info text-white"><?php echo ($user_data["fname"]) ?></td>
                                            <td class="bg-secondary text-white"><?php echo ($user_data["lname"]) ?></td>
                                            <td class="bg-info text-white"  style="cursor: pointer;" onclick="ShowFullUserDetails('<?php echo ($user_data['email']) ?>');"><?php echo ($user_data["email"]) ?></td>
                                            <td class="bg-secondary text-white"><?php echo ($user_data["mobile"]) ?></td>
                                            <td class="bg-info text-white"><?php echo ($gender_data["type"]) ?></td>
                                            <td class="bg-secondary text-white text-center"><?php
                                                                                        if ($user_data["status"] == 1) {
                                                                                        ?>
                                                    <button class="btn btn-danger" id="b&Ubtn<?php echo ($user_data["email"]) ?>" onclick="block_Unblock_Users('<?php echo ($user_data['email']) ?>');">Block</button>
                                                <?php
                                                                                        } else if ($user_data["status"] == 2) {
                                                ?>
                                                    <button class="btn btn-success" id="b&Ubtn<?php echo ($user_data["email"]) ?>" onclick="block_Unblock_Users('<?php echo ($user_data['email']) ?>');">Unblock</button>
                                                <?php
                                                                                        }
                                                ?>
                                            </td>
                                        </tr>

                                        <!-- user_Model -->

                                        <div class="modal" tabindex="-1" id="uerModel<?php echo ($user_data["email"]) ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><?php echo ($user_data["fname"] . " " . $user_data["lname"]) ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 text-center mb-2">
                                                            <?php
                                                            $img = "resources/noImage.jpg";

                                                            $image_rs = Database::Search("SELECT * FROM `profile_image` WHERE `user_email`='".$user_data["email"]."' ");
                                                            $image_num = $image_rs->num_rows;

                                                            if($image_num != 0){
                                                                $image_data = $image_rs->fetch_assoc();
                                                                $img = $image_data["user_profile_path"];
                                                            }

                                                            ?>
                                                            <img src="<?php echo($img) ?>" class="rounded-circle" height="200px" />
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