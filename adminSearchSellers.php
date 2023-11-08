<?php
require "connection.php";

if (isset($_GET["n"]) && isset($_GET["s"])) {
    $nic = $_GET["n"];
    $status = $_GET["s"];

    $query = "SELECT * FROM `Seller` WHERE `nic` LIKE '%" . $nic . "%' ";

    if ($status == 2) {
        $query .= " AND `s_status`='2' ";
    } else if ($status == 3) {
        $query .= " AND `s_status`='3' ";
    }

    $seller_rs = Database::Search($query);
    $seller_num = $seller_rs->num_rows;

    if ($seller_num != 0) {

        for ($x = 0; $x < $seller_num; $x++) {
            $seller_data = $seller_rs->fetch_assoc();

            $user_rs = Database::Search("SELECT * FROM `user` WHERE `email`='" . $seller_data["user_email"] . "' ");
            $user_data = $user_rs->fetch_assoc();

            $gender = Database::Search("SELECT * FROM `gender` WHERE `id`='" . $user_data["gender_id"] . "' ");
            $gender_data = $gender->fetch_assoc();

            $city = "-------------------";
            $line1 = "------------------";
            $line2 = "------------------";

            $address_rs = Database::Search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $user_data["email"] . "' ");
            $address_num = $address_rs->num_rows;

            if ($address_num != 0) {
                $address_data = $address_rs->fetch_assoc();
                $line1 = $address_data["line_1"];
                $line2 = $address_data["line_2"];

                $city_rs = Database::Search("SELECT * FROM `city` WHERE `ci_id`='" . $address_data["city_id"] . "' ");
                $city_data = $city_rs->fetch_assoc();
                $city = $city_data["ci_name"];
            }

?>

            <tr>
                <th scope="row" class="bg-secondary text-white"><?php echo ($x + 1); ?></th>
                <td class="bg-info text-white"><?php echo ($user_data['email']) ?></td>
                <td class="bg-secondary text-white text-center">
                    <?php

                    $shop_image = "resources/noImage.jpg";

                    $S_img_rs = Database::Search("SELECT * FROM `shop_image` WHERE `seller_nic`='" . $seller_data['nic'] . "' ");
                    $S_img_num = $S_img_rs->num_rows;

                    if ($S_img_num != 0) {
                        $seller_shop_image = $S_img_rs->fetch_assoc();
                        $shop_image = $seller_shop_image["shop_img_path"];
                    }

                    ?>
                    <img src="<?php echo ($shop_image) ?>" onclick="sellerfullDetails('<?php echo ($seller_data['nic']) ?>');" class="rounded-circle" height="50px">
                </td>
                <td class="bg-info text-white"><?php echo ($seller_data['shop_name']) ?></td>
                <td class="bg-secondary text-white"><?php echo ($seller_data['nic']) ?></td>
                <td class="bg-info text-white"><?php echo ($seller_data['account_create_datetime']) ?></td>
                <td class="bg-secondary text-white text-center"><?php
                                                                if ($seller_data["s_status"] == 2) {
                                                                ?>
                        <button class="btn btn-danger" id="seller_b&Ubtn<?php echo ($seller_data["nic"]) ?>" onclick="Sblock_Unblock_Users('<?php echo ($seller_data['nic']) ?>');">Block</button>
                    <?php
                                                                } else if ($seller_data["s_status"] == 3) {
                    ?>
                        <button class="btn btn-success" id="seller_b&Ubtn<?php echo ($seller_data["nic"]) ?>" onclick="Sblock_Unblock_Users('<?php echo ($seller_data['nic']) ?>');">Unblock</button>
                    <?php
                                                                }
                    ?>
                </td>
            </tr>

            <!-- user_Model -->

            <div class="modal" tabindex="-1" id="SellerModel<?php echo ($seller_data["nic"]) ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo ($user_data["fname"] . " " . $user_data["lname"]) ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 text-center mb-2">
                                <img src="<?php echo ($shop_image) ?>" class="rounded-circle" height="200px" />
                            </div>

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Full Name : </span><?php echo ($user_data["fname"] . " " . $user_data["lname"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Shop Name : </span><?php echo ($seller_data["shop_name"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Email : </span><?php echo ($user_data["email"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Mobile No : </span><?php echo ($user_data["mobile"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Gender : </span><?php echo ($gender_data["type"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">City : </span><?php echo ($city) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Addres Line 01 : </span><?php echo ($line1) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Addres Line 02 : </span><?php echo ($line2) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Account Create Date : </span><?php echo ($seller_data["account_create_datetime"]) ?></p>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="col-12 text-end">
                                <p class="fw-bold text-black-50">Seller Account ....</p>
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

?>