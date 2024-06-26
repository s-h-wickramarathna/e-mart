<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Emart</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="aos.css">

</head>

<body class="background-decoration-01">

    <div class="lorder d-none" id="signSpinner">
        <div class="spinner-grow text-primary p-2" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <!-- <button class="btn btn-primary opacity-100" type="button" disabled>
            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
            Loading...
        </button> -->
    </div>

    <!-- error_admin_block -->

    <div class="w-100 vh-100 d-flex align-items-center justify-content-center d-none" id="errorMassage">
        <div class="row text-center">
            <div class="col-12 text-center">
                <p class="fs-4 fw-bold text-black-50">??? ERROR :( :( Account Blocked ???</p>
                <p class="fs-4 fw-bold text-black-50">Your Account Has Blocked By Admin....</p>
            </div>
        </div>
    </div>

    <!-- error_admin_block -->

    <div class="container-fluid vh-100 d-flex justify-content-center background-decoration-02" id="fullcontent">
        <div class="row d-flex align-content-center justify-content-center overflow-hidden">

            <!-- head -->
            <!-- logo1 -->
            <div class="col-12 mt-4 d-md-block d-lg-none" data-aos="fade-right">
                <div class="row">
                    <div class="col-12 logo1"></div>
                    <div class="col-12 text-center">
                        <p class="fs-1 title_01 text-center m-0"><span class="title_02">E</span>mart</p>
                    </div>
                </div>
            </div>
            <!-- logo1 -->
            <div class="col-12 col-md-12 col-lg-11 col-xl-11 p-3 rounded-3">
                <div class="row d-flex align-content-center justify-content-center">
                    <!-- Logo2 -->
                    <div class="col-5 col-xl-6 d-none d-lg-block logo-bg-color" data-aos="fade-right">
                        <div class="row p-4">
                            <div class="col-12 logo"></div>
                            <div class="col-12 text-center">
                                <p class="fs-1 title_01"><span class="title_02">E</span>mart</p>
                            </div>
                            <div class="col-12 text-center">
                                <p class="fs-6">
                                    Don't worry your information is private and we will not share this information with anyone outside superhost !!!
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Logo2 -->
                    <!-- head -->
                    <!-- content -->
                    <!-- Signup & Signin Box -->
                    <div class="col-11 col-sm-10 col-md-10 col-lg-6 col-xl-5 bg-body d-flex justify-content-center align-content-center rounded-3 shadow-lg shadow-lg mb-5 mx-3 overflow-hidden" data-aos="fade-left">
                        <div class="row p-1 p-md-0 d-flex justify-content-center align-content-center rounded-3">
                            <!-- SignUp Box -->
                            <div class="col-12 p-3 d-none" id="signUpBox">
                                <div class="row g-2">
                                    <div class="col-12 fs-3">
                                        <p>Registration</p>
                                    </div>
                                    <div class="col-6 p-1">
                                        <input class="form-control shadow-none" type="text" placeholder="First Name" id="signup-f">
                                    </div>
                                    <div class="col-6 p-1">
                                        <input class="form-control shadow-none" type="text" placeholder="Last Name" id="signup-l">
                                    </div>
                                    <div class="col-12 p-1">
                                        <input class="form-control shadow-none" type="email" placeholder="Email" id="signup-e">
                                    </div>
                                    <div class="col-12 p-1">
                                        <div class="input-group">
                                            <input type="password" class="form-control shadow-none" placeholder="Password" id="signup-p">
                                            <button class="btn btn-outline-secondary" type="button" onclick="viewType();"><i class="bi bi-eye-slash-fill" id="p-icon"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-6 p-1">
                                        <input class="form-control shadow-none" type="text" placeholder="Mobile" id="signup-m">
                                    </div>
                                    <div class="col-6 p-1">
                                        <select class="form-select shadow-none" id="signup-g">
                                            <option>Gender</option>
                                            <?php
                                            require "connection.php";

                                            $rs = Database::search(" SELECT * FROM `gender`");
                                            $num = $rs->num_rows;

                                            for ($x = 0; $x < $num; $x++) {
                                                $data = $rs->fetch_assoc();
                                            ?> <option value="<?php echo ($data["id"]) ?>"><?php echo ($data["type"]) ?></option><?php
                                                                                                                                }
                                                                                                                                    ?>
                                        </select>
                                    </div>
                                    <div class="col-12 d-none" id="errormsg">
                                        <div class="alert alert-danger mb-0" id="errormsgBox1">
                                            <i class="bi bi-exclamation-triangle-fill" id="signup-msg"></i>
                                        </div>
                                    </div>
                                    <div class="col-6 d-grid">
                                        <button type="button" class="btn btn-primary" onclick="signup();">Sign Up</button>
                                    </div>
                                    <div class="col-6 d-grid">
                                        <button type="button" onclick="changeLoginMethod();" class="btn btn-danger">Go To Sign In</button>
                                    </div>
                                </div>
                            </div>
                            <!-- SignUp Box -->
                            <!-- cookies -->
                            <?php

                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }

                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }

                            ?>
                            <!-- cookies -->
                            <!-- SignIn Box -->
                            <div class="col-12 p-3" id="signInBox">
                                <div class="row g-2">
                                    <div class="col-12 fs-3">
                                        <p>Login</p>
                                    </div>
                                    <div class="col-12 pb-2">
                                        <input type="email" class="form-control shadow-none" placeholder="Email Address" value="<?php echo ($email) ?>" id="signIn-e">
                                    </div>
                                    <div class="col-12 pb-1">
                                        <div class="input-group">
                                            <input type="password" class="form-control shadow-none" placeholder="Password" value="<?php echo ($password) ?>" id="signIn-p">
                                            <button class="btn btn-outline-secondary" type="button" onclick="viewType1();"><i class="bi bi-eye-slash-fill" id="p-icon1"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-6 pb-0 pb-sm-2 ps-2">
                                        <div class="form-check">
                                            <input class="form-check-input shadow-none" type="checkbox" value="" id="rememderme">
                                            <label class="form-check-label" for="flexCheckChecked">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="col-12 p-0 ps-2 col-sm-6 text-start text-sm-end btn btn-link">
                                        <a href="#" onclick="forgotPassword();">Forgot Password?</a>
                                    </div>
                                    <div class="col-12 d-none" id="errormsg1">
                                        <div class="alert alert-danger mb-0" id="errormsgBox2">
                                            <i class="bi bi-exclamation-triangle-fill" id="signup-msg2"></i>
                                        </div>
                                    </div>
                                    <div class="col-12 d-grid">
                                        <button type="button" class="btn btn-primary" onclick="signIn();">Sign In</button>
                                    </div>
                                    <div class="col-12 d-grid">
                                        <button type="button" class="btn btn-danger" onclick="changeLoginMethod();">Create An Account</button>
                                    </div>
                                </div>
                            </div>
                            <!-- SignIn Box -->
                        </div>
                    </div>
                    <!-- Signup & Signin Box -->
                    <!-- model -->
                    <!-- Button trigger modal -->
                    <!-- Modal -->
                    <div class="modal fade" id="fmodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Reset Password !</h5>
                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                </div>
                                <div class="modal-body" id="fmbody1">
                                    <div class="row g-2 p-2">
                                        <div class="col-12">
                                            <input class="form-control" type="email" placeholder="Email Address" id="forgotE">
                                        </div>
                                        <div class="alert alert-primary d-none" role="alert" id="fpmsgBox">
                                            <i class="bi bi-exclamation-triangle-fill" id="fpmsgt1"></i>
                                        </div>
                                        <div class="col-12 d-none" id="VcodeBox">
                                            <input class="form-control" type="text" placeholder="Enter Verification Code" id="vcode">
                                        </div>
                                        <div class="alert alert-danger d-none" role="alert" id="vAlert">
                                            <i class="bi bi-exclamation-triangle-fill" id="fpmsgt2"></i>
                                        </div>
                                        <div class="col-12 text-end" id="fesendbtn">
                                            <button type="button" class="btn btn-info" onclick="sendVcode();">Send Code</button>
                                        </div>
                                        <div class="col-12 text-end d-none" id="fvsendbtn">
                                            <button type="button" class="btn btn-info" onclick="CodeVerify();">Go Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body d-none" id="fmbody2">
                                    <div class="row p-2 g-2" id="subModel">
                                        <div class="col-12 pb-3">
                                            <label class="form-label">New Password</label>
                                            <input class="form-control" type="password" placeholder="5-20 between characters" id="newp">
                                        </div>
                                        <div class="col-12 pb-2">
                                            <label class="form-label">Conform Password</label>
                                            <input class="form-control" type="password" placeholder="Re-type Password" id="cnewp">
                                        </div>
                                        <div class="alert alert-danger d-none" role="alert" id="fperrormsg2">
                                            <i class="bi bi-exclamation-triangle-fill" id="Pmsgt2"></i>
                                        </div>
                                        <div class="col-12 text-end">
                                            <button type="button" class="btn btn-info" onclick="forgotPasswordviewType();"><i class="bi bi-eye-slash-fill" id="fp-icon">&nbsp;</i>Show Password</button>
                                        </div>
                                    </div> 
                                    <div class="alert alert-success d-none" role="alert" id="fpsmsg">
                                        <i class="bi bi-check-circle">&nbsp;&nbsp;Your password has been successfully changed. You can now log in with your new password.</i>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="fclosebtn">Close</button>
                                    <button type="button" class="btn btn-primary d-none" onclick="resetPassword();" id="Rfpbtn">Reset Password</button>
                                    <!-- Model Loader -->
                                    <button class="btn btn-primary d-none" type="button" disabled id="fploader">
                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                    <!-- Model Loader -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- model -->
                    <!-- content -->
                    <!-- footer -->
                    <div class="col-12 d-none d-lg-block fixed-bottom text-center">
                        <p class="fs-6">&copy; 2022 Emart.lk || All Right Reserved</p>
                    </div>
                    <!-- footer -->
                </div>
            </div>
        </div>
    </div>
    <script src="aos.js"></script>
    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>