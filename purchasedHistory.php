<?php
session_start();
require "connection.php";

if (isset($_SESSION["user"])) {
    $user_email = $_SESSION["user"]["email"];

    $invoice_rs = Database::Search("SELECT * FROM `invoice` WHERE `user_email`='" . $user_email . "' AND `Delete_Number`='1' ");
    $invoice_num = $invoice_rs->num_rows;

?>




    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Emart || My Purchased History</title>

        <link rel="icon" href="resources/logo.svg" />

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 mb-2 bg-light shadow">
                    <div class="row d-flex justify-content-end">

                        <div class="col-3">
                            <div class="fs-3 mt-0"> <a href="#" class="aclass"><span class="namef">E</span>mart</a></div>
                        </div>

                        <!-- <div class="col-8 col-lg-6 offset-1 offset-lg-3">
                            <div class="row mt-4">
                                <div class="input-group">
                                    <input type="text" class="form-control shadow-none" placeholder="Search Your Purchesed Items ..." id="purchased_S" onkeyup="searchPurchasedHistoryitems();">
                                    <button class="btn btn-primary" type="button" onclick="searchPurchasedHistoryitems();"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-9 mt-4 text-end">
                            <p class="m-0 fs-4 fw-bold">My Product Purchased History Page ....</p>
                            <hr>
                        </div>

                    </div>
                </div>

                <div class="col-12 mt-2">
                    <div class="row mt-2 mb-3 shadow">

                        <div class="col-12 col-lg-4 mt-3 shadow border-end">
                            <div class="row justify-content-center">

                                <hr>

                                <div class="col-12">
                                    <p class="m-0 mt-3 fs-5 fw-bold ms-2">SUMMARY (Purcheased Items)</p>
                                </div>
                                <div class="col-11">
                                    <hr class="border border-4 border-dark">
                                </div>

                                <div class="col-12 text-end">
                                    <div class="row justify-content-end">
                                        <p class="m-0 fw-bold fs-6 mt-1">LKR / ITEMS</p>
                                        <div class="col-4">
                                            <hr class="border border-1 border-dark">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="row">

                                                <div class="col-6">
                                                    <p class="m-0 fs-6 fw-bold">ALL ITEMS :</p>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <p class="m-0 fw-bold"><?php echo ($invoice_num) ?></p>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="row justify-content-end">

                                                <div class="col-12">
                                                    <hr class="border border-4 border-primary">
                                                </div>

                                            </div>
                                        </div>


                                        <div class="col-12 mt-4 fw-bold">
                                            <p><span class="text-danger">NOTICE,</span> You should know that any product you delete here cannot be recovered.</p>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <hr class="m-0 mt-1 mb-1 border border-4 border-dark">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <hr class=" m-0 border border-4 border-dark">
                                        </div>

                                        <div class="col-12 mt-3 text-end text-lg-center">
                                            <button class="btn btn-dark" onclick="deleteALLpurchesedItems();">DELETE ALL</button>
                                        </div>

                                    </div>
                                </div>


                            </div>

                        </div>

                        <div class="col-12 col-lg-8 bg-danger bg-light" style="height: 80vh;">
                            <div class="row mt-4 justify-content-center overflow-auto" id="purchesedItemView">

                                <?php

                                if ($invoice_num > 0) {
                                    for ($i = 0; $i < $invoice_num; $i++) {

                                        $invoice_data = $invoice_rs->fetch_assoc();

                                        $product_rs = Database::Search("SELECT * FROM `product` WHERE `id` = '" . $invoice_data["product_id"] . "' ");
                                        $product_data = $product_rs->fetch_assoc();

                                ?>

                                        <div class="card col-11 mb-3 shadow" id="longCard">
                                            <div class="row g-0">
                                                <div class="col-md-4 col-lg-4 col-xl-3 overflow-hidden">
                                                    <img src="resources/iphone.jpg" class="img-fluid">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">

                                                        <div class="col-12 mb-2">
                                                            <a href="#" class="fw-bold textcolor mb-5"><?php echo ($product_data["title"]) ?></a>
                                                        </div>

                                                        <div class="col-12">
                                                            <p class="m-0">LKR : <span class="fs-4 fw-bold text"><?php echo ($product_data["price"]) ?>.00</span></p>
                                                        </div>

                                                        <div class="col-12 mb-2">
                                                            <div class="row d-flex align-items-baseline">
                                                                <div class="col-3">Quentity :-</div>
                                                                <div class="col-6"><input type="number" class="form-control shadow-none" value="<?php echo ($invoice_data["buy_qty"]) ?>" disabled value="1" min="0" max="10" /></div>
                                                            </div>
                                                        </div>

                                                        <?php
                                                        $shipping;

                                                        $address_rs = Database::Search(" SELECT * FROM `user_has_address` INNER JOIN `city` ON `user_has_address`.`city_id`=`city`.`ci_id` WHERE `user_email`='" . $user_email . "' ");
                                                        $address_data = $address_rs->fetch_assoc();

                                                        if ($address_data["distric_id"] == "1") {
                                                            $shipping = $product_data["cost_colombo"];
                                                        } else {
                                                            $shipping = $product_data["cost_others"];
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
                                                            <?php
                                                            
                                                            $f_rs = Database::Search("SELECT * FROM `feedbacks` WHERE `product_id`='".$invoice_data["product_id"]."' AND `user_email`='".$user_email."' ");
                                                            $f_num = $f_rs->num_rows;

                                                            if($f_num == 0){
                                                                ?>
                                                            <button class="btn btn-outline-dark" onclick="feedbackModel('<?php echo ($invoice_data['invoice_id']) ?>');">Rate & Send FeedBack</button>
                                                                <?php
                                                            }else{
                                                                ?>
                                                            <button class="btn btn-success disabled"><i class="bi bi-check2-all"></i></button>
                                                                <?php
                                                            }

                                                            ?>
                                                            <button class="btn btn-danger" onclick="deleteFromPurchasedHistory('<?php echo ($invoice_data['invoice_id']) ?>');">Delete</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- model -->

                                        <div class="modal" tabindex="-1" id="Rate&Feedbacts<?php echo ($invoice_data['invoice_id']) ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">FeedBack & Rate ...</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="col-12 d-flex justify-content-center">

                                                            <input type="checkbox" class="d-none" id="star1<?php echo ($invoice_data['invoice_id']) ?>" onchange="rates1('<?php echo ($invoice_data['invoice_id']) ?>');" />
                                                            <label class="fs-4 text-warning mx-2" for="star1<?php echo ($invoice_data['invoice_id']) ?>"><i class="bi bi-star" id="starpic1<?php echo ($invoice_data['invoice_id']) ?>"></i></label>
                                                            <input type="checkbox" class="d-none" id="star2<?php echo ($invoice_data['invoice_id']) ?>" onchange="rates2('<?php echo ($invoice_data['invoice_id']) ?>');" />
                                                            <label class="fs-4 text-warning mx-2" for="star2<?php echo ($invoice_data['invoice_id']) ?>"><i class="bi bi-star" id="starpic2<?php echo ($invoice_data['invoice_id']) ?>"></i></label>
                                                            <input type="checkbox" class="d-none" id="star3<?php echo ($invoice_data['invoice_id']) ?>" onchange="rates3('<?php echo ($invoice_data['invoice_id']) ?>');" />
                                                            <label class="fs-4 text-warning mx-2" for="star3<?php echo ($invoice_data['invoice_id']) ?>"><i class="bi bi-star" id="starpic3<?php echo ($invoice_data['invoice_id']) ?>"></i></label>
                                                            <input type="checkbox" class="d-none" id="star4<?php echo ($invoice_data['invoice_id']) ?>" onchange="rates4('<?php echo ($invoice_data['invoice_id']) ?>');" />
                                                            <label class="fs-4 text-warning mx-2" for="star4<?php echo ($invoice_data['invoice_id']) ?>"><i class="bi bi-star" id="starpic4<?php echo ($invoice_data['invoice_id']) ?>"></i></label>

                                                        </div>
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <p class="fw-bold" id="rateText<?php echo ($invoice_data['invoice_id']) ?>"></p>
                                                        </div>
                                                        <hr>
                                                        <div class="col-12 mt-2">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p class="fs-5 text-black-50">Type Your Feelings >>></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <textarea name="" class="col-12 form-control shadow-none" id="f_text<?php echo ($invoice_data['invoice_id']) ?>" cols="30" rows="5"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" onclick="sendFeedBacks('<?php echo ($invoice_data['invoice_id']) ?>','<?php echo ($invoice_data['product_id']) ?>');">Rate & Send</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- model -->

                                    <?php

                                    }
                                } else {

                                    ?>

                                    <div class="col-12 d-flex justify-content-center">

                                        <img src="resources/EmptyPurchasedGIF.gif" height="400px">

                                    </div>



                                <?php

                                }


                                ?>

                            </div>
                        </div>


                    </div>
                </div>

                <?php include "footer.php" ?>


            </div>
        </div>

        <script src="bootstrap.js"></script>
        <script src="script.js"></script>
    </body>

    </html>
<?php

} else {

    header("Location:index.php");
}

?>