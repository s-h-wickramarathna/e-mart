<?php
require "connection.php";

$txt = $_POST["s"];
$condition = $_POST["c"];
$colour = $_POST["clr"];
$quentity = $_POST["q"];
$price_to = $_POST["t"];
$price_from = $_POST["f"];
$category = $_POST["cat"];


$query = "SELECT * FROM `product`";
$status = 0;

// text ekak type Karala
if (!empty($txt) && $category == 0) {
    $query .= " WHERE `title` LIKE '%" . $txt . "%' ";
    $status = 1;
} else if (empty($txt) && $category != 0) {
    $query .= " WHERE `category_ca_id` = '" . $category . "' ";
    $status = 1;
}
// text ekak type Karala


// condition
if ($condition == 2 && $status == 0) {
    $query .= " WHERE `condition_id`='1' ";
    $status = 1;
} else if ($condition == 2 && $status == 1) {
    $query .= " AND `condition_id`='1' ";
} else if ($condition == 3 && $status == 0) {
    $query .= " WHERE `condition_id`='2' ";
    $status = 1;
} else if ($condition == 3 && $status == 1) {
    $query .= " AND `condition_id`='2' ";
}
// condition

// colour
if ($colour > 0 && $status == 0) {
    $query .= " WHERE `colour_id`='" . $colour . "' ";
    $status = 1;
} else if ($colour > 0 && $status == 1) {
    $query .= " AND `colour_id`='" . $colour . "' ";
}
// colour

if (!empty($price_to) && empty($price_from) && $status == 0) {
    $query .= " WHERE `price` > '" . $price_to . "' ";
    $status = 1;
} else if (!empty($price_to) && empty($price_from) && $status == 1) {
    $query .= " AND `price` > '" . $price_to . "' ";
} else if (!empty($price_from) && empty($price_to) && $status == 0) {
    $query .= " WHERE `price` < '" . $price_from . "' ";
    $status = 1;
} else if (!empty($price_from) && empty($price_to) && $status == 1) {
    $query .= " AND `price` < '" . $price_from . "' ";
} else if (!empty($price_from) && !empty($price_to) && $status == 0) {
    $query .= " WHERE `price` BETWEEN '" . $price_to . "' AND '" . $price_from . "' ";
    $status = 1;
} else if (!empty($price_from) && !empty($price_to) && $status == 1) {
    $query .= " AND `price` BETWEEN '" . $price_to . "' AND '" . $price_from . "' ";
}

//quentity
if ($quentity == 1) {
    $query .= " ORDER BY `qty` DESC";
} else if ($quentity == 2) {
    $query .= " ORDER BY `qty` ASC";
}
//quentity


$product_rs = Database::Search($query);
$product_num = $product_rs->num_rows;

?>

<?php

