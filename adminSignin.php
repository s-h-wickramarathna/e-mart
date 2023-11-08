<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Emart || Admin Sign In</title>

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
    <div class="container-fluid vh-100 d-flex justify-content-center background-decoration-02">
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
                    <!--Signin Box -->
                    <div class="col-11 col-sm-10 col-md-10 col-lg-6 col-xl-5 bg-body d-flex justify-content-center align-content-center rounded-3 shadow-lg shadow-lg mb-5 mx-3 overflow-hidden" data-aos="fade-left">
                        <div class="row p-1 p-md-0 d-flex justify-content-center align-content-center rounded-3">
                            <!-- SignIn Box -->
                            <div class="col-12 p-3" id="signInBox">
                                <div class="row g-2">
                                    <div class="col-12 fs-3 fw-bold text-center">
                                        <p>Login As Admin</p>
                                    </div>
                                    <div class="col-12 pb-2">
                                        <input type="email" class="form-control shadow-none" placeholder="Email Address" value="" id="admin_email">
                                    </div>
                                    <div class="col-12 pb-1">
                                        <div class="input-group">
                                            <input type="password" class="form-control shadow-none" placeholder="Password" value="" id="admin_password">
                                        </div>
                                    </div>
                                    <div class="col-12 d-none" id="errormsg1">
                                        <div class="alert alert-danger mb-0" id="errormsgBox2">
                                            <i class="bi bi-exclamation-triangle-fill" id="signup-msg2"></i>
                                        </div>
                                    </div>
                                    <div class="col-12 d-grid mt-4">
                                        <button type="button" class="btn btn-primary" onclick="logAdmin();">Sign In</button>
                                    </div>
                                </div>
                            </div>
                            <!-- SignIn Box -->
                        </div>
                    </div>
                    <!--Signin Box -->
                    <!-- content -->

                    <!-- vefrification Model -->
                    <div class="modal" tabindex="-1" id="a_vcode_verify">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Admin Verification :-</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Enter Verification Code</p>
                                    <input type="text" class="form-control shadow-none" id="a-vcode">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="check_admin_vcode();">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- vefrification Model -->

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