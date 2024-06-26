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
    <title>Emart || Admin Panel</title>
    <link rel="icon" href="resources/logo.svg" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <?php include "adminHeader.php" ?>

            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-3 border-end border-2">
                        <div class="row mb-4">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 mt-3 mb-3">
                                        <div class="row">
                                            <div class="col-12 text-center mb-2">
                                                <img src="resources/logo.svg" class="" height="80px">
                                            </div>
                                            <div class="col-12 text-center mb-4">
                                                <p class="m-0 fw-bold">Sanchitha Heshan</p>
                                                <p class="m-0 fw-bold text-black-50">Managing Director</p>
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
                                                <a href="adminManageCategories.php" class="aclass">Manage Categories ...</a>
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
                                                <button class="btn btn-outline-dark">Logout</button>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-lg-9">
                        <div class="row d-flex justify-content-center">

                            <div class="col-12">
                                <div class="row d-flex justify-content-center">

                                    <div class="col-6 col-lg-3 mt-2">
                                        <div class="col-12 border border-1 text-center rounded-4">
                                            <p class="text-danger fs-4 fw-bold">All Users</p>

                                            <div class="col-12">
                                                <canvas id="userChart"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-lg-3 mt-2">
                                        <div class="col-12 border border-1 text-center rounded-4">
                                            <p class="text-danger fs-4 fw-bold">All Products</p>

                                            <div class="col-12">
                                                <canvas id="productChart"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-lg-3 mt-2">
                                        <div class="col-12 border border-1 text-center rounded-4">
                                            <p class="text-danger fs-4 fw-bold">All Sellers</p>

                                            <div class="col-12">
                                                <canvas id="sellerChart"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-lg-3 mt-2">
                                        <div class="col-12 border border-1 text-center rounded-4">
                                            <p class="text-danger fs-4 fw-bold">Users vs Sellers</p>

                                            <div class="col-12">
                                                <canvas id="userVSsellerChart"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-8 mt-5">
                            <p class="text-secondary fs-4 fw-bold">Invoice Details</p>
                            <hr class="border border-3 border-primary">
                        </div>
                        <div class="col-12 mt-3 text-end">
                            <a href="generateAdminPDF.php" class="btn btn-dark">Dowload PDF</a>
                        </div>


                        <div class="col-12">
                            <div class="row d-flex justify-content-center">
                                <div class="col-10">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
