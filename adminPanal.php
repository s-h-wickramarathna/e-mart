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
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <?php include "adminHeader.php" ?>

            <div class="col-12">
                <div class="row">
                    <div class="col-3 border-end border-2">
                        <div class="row">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-12 text-center mb-2">
                                                <img src="resources/noImage.jpg" class="rounded-circle" height="80px">
                                            </div>
                                            <div class="col-12 text-center mb-1">
                                                <p class="m-0 fw-bold">Sanchitha Heshan</p>
                                                <p class="m-0 fw-bold text-black-50">Managing Director</p>
                                            </div>
                                            <div class="col-12 text-end">
                                                <i class="bi bi-pencil-square cursor"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="col-12">
                                        <p class="fs-5 fw-bold text-success m-0">Sections >>></p>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <hr class="border border-2 border-dark">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 ms-4">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <a href="adminManageUsers.php" class="aclass">Manage Users ...</a>
                                            </div>
                                            <div class="col-12">
                                                <a href="adminManageProducts.php" class="aclass">Manage Products ...</a>
                                            </div>
                                            <div class="col-12">
                                                <a href="adminManageSellers.php" class="aclass">Manage Sellers ...</a>
                                            </div>
                                            <div class="col-12">
                                                <a href="adminsellingHisttory.php" class="aclass">Selling History ...</a>
                                            </div>
                                            <div class="col-12">
                                                <a href="adminSellerRequest.php" class="aclass">Seller Request ...</a>
                                            </div>
                                            <div class="col-12">
                                                <?php
                                                $msg_rs = Database::Search("SELECT * FROM `inquiry` WHERE `in_from`='sanchithaheashan655@gmail.com' AND `admin_view_status`='2' ");
                                                $msg_num = $msg_rs->num_rows;

                                                if($msg_num == 0){
                                                    ?>
                                                    <a href="adminMassage.php" class="aclass">Massage ...</a>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <a href="adminMassage.php" class="aclass">Massage ...&nbsp;<span class="badge text-bg-danger"><?php echo($msg_num) ?></span></a>
                                                    <?php
                                                }
                                                ?>
                                                
                                                
                                            </div>


                                            <div class="col-12">
                                                <button class="btn btn-outline-dark">Logout</button>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-9 d-flex align-items-center">
                        <div class="row d-flex justify-content-center g-4">

                            <!-- report_01 -->
                            <div class="col-11">
                                <div class="card">
                                    <div class="card-header">
                                        <p class="fs-5 fw-bold text-warning m-0">Our Users</p>
                                    </div>
                                    <div class="card-body adminCard1">
                                        <blockquote class="blockquote mb-0">
                                            <p class="fw-bold">All Users 500</p>
                                            <footer class="blockquote-footer"><cite title="Source Title">Source Title</cite></footer>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <!-- report_01 -->

                            <!-- report_02 -->
                            <div class="col-11">
                                <div class="card">
                                    <div class="card-header">
                                        <p class="fs-5 fw-bold text-warning m-0">Our Sellers</p>
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p class="fw-bold">All Sellers 500</p>
                                            <footer class="blockquote-footer"><cite title="Source Title">Source Title</cite></footer>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <!-- report_02 -->

                            <!-- report_03 -->
                            <div class="col-11">
                                <div class="card">
                                    <div class="card-header">
                                        <p class="fs-5 fw-bold text-warning m-0">Our Products</p>
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p class="fw-bold">All Products 500</p>
                                            <footer class="blockquote-footer"><cite title="Source Title">Source Title</cite></footer>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <!-- report_03 -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>