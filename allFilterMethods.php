<?php
session_start();
$s_nic = $_SESSION["seller"]["nic"];
require "connection.php";

$search_bar = $_POST["s_bar"];
$C_brandnew = $_POST["brndnw"];
$C_used = $_POST["u"];
$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$colour = $_POST["clur"];
$qty = $_POST["qty"];
$price_to = $_POST["to"];
$Price_from = $_POST["from"];
$pageno = $_POST["page"];


$query = "SELECT * FROM `product`";
$status = 0;

// searchBar
if (!empty($search_bar)) {

    $query .= " WHERE `title` LIKE '%" . $search_bar . "%' ";
    $status = 1;
}
// searchBar

//condition
if ($C_brandnew == 1 && $C_used == 2 && $status == 1) {
    $query .= " AND `condition_id`='1' ";
} else if ($C_brandnew == 1 && $C_used == 2 && $status != 1) {
    $query .= " WHERE `condition_id`='1' ";
    $status = 1;
} else if ($C_brandnew == 2 && $C_used == 1 && $status == 1) {
    $query .= " AND `condition_id`='2' ";
} else if ($C_brandnew == 2 && $C_used == 1 && $status != 1) {
    $query .= " WHERE `condition_id`='2' ";
    $status = 1;
}
//condition

// category
if ($category != 0 && $status == 1) {
    $query .= " AND `category_ca_id`='" . $category . "' ";
} else if ($category != 0 && $status != 1) {
    $query .= " WHERE `category_ca_id`='" . $category . "' ";
    $status = 1;
}
// category

//Brand Has Model

if ($brand != 0 && $model != 0 && $status == 1) {
    $m_H_b_rs = Database::Search("SELECT * FROM `model_has_brand` WHERE `brand_id`='" . $brand . "' AND `model_id`='" . $model . "' ");
    $m_H_b_data = $m_H_b_rs->fetch_assoc();

    $query .= " AND `model_has_brand_id`='" . $m_H_b_data["id"] . "' ";
} else if ($brand != 0 && $model != 0 && $status != 1) {
    $m_H_b_rs = Database::Search("SELECT * FROM `model_has_brand` WHERE `brand_id`='" . $brand . "' AND `model_id`='" . $model . "' ");
    $m_H_b_data = $m_H_b_rs->fetch_assoc();

    $query .= " WHERE `model_has_brand_id`='" . $m_H_b_data["id"] . "' ";
    $status = 1;
}
//Brand Has Model

//colour
if ($colour != 0 && $status == 1) {
    $query .= " AND `colour_id`='" . $colour . "' ";
} else if ($colour != 0 && $status != 1) {
    $query .= " WHERE `colour_id`='" . $colour . "' ";
    $status = 1;
}
//colour

//price

if (!empty($price_to) && empty($Price_from) && $status == 1) {
    $query .= " AND `price` > '" . $price_to . "' ";
} else if (!empty($price_to) && empty($Price_from) && $status == 0) {
    $query .= " WHERE `price` > '" . $price_to . "' ";
    $status = 1;
} else if (empty($price_to) && !empty($Price_from) && $status == 1) {
    $query .= " AND `price` < '" . $Price_from . "' ";
} else if (!empty($price_to) && empty($Price_from) && $status == 0) {
    $query .= " WHERE `price` < '" . $Price_from . "' ";
    $status = 1;
} else if (!empty($price_to) && !empty($Price_from) && $status == 1) {
    $query .= " AND `price` BETWEEN '" . $price_to . "' AND '" . $Price_from . "' ";
} else if (!empty($price_to) && empty($Price_from) && $status == 0) {
    $query .= " WHERE `price` BETWEEN '" . $price_to . "' AND '" . $Price_from . "' ";
    $status = 1;
}
//price

if($status == 1){
    $query .=" AND `seller_nic`='".$s_nic."' ";
}else if($status == 0){
    $query .=" WHERE `seller_nic`='".$s_nic."' ";
    $status = 1;
}


//quentity
if ($qty == 1) {
    $query .= " ORDER BY `qty` DESC";
    $status = 1;
} else if ($qty == 2) {
    $query .= " ORDER BY `qty` ASC";
    $status = 1;
}

// echo($query);
//quentity

if ($pageno != 0) {
    $pageno = $_POST["page"];
} else {
    $pageno = 1;
}

$product_rs = Database::Search($query);
$product_num = $product_rs->num_rows;

$result_per_page = 8;
$number_of_pages = ceil($product_num / $result_per_page);

$viewed_result_count = ($pageno - 1) * $result_per_page;

$query .= " LIMIT " . $result_per_page . " OFFSET " . $viewed_result_count . "";
$p_rs = Database::Search($query);
$p_num = $p_rs->num_rows;


?>