<script>
    var janPrice = 0;
    var FebPrice = 0;
    var MarPrice = 0;
    var AprPrice = 0;
    var MayPrice = 0;
    var JunPrice = 0;
    var JulPrice = 0;
    var AugPrice = 0;
    var SapPrice = 0;
    var OctPrice = 0;
    var NovPrice = 0;
    var DecPrice = 0;

    <?php
    $monthly_totals = array_fill(0, 12, 0);
    $monthly_qtys = array_fill(0, 12, 0);

    $invoice_rs = Database::Search("SELECT * FROM `invoice`");
    $invoice_num = $invoice_rs->num_rows;

    for ($i = 0; $i < $invoice_num; $i++) {
        $invoice_data = $invoice_rs->fetch_assoc();
        $date_time = $invoice_data["date_time"];
        $total = $invoice_data["total"];
        $qty = $invoice_data["buy_qty"];

        $date = new DateTime($date_time);
        $month = intval($date->format('m')); 

        $monthly_totals[$month - 1] += $total;
        $monthly_qtys[$month - 1] += $qty;
    }

    ?>

    var janPrice = <?php echo $monthly_totals[0]; ?>;
    var FebPrice = <?php echo $monthly_totals[1]; ?>;
    var MarPrice = <?php echo $monthly_totals[2]; ?>;
    var AprPrice = <?php echo $monthly_totals[3]; ?>;
    var MayPrice = <?php echo $monthly_totals[4]; ?>;
    var JunPrice = <?php echo $monthly_totals[5]; ?>;
    var JulPrice = <?php echo $monthly_totals[6]; ?>;
    var AugPrice = <?php echo $monthly_totals[7]; ?>;
    var SepPrice = <?php echo $monthly_totals[8]; ?>;
    var OctPrice = <?php echo $monthly_totals[9]; ?>;
    var NovPrice = <?php echo $monthly_totals[10]; ?>;
    var DecPrice = <?php echo $monthly_totals[11]; ?>;

    var janQty = <?php echo $monthly_qtys[0]; ?>;
    var FebQty = <?php echo $monthly_qtys[1]; ?>;
    var MarQty = <?php echo $monthly_qtys[2]; ?>;
    var AprQty = <?php echo $monthly_qtys[3]; ?>;
    var MayQty = <?php echo $monthly_qtys[4]; ?>;
    var JunQty = <?php echo $monthly_qtys[5]; ?>;
    var JulQty = <?php echo $monthly_qtys[6]; ?>;
    var AugQty = <?php echo $monthly_qtys[7]; ?>;
    var SepQty = <?php echo $monthly_qtys[8]; ?>;
    var OctQty = <?php echo $monthly_qtys[9]; ?>;
    var NovQty = <?php echo $monthly_qtys[10]; ?>;
    var DecQty = <?php echo $monthly_qtys[11]; ?>;

    var ctx = document.getElementById('myChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar', // Type of chart
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], // Labels for the X-axis
            datasets: [{
                    label: 'Amount', // Label for the first dataset
                    data: [janPrice, FebPrice, MarPrice, AprPrice, MayPrice, JunPrice, JulPrice, AugPrice, SepPrice, OctPrice, NovPrice, DecPrice], // Data for the first dataset
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Background color for the first dataset bars
                    borderColor: 'rgba(255, 99, 132, 1)', // Border color for the first dataset bars
                    borderWidth: 1 // Border width for the first dataset bars
                },
                {
                    label: 'Quentity', // Label for the second dataset
                    data: [janQty, FebQty, MarQty, AprQty, MayQty, JunQty, JulQty, AugQty, SepQty, OctQty, NovQty, DecQty], // Data for the second dataset
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Background color for the second dataset bars
                    borderColor: 'rgba(54, 162, 235, 1)', // Border color for the second dataset bars
                    borderWidth: 1 // Border width for the second dataset bars
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Ensure the Y-axis starts at zero
                }
            }
        }
    });

    <?php
    $allUsers = 0;
    $activeUsers = 0;
    $inactiveUsers = 0;

    $user_rs = Database::Search("SELECT * FROM `user`");
    $user_num = $user_rs->num_rows;
    $allUsers = $user_num;

    if ($user_num != 0) {
        for ($u = 0; $u < $user_num; $u++) {
            $user_data = $user_rs->fetch_assoc();

            if ($user_data["status"] == 1) {
                $activeUsers += 1;
            } else {
                $inactiveUsers += 1;
            }
        }
    }

    ?>

    var allUsers = <?= $allUsers ?>;
    var activeUsers = <?= $activeUsers ?>;
    var inactiveUsers = <?= $inactiveUsers ?>;
    // user Chart
    var ctx1 = document.getElementById('userChart').getContext('2d');

    // Create the donut chart
    new Chart(ctx1, {
        type: 'doughnut', // Type of chart
        data: {
            labels: ['All', 'Active', 'Inactive'], // Labels for the segments
            datasets: [{
                label: 'Value', // Label for the dataset
                data: [allUsers, activeUsers, inactiveUsers], // Data for the segments
                backgroundColor: [ // Background colors for each segment
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [ // Border colors for each segment
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1 // Border width for the segments
            }]
        },
        options: {
            responsive: true, // Make the chart responsive
            plugins: {
                legend: {
                    position: 'top', // Position of the legend
                },
                tooltip: {
                    enabled: true // Enable tooltips
                }
            }
        }
    });

    <?php
    $allProducts = 0;
    $activeProducts = 0;
    $inactiveProducts = 0;

    $Product_rs = Database::Search("SELECT * FROM `product`");
    $Product_num = $Product_rs->num_rows;
    $allProducts = $Product_num;

    if ($Product_num != 0) {
        for ($u = 0; $u < $Product_num; $u++) {
            $Product_data = $Product_rs->fetch_assoc();

            if ($Product_data["status_s_id"] == 1 || $Product_data["admin_status"] == 1) {
                $activeProducts += 1;
            } else {
                $inactiveProducts += 1;
            }
        }
    }

    ?>

    var allProducts = <?= $allProducts ?>;
    var activeProducts = <?= $activeProducts ?>;
    var inactiveProducts = <?= $inactiveProducts ?>;

    // Product Chart
    var ctx2 = document.getElementById('productChart').getContext('2d');

    // Create the donut chart
    new Chart(ctx2, {
        type: 'doughnut', // Type of chart
        data: {
            labels: ['All', 'Active', 'Inactive'], // Labels for the segments
            datasets: [{
                label: 'Value', // Label for the dataset
                data: [allProducts, activeProducts, inactiveProducts], // Data for the segments
                backgroundColor: [ // Background colors for each segment
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [ // Border colors for each segment
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1 // Border width for the segments
            }]
        },
        options: {
            responsive: true, // Make the chart responsive
            plugins: {
                legend: {
                    position: 'top', // Position of the legend
                },
                tooltip: {
                    enabled: true // Enable tooltips
                }
            }
        }
    });

    <?php
    $allSellers = 0;
    $activeSellers = 0;
    $inactiveSellers = 0;

    $Seller_rs = Database::Search("SELECT * FROM `seller`");
    $Seller_num = $Seller_rs->num_rows;
    $allSellers = $Seller_num;

    if ($Seller_num != 0) {
        for ($u = 0; $u < $Seller_num; $u++) {
            $Seller_data = $Seller_rs->fetch_assoc();

            if ($Seller_data["s_status"] == 2) {
                $activeSellers += 1;
            } else if($Seller_data["s_status"] == 3) {
                $inactiveSellers += 1;
            }
        }
    }

    ?>

    var allSellers = <?= $allSellers ?>;
    var activeSellers = <?= $activeSellers ?>;
    var inactiveSellers = <?= $inactiveSellers ?>;

    // Seller Chart
    var ctx3 = document.getElementById('sellerChart').getContext('2d');

    // Create the donut chart
    new Chart(ctx3, {
        type: 'doughnut', // Type of chart
        data: {
            labels: ['All', 'Active', 'Inactive'], // Labels for the segments
            datasets: [{
                label: 'Value', // Label for the dataset
                data: [allSellers, activeSellers, inactiveSellers], // Data for the segments
                backgroundColor: [ // Background colors for each segment
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [ // Border colors for each segment
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1 // Border width for the segments
            }]
        },
        options: {
            responsive: true, // Make the chart responsive
            plugins: {
                legend: {
                    position: 'top', // Position of the legend
                },
                tooltip: {
                    enabled: true // Enable tooltips
                }
            }
        }
    });

    // User VS Seller Chart
    var ctx4 = document.getElementById('userVSsellerChart').getContext('2d');

    // Create the donut chart
    new Chart(ctx4, {
        type: 'doughnut', // Type of chart
        data: {
            labels: ['Users', 'Sellers'], // Labels for the segments
            datasets: [{
                label: 'Value', // Label for the dataset
                data: [allUsers, allSellers], // Data for the segments
                backgroundColor: [ // Background colors for each segment
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [ // Border colors for each segment
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1 // Border width for the segments
            }]
        },
        options: {
            responsive: true, // Make the chart responsive
            plugins: {
                legend: {
                    position: 'top', // Position of the legend
                },
                tooltip: {
                    enabled: true // Enable tooltips
                }
            }
        }
    });
</script>

</html>