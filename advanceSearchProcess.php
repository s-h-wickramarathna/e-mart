<?php
require "connection.php";

$category = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$condition = $_POST["con"];
$colour = $_POST["clr"];
$quentity = $_POST["q"];
$price_to = $_POST["pt"];
$price_from = $_POST["pf"];
$size = $_POST["r"];
$text = $_POST["t"];

$query = " SELECT * FROM `product`";
$status = 0;

// title
if (!empty($text)) {
    $query .= " WHERE `title` LIKE '%" . $text . "%'";
    $status = 1;
}
// title

// category

if ($category != 0 && $status == 0) {
    $query .= " WHERE `category_ca_id`='" . $category . "'";
    $status = 1;
} else if ($category != 0 && $status == 1) {
    $query .= " AND `category_ca_id`='" . $category . "'";
}

// category

$query.= "AND `qty`!='0'";

// Brand & Model
$mHb_id = 0;

if ($brand != 0 && $model != 0) {

    $m = Database::Search("SELECT * FROM `model_has_brand` WHERE `model_id`='" . $model . "' AND `brand_id`='" . $brand . "' ");
    $m_num = $m->num_rows;

    if ($m_num != 0) {
        $m_data = $m->fetch_assoc();
        $mHb_id = $m_data["m_h_b_id"];

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $mHb_id . "'";
            $status = 1;
        } else if ($status == 1) {
            $query .= " AND `model_has_brand_id`='" . $mHb_id . "'";
        }
    }
}
// Brand & Model

// colour
if ($colour > 0 && $status == 0) {
    $query .= " WHERE `colour_id`='" . $colour . "'";
    $status = 1;
} else if ($colour > 0 && $status == 1) {
    $query .= " AND `colour_id`='" . $colour . "'";
}
// colour

// condition
if ($condition > 0 && $status == 0) {
    $query .= " WHERE `condition_id`='" . $condition . "'";
    $status = 1;
} else if ($condition > 0 && $status == 1) {
    $query .= " AND `condition_id`='" . $condition . "'";
}
// condition

// price
if (!empty($price_to) && empty($price_from) && $status == 0) {
    $query .= " WHERE `price` > '" . $price_to . "'";
    $status = 1;
} else if (!empty($price_to) && empty($price_from) && $status == 1) {
    $query .= " AND `price` > '" . $price_to . "'";
} else if (!empty($price_from) && empty($price_to) && $status == 0) {
    $query .= " WHERE `price` < '" . $price_from . "'";
    $status = 1;
} else if (!empty($price_from) && empty($price_to) && $status == 1) {
    $query .= " AND `price` < '" . $price_from . "'";
} else if (!empty($price_from) && !empty($price_to) && $status == 0) {
    $query .= " WHERE `price` BETWEEN '" . $price_to . "' AND '" . $price_from . "'";
    $status = 1;
} else if (!empty($price_from) && !empty($price_to) && $status == 1) {
    $query .= " AND `price` BETWEEN '" . $price_to . "' AND '" . $price_from . "'";
}
// price

// size

if ($size > 1 && $status == 0) {
    $query .= " WHERE `Size_id`='" . $size . "'";
    $status = 1;
} else if ($size > 1 && $status == 1) {
    $query .= " AND `Size_id`='" . $size . "'";
}

// size

// quentity
if ($quentity == 1) {
    $query .= " ORDER BY `qty` DESC";
    $status = 1;
} else if ($quentity == 2) {
    $query .= " ORDER BY `qty` ASC";
    $status = 1;
}
// quentity

echo($query);

$product_rs = Database::Search($query);
$product_num = $product_rs->num_rows;

if ($product_num == 0) {
?>

    <div class="col-12">
        <div class="row text-center">

            <div class="col-12">
                <img src="resources/emptyAdavancedSearch.gif" class="img-fluid">
            </div>

        </div>
    </div>


    <?php
} else {

    for ($a = 0; $a < $product_num; $a++) {
        $product_data = $product_rs->fetch_assoc();

        $p_img = "resources/emptyProducts.png";

        $product_img_rs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $product_data["id"] . "' ");
        $product_img_num = $product_img_rs->num_rows;

        if ($product_img_num > 0) {
            $product_img_data = $product_img_rs->fetch_assoc();
            $p_img = $product_img_data["p_path"];
        }

    ?>

        <div class="card p-0 shadow my-3 mx-2 cardHover" style="width: 13rem;" id="shortCard" onclick="goToSingleProductVeiw('<?php echo ($product_data['id']) ?>');">
            <img src="<?php echo ($p_img) ?>" class="card-img-top p_img_hover img-fluid">
            <div class="card-body">
                <div class="col-12">
                    <?php
                    $p_title_cart = str_split($product_data["title"], 20);
                    ?>
                    <p class="fw-bold"><?php echo ($p_title_cart[0] . " ...") ?></p>
                </div>
                <div class="col-12">
                    <p class="fs-5 fw-bold">LKR : 20000.00</p>
                </div>
            </div>
        </div>

<?php

    }
}
