<?php
require "connection.php";

if (isset($_GET["c"]) && isset($_GET["e"])) {

    $content = $_GET["c"];
    $user_email = $_GET["e"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H-i-s");

    Database::iud("INSERT INTO `inquiry` (`in_content`,`in_datetime`,`in_status`,`in_to`,`in_from`,`user_view_status`,`admin_view_status`)
    VALUES ('" . $content . "','" . $date . "','1','sanchithaheashan655@gmail.com','" . $user_email . "','2','1') ");


    $showmsg_rs = Database::Search("SELECT * FROM `inquiry` WHERE `in_to`='" . $user_email. "' OR `in_from`='" . $user_email . "' ");
    $showmsg_num = $showmsg_rs->num_rows;

    if ($showmsg_num != 0) {
        for ($c = 0; $c < $showmsg_num; $c++) {
            $showmsg_data = $showmsg_rs->fetch_assoc();

            if ($showmsg_data["in_to"] == 'sanchithaheashan655@gmail.com' && $showmsg_data["in_from"] == $user_email) {

?>
                <!-- to -->
                <div class="col-12 m-0">
                    <div class="row justify-content-end">
                        <div class="col-6">
                            <div class="row justify-content-end p-2">
                                <div class="w-auto bg-success rounded-2">
                                    <p class="m-0 text-white"><?php echo ($showmsg_data["in_content"]); ?></p>
                                </div>
                                <div class="col-12 text-end">
                                    <p class="m-0 fw-bold text-black-50"><?php echo ($showmsg_data["in_datetime"]); ?><span class="text-dark">Me</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- to -->

            <?php
            } else if ($showmsg_data["in_to"] == $user_email && $showmsg_data["in_from"] == 'sanchithaheashan655@gmail.com') {
            ?>
                <!-- from -->
                <div class="col-12">
                    <div class="row justify-content-start">
                        <div class="col-6">
                            <div class="row justify-content-start p-2">
                                <div class="w-auto bg-primary rounded-2">
                                    <p class="m-0 text-white"><?php echo ($showmsg_data["in_content"]); ?></p>
                                </div>
                                <div class="col-12 text-start">
                                    <p class="m-0 fw-bold text-black-50"> <span class="text-dark">User </span><?php echo ($showmsg_data["in_datetime"]); ?></p>
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