<?php
session_start();
require "connection.php";

$user_email = $_SESSION["user"]["email"];

if (isset($_GET["txt"])) {
    $s_txt = $_GET["txt"];

    $cart_rs = Database::Search("SELECT * FROM `cart` 
    INNER JOIN `product` ON `cart`.`product_id`=`product`.`id` WHERE `title` LIKE '%" . $s_txt . "%' ");

    $cart_num = $cart_rs->num_rows;

    if ($cart_num == 0) {
?>
        <div class="col-12">
            <div class="row">

                <div class="col-12 d-flex justify-content-center">
                    <img src="resources/emptyCartGif.gif" height="450px">
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <p class="fs-5 fw-bold">Your Cart Is Empty ...</p>
                </div>
            </div>
        </div>

        <?php

    } else {

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
                    <div class="col-md-4 col-lg-4 col-xl-3 overflow-hidden">
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
                                                <div class="col-6 d-flex justify-content-center"><input type="number" class="form-control shadow-none" value="<?php echo ($cart_data["cart_qty"]) ?>" id="p_quentity<?php echo ($product_data["id"]) ?>" /></div>
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
                                $user_data = $user_rs->fetch_assoc();

                                $shipping = "0";

                                if ($user_data["distric_id"] == "1") {
                                    $shipping = $product_data["cost_colombo"];
                                } else {
                                    $shipping = $product_data["cost_others"];
                                }

                                ?>

                                <p class="m-0">shipping : LKR . <?php echo ($shipping) ?></p>
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
                                <button class="btn btn-outline-danger">Remove</button>
                                <button class="btn btn-primary">Buy Now</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        <?php

        }

        ?>

<?php

    }
}
