<?php
session_start();
require "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emart || Contatc Us</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="aos.css">
</head>

<?php
if (isset($_SESSION["user"])) {
    $user_email = $_SESSION["user"]["email"];

    Database::iud("UPDATE `inquiry` SET `user_view_status`='1' WHERE `in_from`='".$user_email."' ");

?>

    <body>

        <div class="container-fluid bg-light">
            <div class="row">

                <div class="col-12 mb-2 bg-light shadow-sm border-bottom">
                    <div class="row py-1 d-flex justify-content-end p-2">

                        <div class="col-3">
                            <div class="fs-3 mt-0"> <a href="#" class="aclass"><span class="namef">E</span>mart</a></div>
                        </div>

                        <div class="col-9 text-end">
                            <p class="fs-3 fw-bold m-0 mt-4"><i class="bi bi-question-circle">&nbsp;&nbsp;</i>Inquiries</p>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center align-items-center iquiriesIMG" style="height: 200px;"></div>
                        <div class="col-12 position-absolute d-flex justify-content-center align-items-center" style="height: 200px;">
                            <p class="fs-1 fw-bold text-white">Report Us</p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-12 mt-1 mb-4">
                    <div class="row">

                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <p class="fs-4 fw-bold text-primary">How To Report Us ....</p>
                                    <p class="fw-bold ms-2">You must first be our valued customer to let us know about your problem. Then you can inform us about the problem you have through this chat box.
                                        Then we will look into your problem and give you an answer as soon as possible.</p>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <hr class="border border-3 border-dark">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2 mb-2">
                                    <p class="fs-4 fw-bold text-primary">Headquarters</p>
                                    <p class="fw-bold m-0 ms-2">12/5, Sinhasana Road, Dondra, Matara, Sri Lanka</p>
                                    <p class="fw-bold m-0 ms-2">Emart@gmail.com</p>
                                    <p class="fw-bold m-0 ms-2">+94 76 989 8172</p>
                                    <a href="#">www.facebook.com</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 p-2">
                            <div class="row justify-content-center">

                                <div class="col-11 mt-2 mb-3 shadow rounded-2">
                                    <div class="row">

                                        <div class="col-6">
                                            <p class="fw-bold fs-5 mt-2">ADMIN...</p>
                                        </div>
                                        <div class="col-6 text-end">
                                            <img src="resources/adminMSG.png" height="50px">
                                        </div>
                                        <hr>
                                        <div class="col-12" style="height: 300px;">
                                            <div class="row overflow-auto" id="viewInquieryMSG">
                                                <?php
                                                $msg_rs = Database::Search("SELECT * FROM `inquiry` WHERE `in_to`='" . $user_email . "' OR `in_from`='".$user_email."' ");
                                                $msg_num = $msg_rs->num_rows;

                                                if ($msg_num != 0) {

                                                    for ($x = 0; $x < $msg_num; $x++) {
                                                        $msg_data = $msg_rs->fetch_assoc();

                                                        if ($msg_data["in_to"] == $user_email && $msg_data["in_from"] == 'sanchithaheashan655@gmail.com') {
                                                ?>
                                                            <!-- to -->
                                                            <div class="col-12 m-0">
                                                                <div class="row justify-content-end">
                                                                    <div class="col-6">
                                                                        <div class="row justify-content-end p-2">
                                                                            <div class="w-auto bg-success rounded-2">
                                                                                <p class="m-0 text-white"><?php echo($msg_data["in_content"]) ?></p>
                                                                            </div>
                                                                            <div class="col-12 text-end">
                                                                                <p class="m-0 fw-bold text-black-50"><?php echo($msg_data["in_datetime"]) ?> <span class="text-dark">Me</span></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- to -->
                                                        <?php
                                                        } else if ($msg_data["in_to"] == "sanchithaheashan655@gmail.com" && $msg_data["in_from"] == $user_email) {
                                                        ?>
                                                            <!-- from -->
                                                            <div class="col-12">
                                                                <div class="row justify-content-start">
                                                                    <div class="col-6">
                                                                        <div class="row justify-content-start p-2">
                                                                            <div class="w-auto bg-primary rounded-2">
                                                                                <p class="m-0 text-white"><?php echo($msg_data["in_content"]) ?></p>
                                                                            </div>
                                                                            <div class="col-12 text-start">
                                                                                <p class="m-0 fw-bold text-black-50"> <span class="text-dark">Admin </span><?php echo($msg_data["in_datetime"]) ?></p>
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

                                                ?>


                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-12 mb-1">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control shadow-none" placeholder="Type Massage ...." id="in_text">
                                                <button class="btn btn-primary" type="button" onclick="sendInquiries();"><i class="bi bi-send-fill"></i></button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <?php include "footer.php" ?>

            </div>
        </div>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>
<?php
} else {
?>

    <div class="col-12 vh-100 d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col-12 text-center">
                <p class="fs-4 fw-bold text-black-50">The Inquiries Can Send To Us Only Our valued customers ....</p>
            </div>
            <div class="col-12 text-center">
                <a class="btn btn-primary" href="signin.php">SignIn Or SignUp</a>
            </div>
        </div>
    </div>

<?php
}
?>

</html>