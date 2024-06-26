        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Emart || Seller Registration</title>
            <link rel="icon" href="resources/logo.svg" />


            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="style.css" />

        </head>
        <?php
        session_start();
        require "connection.php";
        if (isset($_SESSION["user"])) {

            $user_email = $_SESSION["user"]["email"];
            $user_fname = $_SESSION["user"]["fname"];
            $user_lname = $_SESSION["user"]["lname"];

            $seller_rs =  Database::Search("SELECT * FROM `seller` WHERE `user_email`='" . $user_email . "' ");
            $seller_num = $seller_rs->num_rows;

            if ($seller_num == 0) {

                $address_rs = Database::Search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `user_has_address`.`city_id`=`city`.`ci_id` WHERE `user_email`='" . $user_email . "' ");
                $address_num = $address_rs->num_rows;

                if ($address_num != 0) {
                    $address_data = $address_rs->fetch_assoc();

        ?>

                    <body>
                        <div class="container-fluid">
                            <div class="row d-flex justify-content-center">

                                <div class="col-12 bg-light">
                                    <div class="row d-flex justify-content-center">

                                        <div class="col-12 background-decoration-02 mb-4">
                                            <div class="row mt-3 d-flex align-items-center">
                                                <div class="col-12 logo"></div>
                                                <div class="col-12 text-center">
                                                    <p class="fs-1 title_01 text-center"><span class="title_02">E</span>mart</p>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <p class="fs-5 text-center">Hi <a href="userProfile.php">Sanchitha </a> <span id="request_note">This Is the Best Way To Sell Your Products Fast & easiely.</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-11 rounded-3 mb-4 shadow-lg" id="sellerPage_content" ;>
                                            <div class="row">
                                                <div class="col-12 text-center mt-2">
                                                    <p class="fs-3 fw-bold text-secondary"> Create a Seller Acccount.</p>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">

                                                        <div class="col-6">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <span class="ps-2">User full Name</span>
                                                                </div>
                                                                <div class="col-12 mt-1">
                                                                    <input type="text" value="<?php echo ($user_fname . " " . $user_lname) ?>" class="form-control shadow-none" disabled />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <span class="ps-2">User Email</span>
                                                                </div>
                                                                <div class="col-12">
                                                                    <input type="text" value="<?php echo ($user_email) ?>" class="form-control shadow-none mt-1" disabled />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-center mt-3 mb-2">
                                                            <span class="fw-bold ms-2">The data of the seller account will be sent to your user email ....</span>

                                                        </div>

                                                        <hr class="mt-2 border border-2 border-dark">

                                                        <div class="col-12 col-lg-6 mt-3">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <span class="ps-2">Seller City</span>
                                                                </div>
                                                                <div class="col-12">
                                                                    <input type="text" class="form-control shadow-none" disabled value="<?php echo ($address_data["ci_name"]) ?>" id="s_email" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-3 mt-3">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <span class="ps-2">New Seller Password :-</span>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="input-group">
                                                                        <input type="password" class="form-control shadow-none" placeholder="5-20 Charactors" id="sellernewpasswordinput">
                                                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="sellerPasswordTypeChange1();"><i class="bi bi-eye-slash-fill" id="sellernewpassword"></i></button>
                                                                    </div>
                                                                    <p class="invalid-field d-none" id="np_field"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-3 mt-3">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <span class="ps-2">Conform Seller Password :-</span>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="input-group">
                                                                        <input type="password" id="sellerConformPInput" class="form-control shadow-none" placeholder="Retype Password">
                                                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="sellerConfirmPInput();"><i class="bi bi-eye-slash-fill" id="sellerPIcone2"></i></button>
                                                                    </div>
                                                                    <p class="invalid-field d-none" id="cp_field"></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 mt-1">
                                                            <p class="text-center">From now on, our company will send your seller details to this email address you have provided.</p>
                                                        </div>

                                                        <div class="col-6 mt-3">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <span class="ps-2">National ID No</span>
                                                                </div>
                                                                <div class="col-12">
                                                                    <input type="text" class="form-control shadow-none mt-1" id="s_nic" />
                                                                    <p class="invalid-field d-none" id="nic_field"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 mt-3">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <span class="ps-2">Shop Name</span>
                                                                </div>
                                                                <div class="col-12">
                                                                    <input type="text" class="form-control shadow-none mt-1" id="shop_name" />
                                                                    <p class="invalid-field" id="shop_field"></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 mt-2">
                                                            <p class="fw-bold text-center">Please note that you can access your seller account only through the National ID Number and the password that you will be given.</p>
                                                        </div>

                                                        <hr class="mt-2 border border-2 border-dark">

                                                        <div class="col-12 mt-2">
                                                            <p class="text-center">Upload the two front and back photos of the National ID card that match the National ID card number you provided at this place.</p>
                                                        </div>

                                                        <div class="col-12 mt-3">
                                                            <div class="row d-flex justify-content-center">
                                                                <div class="col-12 col-md-10 col-lg-7">
                                                                    <div class="row gap-2 d-flex justify-content-center">
                                                                        <div class="col-5 border border-2 border-dark d-flex justify-content-center" id="nicmaindiv1"><img src="resources/no_Id.jpg" height="200px" id="nic0" /></div>
                                                                        <div class="col-5 border border-2 border-dark d-flex justify-content-center" id="nicmaindiv2"><img src="resources/no_Id.jpg" height="200px" id="nic1" /></div>
                                                                        <div class="col-12 text-center">
                                                                            <p class="invalid-field d-none" id="img_error"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 text-center mt-3 mb-2">
                                                            <input type="file" class="d-none" id="nicImgUploder" multiple />
                                                            <label for="nicImgUploder" class="btn btn-primary" onclick="nicupload();">Upload NIC Images</label>
                                                        </div>

                                                        <hr class="mt-2 border border-2 border-dark">

                                                        <div class="col-12 mt-3 mb-3 d-grid">
                                                            <button class="btn btn-success" onclick="CreateSeller();">Create Seller Account ...</button>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <script src="script.js"></script>
                    </body>
                <?php
                } else {
                ?>
                    <div class="col-12 bg-light vh-100 d-flex justify-content-center align-items-center">
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="fs-4 fw-bold text-black-50">Please Update Or Fill Your All Profile Details & Shipping Details Correctly .... </p>
                            </div>
                            <div class="col-12 text-center">
                                <a class="btn btn-primary" href="userProfile.php">Go To My Profile</a>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>

                <div class="col-12 bg-light vh-100 d-flex justify-content-center align-items-center">
                    <div class="row">
                        <div class="col-12 text-center">
                            <p class="fs-4 fw-bold text-black-50">You Already Have Seller Account :) :) ....</p>
                        </div>
                    </div>
                </div>

            <?php
            }
        } else {
            ?>
            <div class="col-12 bg-light vh-100 d-flex justify-content-center align-items-center">
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="fs-4 fw-bold text-black-50">Please Sign In Or Sign Up, because only our trusted members are allowed to open an account to sell products ....</p>
                    </div>
                    <div class="col-12 text-center">
                        <a class="btn btn-primary" href="userProfile.php">Go To My Profile</a>
                    </div>
                </div>
            </div>
        <?php
        }

        ?>

        </html>