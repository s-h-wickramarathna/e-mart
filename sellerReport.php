<?php
session_start();
$s_nic = $_SESSION["seller"]["nic"];
require "connection.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emart || Products Invoice</title>

    <link rel="icon" href="resources/company-logo.png" />

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- print & Email Content -->

            <div class="col-12" id="page">
                <div class="row">

                    <div class="col-12 border-top border-bottom">
                        <div class="row">

                            <div class="col-6 mb-0">
                                <div class="row">
                                    <div class="col-12 col-xl-6 logo-bg-color">
                                        <div class="row p-4">
                                            <div class="col-12 logo_invoice"></div>
                                            <div class="col-12 text-center">
                                                <p class="fs-1 title_01 m-0"><span class="title_02">E</span>mart</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mt-3">
                                <div class="row text-start mt-3">
                                    <div class="col-11 col-sm-9 col-md-7 col-lg-5 offset-1 offset-sm-3 offset-md-5 offset-lg-7 fs-6 fw-bold">
                                        <p class="m-0">12/5,<br /> Sinhasana Road,<br /> Dondra,<br /> Matara,<br /> Sri Lanka</p>
                                        <p class="m-0">Emart@gmail.com</p>
                                        <span><span>Tel :</span> +94 76 456 4321</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row mt-2">

                            <div class="col-8">
                                <div class="row">

                                </div>
                            </div>

                            <div class="col-4 text-end">
                                <p class="m-0 fw-bold">Purchased Date Time : <?php
                                                                                $date = new DateTime();
                                                                                $currentDate = $date->format('Y-m-d H:i:s'); // Format: 2024-06-25 13:45:17
                                                                                echo $currentDate;
                                                                                ?></p>
                            </div>

                        </div>
                    </div>


                    <div class="col-12">
                        <hr>
                    </div>

                    <div class="col-12 mt-2 mb-2">
                        <div class="row">

                            <div class="table-responsive">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="bg-secondary text-white">Invoice ID</th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white">Product ID</th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white">Date</th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-info text-white">Unit Price LKR:</th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white">Qty</th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-secondary text-white"></th>
                                            <th scope="col" class="bg-info text-white">Total LKR:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $grandTotal = 0;
                                        $invoice_rs = Database::Search(" SELECT * FROM `invoice` 
                                               INNER JOIN `product` ON `invoice`.`product_id`=`product`.`id`
                                               INNER JOIN `seller` ON `product`.`seller_nic`=`seller`.`nic`
                                               WHERE product.seller_nic='" . $s_nic . "'");

                                        $invoice_num = $invoice_rs->num_rows;

                                        for ($i = 0; $i < $invoice_num; $i++) {
                                            $invoice_data = $invoice_rs->fetch_assoc();
                                            $grandTotal += $invoice_data["total"];

                                        ?>
                                            <tr>
                                                <td class="bg-secondary text-white"><?php echo ($invoice_data["invoice_id"]) ?></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-info text-white"><?php echo ($invoice_data["product_id"]) ?></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"><?php echo ($invoice_data["date_time"]) ?></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-info text-white"><?php echo ($invoice_data["price"]) ?></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"><?php echo ($invoice_data["buy_qty"]) ?></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-secondary text-white"></td>
                                                <td class="bg-info text-white"><?php echo ($invoice_data["total"]) ?></td>
                                            </tr>

                                        <?php
                                        }

                                        ?>
                                    </tbody>
                                </table>

                            </div>

                            <div class="col-12 mt-2">
                                <div class="row text-end">

                                    <div class="col-12">
                                        <div class="col-4 offset-8">
                                            <hr class="border border-primary border-1">
                                        </div>
                                        <div class="col-12">
                                            <div class="row fw-bold">
                                                <p class="m-0"><span class="fs-5 fw-bold text-primary">GRAND TOTAL </span>LKR : <?php echo ($grandTotal) ?>.00 </p>
                                            </div>
                                        </div>
                                        <div class="col-4 offset-8">
                                            <hr class="border border-primary border-5">
                                        </div>

                                    </div>
                                </div>



                            </div>

                        </div>


                        <div class="col-12 mt-2 mb-3 invoice_bg_notice_colour rounded-3 border-start border-end border-5 border-primary">
                            <div class="row">
                                <div class="col-12 m-3">
                                    <p class=" m-0 fs-5 fw-bold">NOTICE : </p>
                                    <span class="ms-3">Invoice was created on a computer and is valid without the Signature and Seal.</span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- print & Email Content -->

        </div>
    </div>

    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>