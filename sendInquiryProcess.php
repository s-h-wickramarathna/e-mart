<?php
session_start();
require "connection.php";


if (isset($_GET["c"])) {
    $content = $_GET["c"];
    $to = $_SESSION["user"]["email"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H-i-s");

    Database::Iud("INSERT INTO `inquiry` (`in_content`,`in_datetime`,`in_status`,`in_to`,`in_from`,`user_view_status`,`admin_view_status`)
    VALUES ('" . $content . "','" . $date . "','1','" . $to . "','sanchithaheashan655@gmail.com','1','2') ");


    $msg_rs = Database::Search("SELECT * FROM `inquiry` WHERE `in_to`='" . $to . "' OR `in_from`='" . $to . "' ");
    $msg_num = $msg_rs->num_rows;

    if ($msg_num != 0) {

        for ($x = 0; $x < $msg_num; $x++) {
            $msg_data = $msg_rs->fetch_assoc();

            if ($msg_data["in_to"] == $to && $msg_data["in_from"] == 'sanchithaheashan655@gmail.com') {
?>
                <!-- to -->
                <div class="col-12 m-0">
                    <div class="row justify-content-end">
                        <div class="col-6">
                            <div class="row justify-content-end p-2">
                                <div class="w-auto bg-success rounded-2">
                                    <p class="m-0 text-white"><?php echo ($msg_data["in_content"]) ?></p>
                                </div>
                                <div class="col-12 text-end">
                                    <p class="m-0 fw-bold text-black-50"><?php echo ($msg_data["in_datetime"]) ?> <span class="text-dark">Me</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- to -->
            <?php
            } else if ($msg_data["in_to"] == "sanchithaheashan655@gmail.com" && $msg_data["in_from"] == $to) {
            ?>
                <!-- from -->
                <div class="col-12">
                    <div class="row justify-content-start">
                        <div class="col-6">
                            <div class="row justify-content-start p-2">
                                <div class="w-auto bg-primary rounded-2">
                                    <p class="m-0 text-white"><?php echo ($msg_data["in_content"]) ?></p>
                                </div>
                                <div class="col-12 text-start">
                                    <p class="m-0 fw-bold text-black-50"> <span class="text-dark">Admin </span><?php echo ($msg_data["in_datetime"]) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- from -->
<?php
            }
        }
    }
}


?>