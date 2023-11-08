<?php
session_start();
$s_nic = $_SESSION["seller"]["nic"];

if (isset($_GET["page"])) {

        $pageno = $_GET["page"];


?>

    <div class="col-12 mb-2">
        <div class="row mb-2 d-flex justify-content-center gap-2 gap-lg-4 mt-4">

            <?php

            require "connection.php";




            $pd_rs = Database::Search("SELECT * FROM `product` WHERE `seller_nic`='" . $s_nic . "' ");
            $pd_num = $pd_rs->num_rows;

            $result_per_page = 8;
            $number_of_pages = ceil($pd_num / $result_per_page);

            $page_result = ($pageno - 1) * $result_per_page;

            $p_rs = Database::Search("SELECT * FROM `product` WHERE `seller_nic`='" . $s_nic . "' LIMIT " . $result_per_page . " OFFSET " . $page_result . " ");
            $p_num = $p_rs->num_rows;

            for ($i = 0; $i < $p_num; $i++) {
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

            ?>
        </div>
    </div>

    <div class="col-12 mt-3 mb-3 d-flex justify-content-center">
        <div class="row text-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                ?> onclick="paginationSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                        } ?> aria-label="Previous">
                            <span aria-hidden="true" class="cursor">&laquo;</span>
                        </a>
                    </li>
                    <?php

                    for ($x = 1; $x <= $number_of_pages; $x++) {
                        if ($x == $pageno) {
                    ?>
                            <li class="page-item active cursor">
                                <a class="page-link" onclick="paginationSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item cursor">
                                <a class="page-link" onclick="paginationSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                            </li>
                    <?php
                        }
                    }

                    ?>
                    <li class="page-item">
                        <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                ?> onclick="paginationSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                        } ?> aria-label="Next">
                            <span aria-hidden="true" class="cursor">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

<?php


}
