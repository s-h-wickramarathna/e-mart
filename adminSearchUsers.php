<?php
require "connection.php";

if (isset($_GET["e"]) && isset($_GET["s"])) {
    $email = $_GET["e"];
    $status = $_GET["s"];

    $query = "SELECT * FROM `user` WHERE `email` LIKE '%" . $email . "%' ";

    if ($status == 2) {
        $query .= " AND `status`='2' ";
    } else if ($status == 3) {
        $query .= " AND `status`='1' ";
    }

    $user_rs = Database::Search($query);
    $user_num = $user_rs->num_rows;

    if ($user_num != 0) {

        for ($x = 0; $x < $user_num; $x++) {
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
                <td class="bg-info text-white"><?php echo ($user_data["fname"]) ?></td>
                <td class="bg-secondary text-white"><?php echo ($user_data["lname"]) ?></td>
                <td class="bg-info text-white" onclick="ShowFullUserDetails('<?php echo ($user_data['email']) ?>');"><?php echo ($user_data["email"]) ?></td>
                <td class="bg-secondary text-white"><?php echo ($user_data["mobile"]) ?></td>
                <td class="bg-info text-white"><?php echo ($gender_data["type"]) ?></td>
                <td class="bg-info text-white text-center"><?php
                                                            if ($user_data["status"] == 1) {
                                                            ?>
                        <button class="btn btn-danger" id="b&Ubtn<?php echo ($user_data["email"]) ?>" onclick="block_Unblock_Users('<?php echo ($user_data['email']) ?>');">Block</button>
                    <?php
                                                            } else if ($user_data["status"] == 2) {
                    ?>
                        <button class="btn btn-success" id="b&Ubtn<?php echo ($user_data["email"]) ?>" onclick="block_Unblock_Users('<?php echo ($user_data['email']) ?>');">Unblock</button>
                    <?php
                                                            }
                    ?>
                </td>
            </tr>

            <!-- user_Model -->

            <div class="modal" tabindex="-1" id="uerModel<?php echo ($user_data["email"]) ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo ($user_data["fname"] . " " . $user_data["lname"]) ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 text-center mb-2">
                                <?php
                                $img = "resources/noImage.jpg";

                                $image_rs = Database::Search("SELECT * FROM `profile_image` WHERE `user_email`='" . $user_data["email"] . "' ");
                                $image_num = $image_rs->num_rows;

                                if ($image_num != 0) {
                                    $image_data = $image_rs->fetch_assoc();
                                    $img = $image_data["user_profile_path"];
                                }

                                ?>
                                <img src="<?php echo ($img) ?>" class="rounded-circle" height="200px" />
                            </div>

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">First Name : </span><?php echo ($user_data["fname"]) ?></p>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0"><span class="fw-bold">Last Name : </span><?php echo ($user_data["lname"]) ?></p>
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
                                        <p class="m-0"><span class="fw-bold">Joined Date : </span><?php echo ($user_data["joined_date"]) ?></p>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="col-12 text-end">
                                <p class="fw-bold text-black-50">User Account ....</p>
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