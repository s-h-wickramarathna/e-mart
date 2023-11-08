<?php
session_start();
require "connection.php";

if (isset($_GET["i"])) {

    $search = $_GET["i"];

    $invoice_rs = Database::Search(" SELECT * FROM `invoice`
    INNER JOIN `product` ON `invoice`.`product_id`=`product`.id
     WHERE `user_email`='" . $_SESSION["user"]["email"] . "' AND `Delete_Number`='1' AND `title` LIKE '%" . $search . "%' ");
    $invoice_num = $invoice_rs->num_rows;

    if ($invoice_num > 0) {

        for ($w = 0; $w < $invoice_num; $w++) {
            $invoice_data = $invoice_rs->fetch_assoc();

?>

            <div class="card col-11 mb-3 shadow" id="longCard">
                <div class="row g-0">
                    <div class="col-md-4 col-lg-4 col-xl-3 overflow-hidden">
                        <img src="resources/iphone.jpg" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">

                            <div class="col-12 mb-2">
                                <a href="#" class="fw-bold textcolor mb-5"><?php echo ($invoice_data["title"]) ?></a>
                            </div>

                            <div class="col-12">
                                <p class="m-0">LKR : <span class="fs-4 fw-bold text"><?php echo ($invoice_data["price"]) ?>.00</span></p>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="row d-flex align-items-baseline">
                                    <div class="col-3">Quentity :-</div>
                                    <div class="col-6"><input type="number" class="form-control shadow-none" value="<?php echo ($invoice_data["buy_qty"]) ?>" disabled value="1" min="0" max="10" /></div>
                                </div>
                            </div>

                            <?php
                            $shipping;

                            $address_rs = Database::Search(" SELECT * FROM `user_has_address` INNER JOIN `city` ON `user_has_address`.`city_id`=`city`.`ci_id` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' ");
                            $address_data = $address_rs->fetch_assoc();

                            if ($address_data["distric_id"] == "1") {
                                $shipping = $invoice_data["cost_colombo"];
                            } else {
                                $shipping = $invoice_data["cost_others"];
                            }


                            ?>

                            <div class="col-12">
                                <p class="m-0">shipping : LKR . <?php echo ($shipping) ?>.00</p>
                            </div>

                            <div class="col-12">
                                <p class="m-0"><?php echo ($invoice_num) ?> Sold</p>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <p class=" mt-1 fw-bold">TOTAL LKR : <?php echo ($invoice_data["total"]); ?> </p>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <p class="fw-bold"><i class="bi bi-trophy-fill text-warning">&nbsp;&nbsp;</i>Top Rated Seller</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 text-end">
                                <p class="text-black-50 fw-bold"><?php echo ($invoice_data["date_time"]) ?></p>
                            </div>

                            <div class="col-12 text-end">
                                <button class="btn btn-outline-dark" onclick="feedbackModel();">Rate & Send FeedBack</button>
                                <button class="btn btn-danger" onclick="deleteFromPurchasedHistory('<?php echo ($invoice_data['invoice_id']) ?>');">Delete</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            

        <?php

        }
    } else {

        ?>

        <div class="col-12 d-flex justify-content-center">

            <img src="resources/EmptyPurchasedGIF.gif" height="400px">

        </div>

<?php

    }
}





?>