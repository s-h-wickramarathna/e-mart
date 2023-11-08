<?php
require "connection.php";

if (isset($_GET["i"]) && isset($_GET["s"])) {
    $pid = $_GET["i"];
    $status = $_GET["s"];

    $query = "SELECT * FROM `product` 
    INNER JOIN `category` ON `product`.`category_ca_id`=`category`.`ca_id`
    INNER JOIN `model_has_brand` ON `product`.`model_has_brand_id`=`model_has_brand`.`m_h_b_id`
    INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`b_id`
    INNER JOIN `model` ON `model_has_brand`.`model_id`=`model`.`m_id` 
    INNER JOIN `condition` ON `product`.`condition_id`=`condition`.`co_id` 
    WHERE `id` LIKE '%".$pid."%' ";

    if ($status == 2) {
        $query .= " AND `admin_status`='2' ";
    } else if ($status == 3) {
        $query .= " AND `admin_status`='1' ";
    }

    $product_rs = Database::Search($query);
    $product_num = $product_rs->num_rows;

    if ($product_num != 0) {

        for ($x = 0; $x < $product_num; $x++) {
            $product_data = $product_rs->fetch_assoc();

    ?>
            <tr>
                <td class="bg-info text-white"><?php echo ($product_data["id"]) ?></td>
                <td class="bg-secondary text-white text-center">
                    <?php
                    $img[0] = "resources/noImage.jpg";
                    $img[1] = "resources/noImage.jpg";
                    $img[2] = "resources/noImage.jpg";
                    $img[3] = "resources/noImage.jpg";

                    $image_rs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $product_data["id"] . "' ");
                    $image_num = $image_rs->num_rows;

                    if ($image_num != 0) {
                        for ($i = 0; $i < $image_num; $i++) {
                            $image_data = $image_rs->fetch_assoc();
                            $img[$i] = $image_data["p_path"];
                        }
                    }

                    ?>
                    <img src="<?php echo ($img[0]) ?>" onclick="veiwFullProductDetails(<?php echo ($product_data['id']) ?>);" class="rounded-circle" height="50px">
                </td>
                <td class="bg-info text-white"><?php
                                                $t = str_split($product_data["title"], 10);
                                                echo ($t[0] . " ...");
                                                ?></td>
                <td class="bg-secondary text-white"><?php echo ($product_data["ca_name"]) ?></td>
                <td class="bg-info text-white"><?php echo ($product_data["b_name"]) ?></td>
                <td class="bg-secondary text-white"><?php echo ($product_data["m_name"]) ?></td>
                <td class="bg-info text-white"><?php echo ($product_data["price"]) ?></td>
                <td class="bg-secondary text-white text-center"><?php
                                                                if ($product_data["admin_status"] == 1) {
                                                                ?>
                        <button class="btn btn-danger" id="Productb&Ubtn<?php echo ($product_data["id"]) ?>" onclick="block_Unblock_Product('<?php echo ($product_data['id']) ?>');">Block</button>
                    <?php
                                                                } else if ($product_data["admin_status"] == 2) {
                    ?>
                        <button class="btn btn-success" id="Productb&Ubtn<?php echo ($product_data["id"]) ?>" onclick="block_Unblock_Product('<?php echo ($product_data['id']) ?>');">Unblock</button>
                    <?php
                                                                }
                    ?>
                </td>
            </tr>

            <!-- user_Model -->

            <div class="modal" tabindex="-1" id="ProductModel<?php echo ($product_data["id"]) ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo ($product_data["title"]) ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 text-center mb-2">
                                <div class="row">
                                    <div class="col-6 text-center"><img src="<?php echo ($img[0]) ?>" width="90%"></div>
                                    <div class="col-6 text-center"><img src="<?php echo ($img[1]) ?>" width="90%"></div>
                                    <div class="col-6 text-center"><img src="<?php echo ($img[2]) ?>" width="90%"></div>
                                    <div class="col-6 text-center"><img src="<?php echo ($img[3]) ?>" width="90%"></div>
                                </div>
                            </div>

                            <div class="col-12" style="height: 20vh;">
                                <div class="row overflow-auto">

                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Title : </span><?php echo ($product_data["title"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Condition : </span><?php echo ($product_data["co_name"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Category : </span><?php echo ($product_data["ca_name"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Brand : </span><?php echo ($product_data["b_name"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Model : </span><?php echo ($product_data["m_name"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Price : </span><?php echo ($product_data["price"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Delivary Fee Colombo LKR : </span><?php echo ($product_data["cost_colombo"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Delivary Fee Other LKR : </span><?php echo ($product_data["cost_others"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Seller Nic No : </span><?php echo ($product_data["seller_nic"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Publish Date : </span><?php echo ($product_data["date_time"]) ?></p>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- user_Model -->
    <?php

        }
    }

}