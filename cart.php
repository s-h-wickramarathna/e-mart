<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emart || My Cart</title>

    <link rel="icon" href="resources/logo.svg" />

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<?php
session_start();
require "connection.php";

if (isset($_SESSION["user"])) {
    $user_email = $_SESSION["user"]["email"];

    Database::iud("UPDATE `cart` SET `veiw_status`='1' WHERE `user_email`='" . $user_email . "' ");

    $isAddressHave = false;
    $sub_total = 0;
    $shipping_cost = 0;
    $total = 0;
    $grandTotal = 0;

?>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 mb-2 bg-light shadow">
                    <div class="row py-1 d-flex justify-content-end p-2">

                        <div class="col-3">
                            <div class="fs-3 mt-0"> <a href="#" class="aclass"><span class="namef">E</span>mart</a></div>
                        </div>

                        <div class="col-8 col-lg-6 offset-1 offset-lg-3">
                            <div class="row mt-4">
                                <div class="input-group">
                                    <input type="text" class="form-control shadow-none" placeholder="Search From Cart ..." onkeyup="searchFromCart();" id="cartP_search">
                                    <button class="btn btn-primary" type="button"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

                <div class="col-12 mt-2 mb-2">
                    <p class="m-0 fs-4 fw-bold">My Shopping Cart ....</p>
                    <hr>
                </div>

                <div class="col-12 mt-2">
                    <div class="row mt-2 mb-3 shadow">

                        <div class="col-12 col-lg-8 bg-danger bg-light" style="height: 80vh;">
                            <div class="row mt-4 justify-content-center overflow-auto" id="loadProductfromcart">

                                <?php

                                $cart_rs = Database::Search("SELECT * FROM `cart` WHERE `user_email`='" . $user_email . "' ORDER BY `cart_datetime` DESC ");
                                $cart_num  = $cart_rs->num_rows;

                                if ($cart_num == 0) {
                                ?>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12 d-flex justify-content-center">
                                                <img src="resources/emptyCartGif.gif" height="400px">
                                            </div>
                                            <div class="col-12 d-flex justify-content-center">
                                                <p class="fs-5 fw-bold">Your Cart Is Empty ...</p>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center">
                                                <button class="btn btn-outline-primary">Shop Now</button>
                                            </div>

                                        </div>
                                    </div>

                                <?php
                                }

                                for ($i = 0; $i < $cart_num; $i++) {

                                    $cart_data = $cart_rs->fetch_assoc();

                                    $product_rs = Database::Search("SELECT * FROM `product` 
                                    INNER JOIN `seller` ON `product`.`seller_nic`=`seller`.`nic`
                                    INNER JOIN `user` ON `seller`.`user_email`=`user`.`email`
                                    INNER JOIN `user_has_address` ON `user`.`email`=`user_has_address`.`user_email`
                                    INNER JOIN `city` ON `user_has_address`.`city_id`=`city`.`ci_id`
                                    WHERE `product`.`id`='" . $cart_data["product_id"] . "' ");
                                    $product_data = $product_rs->fetch_assoc();





                                ?>

                                    <div class="card col-11 mb-3 shadow cardHover" id="longCard">
                                        <div class="row g-0">
                                            <div class="col-md-4 text-center">
                                                <?php

                                                $p_img = "resources/emptyProducts.png";

                                                $product_img_rs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $product_data["id"] . "' ");
                                                $product_img_num = $product_img_rs->num_rows;

                                                if ($product_img_num > 0) {
                                                    $product_img_data = $product_img_rs->fetch_assoc();
                                                    $p_img = $product_img_data["p_path"];
                                                }

                                                ?>
                                                <img src="<?php echo ($p_img); ?>" class="img-fluid">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">

                                                    <div class="col-12">
                                                        <?php
                                                        $p_title_cart = str_split($product_data["title"], 50);
                                                        ?>
                                                        <p class="fw-bold"><?php echo ($p_title_cart[0] . " ...") ?></p>
                                                    </div>

                                                    <div class="col-12">
                                                        <p class="m-0">LKR : <span class="fs-4 fw-bold text"><?php echo ($product_data["price"]); ?></span></p>
                                                    </div>

                                                    <div class="col-12 mb-2">
                                                        <div class="row d-flex align-items-baseline">
                                                            <div class="col-6">
                                                                <p>Quentity :</p>
                                                                <div class="row">
                                                                    <?php
                                                                    $c_value;

                                                                    if ($product_data["qty"] < $cart_data["cart_qty"]) {
                                                                        $c_value = $product_data["qty"];

                                                                        Database::iud("UPDATE `cart` SET `cart_qty`='" . $c_value . "' WHERE `product_id`='" . $product_data["id"] . "' ");

                                                                    ?>
                                                                        <div class="col-6 d-flex justify-content-center"><input type="number" class="form-control shadow-none" value="<?php echo ($c_value) ?>" id="p_quentity<?php echo ($product_data["id"]) ?>" /></div>
                                                                        <div class="col-6">
                                                                            <i class="bi bi-plus-square fs-3 cursor active_cartBtn" onclick="cartQtyPlus('<?php echo ($product_data['id']) ?>',1);"></i>
                                                                            <i class="bi bi-dash-square fs-3 cursor active_cartBtn" onclick="cartQtyPlus('<?php echo ($product_data['id']) ?>',2);"></i>

                                                                        </div>
                                                                    <?php

                                                                    } else {
                                                                    ?>
                                                                        <div class="col-6 d-flex justify-content-center"><input type="number" class="form-control shadow-none" disabled value="<?php echo ($cart_data["cart_qty"]) ?>" id="p_quentity<?php echo ($product_data["id"]) ?>" /></div>
                                                                        <div class="col-6">
                                                                            <i class="bi bi-plus-square fs-3 cursor active_cartBtn" onclick="cartQtyPlus('<?php echo ($product_data['id']) ?>',1);"></i>
                                                                            <i class="bi bi-dash-square fs-3 cursor active_cartBtn" onclick="cartQtyPlus('<?php echo ($product_data['id']) ?>',2);"></i>

                                                                        </div>
                                                                    <?php
                                                                    }




                                                                    ?>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">

                                                        <?php

                                                        $user_rs = Database::Search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `user_has_address`.`city_id`=`city`.`ci_id` WHERE `user_email`='" . $user_email . "' ");
                                                        $user_num = $user_rs->num_rows;

                                                        if ($user_num == 0) {
                                                            $isAddressHave = false;
                                                        ?>
                                                            <p class="m-0">shipping : LKR . ------</p>
                                                        <?php
                                                        } else {
                                                            $isAddressHave = true;
                                                            $user_data = $user_rs->fetch_assoc();

                                                            $shipping = "0";

                                                            if ($user_data["distric_id"] == "1") {
                                                                $shipping = $product_data["cost_colombo"];
                                                                $shipping_cost = $shipping_cost + $shipping;
                                                            } else {
                                                                $shipping = $product_data["cost_others"];
                                                                $shipping_cost = $shipping_cost + $shipping;
                                                            }

                                                        ?>

                                                            <p class="m-0">shipping : LKR . <?php echo ($shipping) ?></p>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    <div class="col-12">
                                                        <?php

                                                        $invoice_rs = Database::Search("SELECT * FROM `invoice` WHERE `product_id`='" . $product_data["id"] . "' ");
                                                        $invoice_num = $invoice_rs->num_rows;

                                                        ?>
                                                        <p class="m-0"><?php echo ($invoice_num); ?> Sold</p>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <p class=" mt-1">from : <?php echo ($product_data["ci_name"]) ?></p>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <p class="fw-bold"><i class="bi bi-trophy-fill text-warning">&nbsp;&nbsp;</i>Top Rated Seller</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 text-end">
                                                        <p class="text-black-50 fw-bold"><?php echo ($cart_data["cart_datetime"]) ?></p>
                                                    </div>

                                                    <div class="col-12 text-end">
                                                        <button class="btn btn-outline-danger" onclick="removeFromProduct('<?php echo ($cart_data['cart_id']) ?>');">Remove</button>
                                                        <button class="btn btn-primary"  onclick="goToSingleProductVeiw('<?php echo ($product_data['id']) ?>');">Buy Now</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php

                                    $total = $total + ($product_data["price"] * $cart_data["cart_qty"]);
                                }

                                ?>

                            </div>
                        </div>

                        <div class="col-12 col-lg-4 mt-3">
                            <div class="row justify-content-center">

                                <hr>

                                <div class="col-12">
                                    <p class="m-0 mt-3 fs-5 fw-bold ms-2">SUMMARY (<?php echo ($cart_num) ?> Items)</p>
                                </div>
                                <div class="col-11">
                                    <hr class="border border-4 border-dark">
                                </div>

                                <div class="col-12 text-end">
                                    <div class="row justify-content-end">
                                        <p class="m-0 fw-bold fs-6 mt-1">LKR</p>
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
                                                    <p class="m-0 fs-6 fw-bold">SUB TOTAL :</p>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <p class="m-0 fw-bold"><?php echo ($total) ?>.00</p>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">

                                                <div class="col-6">
                                                    <p class="m-0 fs-6 fw-bold">SHIPPING :</p>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <p class="m-0 fw-bold"><?php echo ($shipping_cost) ?>.00</p>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="row justify-content-end">

                                                <div class="col-7">
                                                    <hr class="border border-4 border-primary">
                                                </div>

                                                <div class="col-6">
                                                    <p class="m-0 fs-6 fw-bold">GRAND TOTAL :</p>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <p class="m-0 fw-bold">
                                                        <?php
                                                        $grandTotal = $total + $shipping_cost;
                                                        echo ($grandTotal)
                                                        ?>.00
                                                    </p>
                                                </div>

                                                <div class="col-12">
                                                    <hr class="border border-4 border-primary">
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12 text-end text-lg-center">
                                            <?php
                                            if ($isAddressHave) {
                                            ?>
                                                <div id="paypal-button-container"></div>
                                            <?php
                                            } else {
                                            ?>
                                                <div id="paypal-button-container" hidden></div>
                                                <button type="button" class="btn btn-primary" onclick="window.location = 'userProfile.php'">Fill Shipping Information Before By</button>
                                            <?php
                                            }
                                            ?>

                                        </div>

                                        <div class="col-12 mt-4 fw-bold">
                                            <p>Need Help, Contact Us From <a href="#">Email.</a></p>
                                        </div>

                                        <div class="col-12">
                                            <hr class="m-0 mt-1 mb-1 border border-4 border-dark">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <hr class=" m-0 border border-4 border-dark">
                                        </div>

                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>

                <?php include "footer.php" ?>

            </div>
        </div>
        <script src="https://www.paypal.com/sdk/js?client-id=Ae8w3dvmEp3wwc0CEZHElfvSLjJd67zVPqIl4uhPqdLUoOOsHrXvrKcWiRgy-2nT_wS9nlvAI6u6QWb4&currency=USD"></script>
        <script src="script.js"></script>
    </body>
    <script>
        var amount = 0.00;
        window.onload = async function() {
            var b_qty = document.getElementById("buy_qty");


            var usdamount = await convertCurrency(<?= $grandTotal ?>);
            amount = usdamount;
            // alert(usdamount);
        };
        paypal.Buttons({
            createOrder: function(data, actions) {
                // Set up the transaction
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: amount // Set the amount to be paid
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // Capture the transaction
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    console.log('Transaction completed by ' + details.payer.name.given_name);
                    console.log(details); // Log details for further processing or record keeping
                    saveCartInvoice('<?= uniqid() ?>', <?= $grandTotal ?>, <?= $shipping_cost ?>);
                });
            },
            onError: function(err) {
                // Show an error message
                console.error('An error occurred during the transaction:', err);
            }
        }).render('#paypal-button-container');
        // This function displays Smart Payment Buttons on your web page.
    </script>

<?php
} else {

?>

    <div class="col-12 mw-100 vh-100 d-flex justify-content-center align-items-center">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="row text-center">
                    <div class="col-12">
                        <p class="fs-4 fw-bold">Do You Won't To Access Your Cart & You Should Must Sign In .... </p>
                    </div>
                    <div class="col-12">
                        <a href="signin.php" class="btn btn-primary">Go To Sign In Or Sign Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

}


?>

</html>