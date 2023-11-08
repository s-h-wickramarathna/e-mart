<?php
session_start();
require "connection.php";

if (isset($_GET["t"])) {
    $txt = $_GET["t"];

    $watch_rs = Database::Search("SELECT * FROM `watchlist`
    INNER JOIN `product` ON `watchlist`.`product_id`=`product`.`id` 
    WHERE `user_email`='" . $_SESSION["user"]["email"] . "' AND `title` LIKE '%" . $txt . "%' ");

    $watch_num = $watch_rs->num_rows;

    if ($watch_num == 0) {
?>
        <div class="col-12 d-flex justify-content-center">
            <img src="resources/emptyWatchList.gif" height="300px" />
        </div>
        <div class="col-12 text-center">
            <p class="fs-3 fw-bold text-black-50">No Product In Here .....</p>
        </div>
        <?php
    } else {
        for ($x = 0; $x < $watch_num; $x++) {
            $watchlist_data = $watch_rs->fetch_assoc();

            $pimg_rs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $watchlist_data["id"] . "' ");
            $pimg_num = $pimg_rs->num_rows;

            if ($pimg_num == 0) {
                $w_img = "resources/emptyProducts.png";
            } else {
                $pimg_data = $pimg_rs->fetch_assoc();
                $w_img = $pimg_data["p_path"];
            }

        ?>

            <div class="card p-0 shadow my-3 mx-2 cardHover" style="width: 13rem;" id="shortCard">
                <img src="<?php echo ($w_img) ?>" class="card-img-top p_img_hover img-fluid" onclick="goToSingleProductVeiw('<?php echo ($watchlist_data['id']) ?>');">
                <div class="card-body">
                    <?php
                    $p_title_whatlist = str_split($watchlist_data["title"], 18);
                    ?>
                    <div class="col-12">
                        <p class="fw-bold"><?php echo ($p_title_whatlist[0] . " ....") ?></p>
                    </div>
                    <div class="col-12">
                        <p class="fs-5 fw-bold">LKR : <?php echo ($watchlist_data["price"]) ?>.00</p>
                    </div>
                    <div class="col-12 text-end">
                        <p class="text-black-50 fw-bold"><?php echo ($watchlist_data["w_datetime"]) ?></p>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 d-grid">
                                <button class="btn btn-outline-danger" onclick="removeFromWatchlist('<?php echo ($watchlist_data['id']) ?>')">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php

        }
    }
}



?>