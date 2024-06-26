<?php
session_start();
$user_email = $_SESSION["user"]["email"];
require "connection.php";

$Gtotal = 0;
class data
{
    public $order_id;
    public $date;
    public $p_id;
    public $p_name;
    public $nic;
    public $unit_price;
    public $qty;
    public $cost_colombo;
    public $cost_other;
    public $total;

    // Constructor to initialize properties
    public function __construct($order_id, $date, $p_id, $p_name, $nic, $unit_price, $qty, $cost_colombo, $cost_other)
    {
        $this->order_id = $order_id;
        $this->date = $date;
        $this->p_id = $p_id;
        $this->p_name = $p_name;
        $this->nic = $nic;
        $this->unit_price = $unit_price;
        $this->qty = $qty;
        $this->cost_colombo = $cost_colombo;
        $this->cost_other = $cost_other;
        $this->qty = $qty;
        $this->total = $qty * $unit_price;
        $Gtotal = $this->total;
    }
}

if (isset($_GET["id"])) {
    $order_id = $_GET["id"];
    $items = array();

    $invoice_rs = Database::Search(" SELECT * FROM `invoice` 
    INNER JOIN `product` ON `invoice`.`product_id`=`product`.`id`
    INNER JOIN `seller` ON `product`.`seller_nic`=`seller`.`nic`
    WHERE `order_id` = '" . $order_id . "' ");

    $invoice_num = $invoice_rs->num_rows;

    for ($i = 0; $i < $invoice_num; $i++) {
        $invoice_data = $invoice_rs->fetch_assoc();

        $items[] = new data(
            $invoice_data["order_id"],
            $invoice_data["date_time"],
            $invoice_data["product_id"],
            $invoice_data["title"],
            $invoice_data["nic"],
            $invoice_data["price"],
            $invoice_data["buy_qty"],
            $invoice_data["cost_colombo"],
            $invoice_data["cost_others"]
        );
    }

    $user_rs = Database::Search(" SELECT * FROM `user_has_address` WHERE `user_email`='" . $user_email . "' ");
    $user_data = $user_rs->fetch_assoc();




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

                <div class="col-12 my-2 text-end">
                    <button class="btn btn-danger" onclick="printInvoice();">Print</button>
                    <button class="btn btn-dark" onclick="sendAsEmail();">Send Email</button>
                </div>

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

                                        <div class="col-12">
                                            <p class="m-0 fs-5 fw-bold text-primary">INVOICE TO :</p>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <p class="m-0 fs-6 fw-bold"><?php echo ($_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"]) ?></p>
                                                <p class="m-0 fw-bold"><?php echo ($user_data["line_1"] . ", " . $user_data["line_2"]); ?></p>
                                                <p class="m-0 fw-bold"><?php echo ($_SESSION["user"]["email"]) ?></p>
                                                <p class="m-0 fw-bold">Contact No : <?php echo ($_SESSION["user"]["mobile"]) ?></p>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-4 text-end">
                                    <p class="m-0 fs-5 fw-bold text-primary">INVOICE NO : <?php echo ($invoice_data["order_id"]) ?></p>
                                    <p class="m-0 fw-bold">Purchased Date Time : <?php echo ($invoice_data["date_time"]) ?></p>
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
                                                <th scope="col" class="bg-secondary text-white">Product ID</th>
                                                <th scope="col" class="bg-info text-white">Product Name</th>
                                                <th scope="col" class="bg-secondary text-white">Seller NIC</th>
                                                <th scope="col" class="bg-info text-white">Unit Price LKR:</th>
                                                <th scope="col" class="bg-secondary text-white">Qty</th>
                                                <th scope="col" class="bg-info text-white">Total LKR:</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($items as $item) {
                                            ?>
                                                <tr>
                                                    <td class="bg-secondary text-white"><?php echo ($item->p_id) ?></td>
                                                    <td class="bg-info text-white"><?php echo ($item->p_name) ?></td>
                                                    <td class="bg-secondary text-white"><?php echo ($item->nic) ?></td>
                                                    <td class="bg-info text-white"><?php echo ($item->unit_price) ?></td>
                                                    <td class="bg-secondary text-white"><?php echo ($item->qty) ?></td>
                                                    <td class="bg-info text-white"><?php echo ($item->total) ?></td>
                                                </tr>

                                            <?php
                                            }

                                            ?>
                                        </tbody>
                                    </table>

                                </div>

                                <?php

                                $district_rs = Database::Search(" SELECT * FROM `city` WHERE `ci_id`='" . $user_data["city_id"] . "' ");
                                $district_data = $district_rs->fetch_assoc();
                                $delivar_fee;

                                if ($district_data["distric_id"] == "1") {
                                    $delivar_fee = $invoice_data["cost_colombo"];
                                } else {
                                    $delivar_fee = $invoice_data["cost_others"];
                                }

                                $t = $invoice_data["total"];
                                $sub_total = $t - $invoice_data["shipping"];

                                ?>

                                <div class="col-12 mt-2">
                                    <div class="row text-end">

                                        <div class="col-12">
                                            <div class="row">
                                                <p class="m-0 mt-2"><span class="fs-5 fw-bold text-primary">SUB TOTAL </span>LKR : <?php echo ($sub_total) ?>.00 </p>
                                                <p class="m-0 mt-2"><span class="fs-5 fw-bold text-primary">DELIVARY FEE </span>LKR : <?php echo ($invoice_data["shipping"]) ?>.00 </p>
                                            </div>
                                            <div class="col-4 offset-8">
                                                <hr class="border border-primary border-1">
                                            </div>
                                            <div class="col-12">
                                                <div class="row fw-bold">
                                                    <p class="m-0"><span class="fs-5 fw-bold text-primary">GRAND TOTAL </span>LKR : <?php echo ($invoice_data["total"]) ?>.00 </p>
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
                                        <span class="ms-3">Purchased items can return befor 7 days of Delivery.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr>
                            </div>

                            <div class="col-12 text-center">
                                <p class="fw-bold text-black-50">Invoice was created on a computer and is valid without the Signature and Seal.</p>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- print & Email Content -->


                <?php include "footer.php" ?>

                <!-- toast -->

                <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toast">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-secondary text-white">
                            <img src="resources/logo.svg" height="30px" class="rounded me-2" alt="...">
                            <strong class="me-auto">Emart</strong>
                            <small>Massage</small>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body bg-dark fw-bold text-white" id="invoicecoastText">
                            Your Product Sucessfully Updated ...
                        </div>
                    </div>
                </div>

                <!-- toast -->

            </div>
        </div>

        <script src="bootstrap.js"></script>
        <script src="script.js"></script>
    </body>

    </html>
<?php
}
?>