<div class="col-12 mb-2">
    <div class="row mb-2 d-flex justify-content-center gap-2 gap-lg-4 mt-4">

        <?php

        if ($p_num == 0) {
        ?>

            <div class="col-12 mt-5">
                <div class="row text-center">
                    <p class="fw-bold fs-3 text-black-50 mb-5">No Product Found ?????</p>
                    <div class="col-12"><img src="resources/EmptyPurchasedGIF.gif" class="img-fluid rounded-2"></div>
                </div>
            </div>

            <?php
        } else {
            for ($x = 0; $x < $p_num; $x++) {
                $p_data = $p_rs->fetch_assoc();

                $p_img_rs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $p_data["id"] . "' ");
                $p_img_data = $p_img_rs->fetch_assoc();

                if ($p_data["admin_status"] == 2) {
                    ?>

                    <!-- card -->
                    <div class="card cardHover cursor p-0 shadow-lg mt-4 mb-2" style="width: 14rem;">

                        <?php

                        if (isset($p_img_data["p_path"])) {
                        ?>
                            <img src="<?php echo ($p_img_data["p_path"]) ?>" class="card-img-top" />
                        <?php
                        } else {
                        ?>
                            <img src="resources/emptyProducts.png" class="card-img-top" height="190px" />
                        <?php
                        }

                        if ($p_data["status_s_id"] == 1) {
                        ?>
                            <div class="col-12 d-flex justify-content-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input shadow-none" type="checkbox" role="switch" disabled>
                                </div>
                            </div>
                        <?php

                        } else if ($p_data["status_s_id"] == 2) {
                        ?>
                            <div class="col-12 d-flex justify-content-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input shadow-none" type="checkbox" role="switch" disabled>
                                </div>
                            </div>
                        <?php
                        }

                        ?>

                        <div class="card-body text-center">
                            <p class="card-title fs-6 fw-bold"><?php echo ($p_data["title"]) ?><span class="badge bg-danger">Blocked By Admin</span></p>

                            <div class="col-12 text-success">
                                <p>LKR : <b><?php echo ($p_data["price"]) ?></b></p>
                            </div>
                            <div class="col-12 text-secondary text-end fw-bolder" style="font-size: 12px;">
                                <p><?php echo ($p_data["date_time"]) ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- card -->

            <?php
                }else{
                    ?>

                    <!-- card -->
                    <div class="card cardHover cursor p-0 shadow-lg mt-4 mb-2" style="width: 14rem;">

                        <?php

                        if (isset($p_img_data["p_path"])) {
                        ?>
                            <img src="<?php echo ($p_img_data["p_path"]) ?>" onclick="updateProduct(<?php echo ($p_data['id']) ?>);" class="card-img-top" />
                        <?php
                        } else {
                        ?>
                            <img src="resources/emptyProducts.png" onclick="updateProduct(<?php echo ($p_data['id']) ?>);" class="card-img-top" height="190px" />
                        <?php
                        }

                        if ($p_data["status_s_id"] == 1) {
                        ?>
                            <div class="col-12 d-flex justify-content-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input shadow-none" type="checkbox" role="switch" id="<?php echo ("activeProduct" . $i) ?>" onchange="ProductActive(<?php echo ($i . ',' . $p_data['id']) ?>);" checked>
                                </div>
                            </div>
                        <?php

                        } else if ($p_data["status_s_id"] == 2) {
                        ?>
                            <div class="col-12 d-flex justify-content-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input shadow-none" type="checkbox" role="switch" id="<?php echo ("activeProduct" . $i) ?>" onchange="ProductActive(<?php echo ($i . ',' . $p_data['id']) ?>);">
                                </div>
                            </div>
                        <?php
                        }

                        ?>

                        <div class="card-body text-center">
                            <p class="card-title fs-6 fw-bold"><?php echo ($p_data["title"]) ?></p>

                            <div class="col-12 text-success">
                                <p>LKR : <b><?php echo ($p_data["price"]) ?></b></p>
                            </div>
                            <div class="col-12 text-secondary text-end fw-bolder" style="font-size: 12px;">
                                <p><?php echo ($p_data["date_time"]) ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- card -->

            <?php
                }
            }
        }

        ?>
    </div>
</div>
<?php

?>
<div class="col-12 mt-3 mb-3 d-flex justify-content-center">
    <div class="row text-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="sellerProductfiter(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                        } ?> aria-label="Previous">
                        <span aria-hidden="true" class="cursor">&laquo;</span>
                    </a>
                </li>
                <?php

                for ($x = 1; $x <= $number_of_pages; $x++) {
                    if ($x == $pageno) {
                ?>
                        <li class="page-item active cursor">
                            <a class="page-link" onclick="sellerProductfiter(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item cursor">
                            <a class="page-link" onclick="sellerProductfiter(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                <?php
                    }
                }

                ?>
                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="sellerProductfiter(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                        } ?> aria-label="Next">
                        <span aria-hidden="true" class="cursor">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>