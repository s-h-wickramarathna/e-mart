<?php
session_start();
require "connection.php";


if (isset($_POST["i"])) {
    $identify = $_POST["i"];

    if ($identify == 1) {

        $status_id = $_POST["m"];
        // $bar = $_POST["s"];

        $p_rs = Database::Search("SELECT * FROM `product` WHERE `status_s_id`='" . $status_id . "' AND `seller_nic`='" . $_SESSION["seller"]["nic"] . "' ORDER BY `date_time` DESC ");
        $p_num = $p_rs->num_rows;

        if ($p_num == 0) {
?>

            <div class="col-12">
                <div class="row text-center">
                    <p class="fw-bold fs-3 text-black-50">No Product Found ?????</p>
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
    } else if ($identify == 2) {
        // echo ("bar eka witharai");
        $bar = $_POST["s"];

        $p_rs = Database::Search("SELECT * FROM `product` WHERE `title` LIKE '%" . $bar . "%' AND `seller_nic`='" . $_SESSION["seller"]["nic"] . "' ORDER BY `date_time` DESC ");
        $p_num = $p_rs->num_rows;

        if ($p_num == 0) {
            ?>

            <div class="col-12">
                <div class="row text-center">
                    <p class="fw-bold fs-3 text-black-50">No Product Found ?????</p>
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
    } else if ($identify == 3) {
        // echo ("dekama");
        $status_id = $_POST["m"];
        $bar = $_POST["s"];

        $p_rs = Database::Search("SELECT * FROM `product` WHERE `title` LIKE '%" . $bar . "%' AND `status_s_id`='" . $status_id . "' AND `seller_nic`='" . $_SESSION["seller"]["nic"] . "'  ORDER BY `date_time` DESC ");
        $p_num = $p_rs->num_rows;

        if ($p_num == 0) {
            ?>

            <div class="col-12">
                <div class="row text-center">
                    <p class="fw-bold fs-3 text-black-50">No Product Found ?????</p>
                </div>
            </div>

            <?php
        } else {
            for ($x = 0; $x < $p_num; $x++) {
                $p_data = $p_rs->fetch_assoc();

                $p_img_rs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $p_data["id"] . "' ");
                $p_img_data = $p_img_rs->fetch_assoc();

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
}