if ($product_num == 0) {
?>

    <div class="col-12 bg-body">
        <div class="row">
            <div class="col-12 fs-5 fw-bold text-black-50 text-center  mt-3">
                Product Not Found
            </div>
            <div class="col-12 text-center">
                <img src="resources/emptySearchProducts.gif" height="500px" alt="" srcset="">
            </div>
        </div>
    </div>

<?php

} else {

?>

    <?php

    for ($i = 0; $i < $product_num; $i++) {

        $product_data = $product_rs->fetch_assoc();
        $p_img = "resources/emptyProducts.png";

        $product_img_rs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $product_data["id"] . "' ");
        $product_img_num = $product_img_rs->num_rows;

        if ($product_img_num > 0) {
            $product_img_data = $product_img_rs->fetch_assoc();
            $p_img = $product_img_data["p_path"];
        }
    ?>

        <div class="card p-0 d-lg-none shadow my-3 mx-2 cardHover" style="width: 13rem;" id="shortCard<?php echo ($i) ?>" onclick="goToSingleProductVeiw('<?php echo ($product_data['id']) ?>');">
            <img src="<?php echo ($p_img) ?>" class="card-img-top p_img_hover img-fluid">
            <div class="card-body">
                <div class="col-12">
                    <?php
                    $p_title_short = str_split($product_data["title"], 20);
                    ?>
                    <p class="fw-bold"><?php echo ($p_title_short[0] . " ...") ?></p>
                </div>
                <div class="col-12">
                    <p class="fs-5 fw-bold">LKR : <?php echo ($product_data["price"]) ?>.00</p>
                </div>
                <div class="col-12 text-end">
                    <p class="text-black-50 fw-bold"><?php echo ($product_data["date_time"]) ?></p>
                </div>
            </div>
        </div>

        <div class="card mb-3 d-none d-lg-block shadow cardHover" style="max-width: 90%;" id="longCard" onclick="goToSingleProductVeiw('<?php echo ($product_data['id']) ?>');">
            <div class="row g-0">
                <div class="col-md-4 overflow-hidden">
                    <img src="<?php echo ($p_img) ?>" class="p_img_hover img-fluid">
                </div>
                <div class="col-md-8">
                    <div class="card-body">

                        <div class="col-12 mb-2">
                            <?php
                            $p_title_long = str_split($product_data["title"], 50);
                            ?>
                            <a class="fw-bold textcolor mb-5"><?php echo ($p_title_long[0] . " ...") ?></a>
                        </div>

                        <div class="col-12">
                            <p class="m-0">LKR : <span class="fs-4 fw-bold text"><?php echo ($product_data["price"]) ?>.00</span> Buy It Now</p>
                        </div>

                        <?php

                        $ship;

                        if (isset($_SESSION["user"])) {
                            $user_email = $_SESSION["user"]["email"];

                            $user_rs = Database::Search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `user_has_address`.`city_id`=`city`.`ci_id` WHERE `user_email`='" . $user_email . "' ");
                            $user_num = $user_rs->num_rows;

                            if ($user_num == 0) {
                                $ship = "$$$$$";
                            } else {

                                $user_data = $user_rs->fetch_assoc();

                                if ($user_data["distric_id"] == 1) {
                                    $ship = $product_data["cost_colombo"];
                                } else {
                                    $ship = $product_data["cost_others"];
                                }
                            }
                        ?>
                        <?php

                        } else {

                            $ship = "$$$$$";
                        }
                        ?>

                        <div class="col-12">
                            <p class="m-0">shipping : LKR . <?php echo ($ship) ?></p>
                        </div>

                        <?php

                        $invoice_rs = Database::Search("SELECT * FROM `invoice` WHERE `product_id`='" . $product_data["id"] . "' ");
                        $invoice_num = $invoice_rs->num_rows;

                        ?>

                        <div class="col-12">
                            <p class="m-0"><?php echo ($invoice_num) ?> Sold</p>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">

                                    <?php

                                    $seller_from = "0";

                                    $seller_rs = Database::Search("SELECT * FROM `seller` 
                                                    INNER JOIN `user` ON `seller`.`user_email`=`user`.`email`
                                                    INNER JOIN `user_has_address` ON `user`.`email`=`user_has_address`.`user_email`
                                                    INNER JOIN `city` ON `user_has_address`.`city_id`=`city`.`ci_id`
                                                    WHERE `nic` = '" . $product_data['seller_nic'] . "' ");
                                    $seller_num = $seller_rs->num_rows;

                                    if ($seller_num == 0) {
                                        $seller_from = "---------";
                                    } else {
                                        $seller_data = $seller_rs->fetch_assoc();
                                        $seller_from = $seller_data["ci_name"];
                                    }


                                    ?>

                                    <p class=" mt-1">from : <?php echo ($seller_from) ?></p>
                                </div>
                                <div class="col-6">
                                    <p class="fw-bold">Top Rated Seller</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-end">
                            <div class="row">
                                <div class="col-12 text-end">
                                    <p class="text-black-50 fw-bold"><?php echo ($product_data["date_time"]) ?></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

<?php
    }
}
?>