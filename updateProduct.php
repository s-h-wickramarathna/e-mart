<?php
session_start();
require "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];
    $s_nic = $_SESSION["seller"]["nic"];

    $p_rs = Database::Search("SELECT * FROM `product` 
    INNER JOIN `model_has_brand` ON `product`.`model_has_brand_id` = `model_has_brand`.`m_h_b_id` 
    INNER JOIN `colour` ON `product`.`colour_id`=`colour`.`clr_id` 
    INNER JOIN `condition` ON `product`.`condition_id`=`condition`.`co_id`
    INNER JOIN `category` ON `product`.`category_ca_id`=`category`.`ca_id` 
    INNER JOIN `seller` ON `product`.`seller_nic`= `seller`.`nic`
    INNER JOIN `model` ON `model_has_brand`.`model_id`=`model`.`m_id` 
    INNER JOIN `brand` ON `model_has_brand`.`brand_id`=`brand`.`b_id` 
    INNER JOIN `size` ON `product`.`Size_id`=`size`.`size_id` WHERE `seller`.`nic`='" . $s_nic . "' AND `product`.`id`='" . $pid . "' ");

    $p_data = $p_rs->fetch_assoc();

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Emart || Update Products</title>

        <link rel="icon" href="resources/company-logo.png" />

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="icon" href="resources/logo.svg">
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 bg-light">
                    <div class="row mt-2 mb-1">

                        <div class="col-12 col-lg-4 bg-light">
                            <div class="row text-center">
                                <div class="col-12"><img src="resources/user_profile_img/userprofile.png" height="200px"></div>
                                <p class="fw-bold fs-4 text-black-50">Sarasavi.pvt.ltd</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8 mt-3">
                            <div class="row">
                                <div class="col-12 text-center text-lg-start">
                                    <p class="fs-2 fw-bold">Update Or Delete Your Own Products ....</p>
                                </div>
                                <div class="col-12 text-center text-lg-start">
                                    <p class="fs-5">iasf s jsfj sfdjls dsljdls sl jslfslkfjbsfsafs fs fs fhsf safh saj fsnf skfh skfn isfnksfn ksfn s fsfsf skfnskfnskf sknfsfb skfs fhsfhls fskaf hsja efu ef d fsdjfsdfjsd fdsf dsfjsdfj sdfjdsf dsf sdfjdsfjlsda fjsdf jflj fl; jf;l fjsd f a;s fjs;f;sfjsofj;sojf asf ;. </p>
                                </div>
                                <div class="col-12 d-flex justify-content-center justify-content-lg-end align-items-end mt-2 mt-lg-4">
                                    <button class="btn btn-outline-danger" onclick="viewDeleteModel();">Delete Product...</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">

                        <!-- row -->
                        <div class="col-12 border-bottom">
                            <div class="row mt-2 mb-2">

                                <!-- item -->
                                <div class="col-6 col-lg-4 border-end mt-3 mb-3">
                                    <p class="fw-bold">Product Category :-</p>
                                    <select class="form-select" disabled>
                                        <option value="<?php echo ($p_data["ca_id"]) ?>" selected><?php echo ($p_data["ca_name"]) ?></option>
                                    </select>
                                </div>
                                <!-- item -->
                                <!-- item -->
                                <div class="col-6 col-lg-4 mt-3 mb-3">
                                    <p class="fw-bold">Product Brand :-</p>
                                    <select class="form-select" disabled>
                                        <option value="<?php echo ($p_data["b_id"]) ?>" selected><?php echo ($p_data["b_name"]) ?></option>
                                    </select>
                                </div>
                                <!-- item -->
                                <!-- item -->
                                <div class="col-12 col-lg-4 mt-3 mb-3">
                                    <p class="fw-bold">Product Model :-</p>
                                    <select class="form-select" disabled>
                                        <option value="<?php echo ($p_data["m_id"]) ?>" selected><?php echo ($p_data["m_name"]) ?></option>
                                    </select>
                                </div>
                                <!-- item -->
                            </div>
                        </div>

                        <div class="col-12 mt-3 border-bottom">
                            <div class="row mb-3">
                                <p class="fw-bold">Product Title :-</p>
                                <div class="col-12">
                                    <input type="text" class="form-control shadow-none" value="<?php echo ($p_data["title"]) ?>" id="p_title">
                                </div>
                            </div>
                        </div>

                        <!-- row -->
                        <div class="col-12 border-bottom">
                            <div class="row mb-2">

                                <!-- item -->
                                <div class="col-6 col-lg-4 border-end mt-3 mb-3">
                                    <p class="fw-bold">Product Condition :-</p>
                                    <select class="form-select" disabled>
                                        <option value="<?php echo ($p_data["co_id"]) ?>" selected><?php echo ($p_data["co_name"]) ?></option>
                                    </select>
                                </div>
                                <!-- item -->
                                <!-- item -->
                                <div class="col-6 col-lg-4 mt-3 mb-3">
                                    <p class="fw-bold">Product Colour :-</p>
                                    <select class="form-select mt-3 mb-3" disabled>
                                        <option value="<?php echo ($p_data["clr_id"]) ?>" selected><?php echo ($p_data["clr_name"]) ?></option>
                                    </select>
                                </div>
                                <!-- item -->
                                <!-- item -->
                                <div class="col-12 col-lg-4 mt-3 mb-3">
                                    <p class="fw-bold">Product Quentity :-</p>
                                    <input type="number" min="1" class="form-control shadow-none" value="<?php echo ($p_data["qty"]) ?>" placeholder="Enter Quentity" id="p_qty">
                                </div>
                                <!-- item -->

                            </div>
                        </div>
                        <!-- row -->
                        <!-- row -->
                        <div class="col-12 border-bottom">
                            <div class="row mt-2 mb-2">

                                <!-- item -->
                                <div class="col-6 col-lg-3 border-end mt-3 mb-3">
                                    <p class="fw-bold">Product Size :-</p>
                                    <select class="form-select shadow-none" disabled>
                                        <option value="<?php echo ($p_data["size_id"]) ?>" selected><?php echo ($p_data["size_name"]) ?></option>
                                    </select>
                                </div>
                                <!-- item -->
                                <!-- item -->
                                <div class="col-6 col-lg-3 border-end mt-3 mb-3">
                                    <p class="fw-bold">Product Price :-</p>
                                    <input type="text" class="form-control" placeholder="Rs : " value="LKR : <?php echo ($p_data["price"]) ?>.00" readonly />
                                </div>
                                <!-- item -->
                                <!-- item -->
                                <div class="col-6 col-lg-3 mt-3 mb-3">
                                    <p class="fw-bold">Enter Delivary Cost :-</p>
                                    <input type="text" class="form-control shadow-none" placeholder=" Within Colombo" value="<?php echo ($p_data["cost_colombo"]) ?>" id="d_cost_colombo" />
                                </div>
                                <!-- item -->
                                <!-- item -->
                                <div class="col-6 col-lg-3 mt-3 mb-3">
                                    <p class="fw-bold mt-4"></p>
                                    <input type="text" class="form-control shadow-none" placeholder="Without Colombo" value=" <?php echo ($p_data["cost_others"]) ?>" id="d_cost_other" />
                                </div>
                                <!-- item -->
                            </div>
                        </div>
                        <!-- row -->
                        <div class="col-12 mt-3">
                            <p class="fw-bold">Product Description :-</p>
                            <textarea class="col-12 p-3 shadow-none" cols="30" rows="10" id="p_desc"><?php echo ($p_data["description"]); ?></textarea>
                        </div>
                        <!-- row -->
                        <div class="col-12 border-bottom mt-3 mb-3">
                            <div class="row mt-2 mb-2 d-flex justify-content-center">

                                <?php

                                $img = array();
                                $img[0] = "resources/emptyProducts.png";
                                $img[1] = "resources/emptyProducts.png";
                                $img[2] = "resources/emptyProducts.png";
                                $img[3] = "resources/emptyProducts.png";

                                $img_rs = Database::Search("SELECT * FROM `product_images` WHERE `product_id`='" . $pid . "'");
                                $img_num = $img_rs->num_rows;

                                for ($x = 0; $x < $img_num; $x++) {
                                    $img_data = $img_rs->fetch_assoc();
                                    $img[$x] = $img_data["p_path"];
                                }

                                ?>

                                <!-- item -->
                                <div class="col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center" id="img1">
                                    <img src="<?php echo ($img[0]) ?>" height="auto" id="u_img0">
                                </div>
                                <!-- item -->
                                <!-- item -->
                                <div class="col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center" id="img2">
                                    <img src="<?php echo ($img[1]) ?>" height="auto" id="u_img1">
                                </div>
                                <!-- item -->
                                <!-- item -->
                                <div class="col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center" id="img3">
                                    <img src="<?php echo ($img[2]) ?>" height="auto" id="u_img2">
                                </div>
                                <!-- item -->
                                <!-- item -->
                                <div class="col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center" id="img4">
                                    <img src="<?php echo ($img[3]) ?>" height="auto" id="u_img3">
                                </div>
                                <!-- item -->
                            </div>
                        </div>
                        <!-- row -->
                        <!-- row -->
                        <div class="col-12 mt-3 mb-3">
                            <div class="row text-center d-flex justify-content-center">
                                <div class="col-6 col-lg-4 d-grid">
                                    <input type="file" id="imgP" class="d-none" onclick="updateProductChange();" multiple />
                                    <label for="imgP" class="btn btn-primary">Upload Product Images</label>
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        <!-- row -->
                        <div class="col-12 mt-3">
                            <div class="row text-center d-flex justify-content-center">
                                <p class="fs-5 fw-bold text-black-50"> Notice :- We are taking 5% of the product from price from every product as a service charge</p>
                            </div>
                        </div>
                        <!-- row -->
                        <!-- row -->
                        <div class="col-12 border-bottom mt-3 mb-3">
                            <div class="row mt-2 mb-2 d-flex justify-content-center">

                                <div class="col-6">
                                    <div class="row d-flex justify-content-center">
                                        <!-- item -->
                                        <div class="col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center">
                                            <img src="resources/payment_methods/visa_img.png" height="60px" alt="" srcset="">
                                        </div>
                                        <!-- item -->
                                        <!-- item -->
                                        <div class="col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center">
                                            <img src="resources/payment_methods/paypal_img.png" height="60px" alt="" srcset="">
                                        </div>
                                        <!-- item -->
                                        <!-- item -->
                                        <div class="col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center">
                                            <img src="resources/payment_methods/mastercard_img.png" height="60px" alt="" srcset="">
                                        </div>
                                        <!-- item -->
                                        <!-- item -->
                                        <div class="col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center">
                                            <img src="resources/payment_methods/american_express_img.png" height="60px" alt="" srcset="">
                                        </div>
                                        <!-- item -->
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- row -->

                        <div class="col-12 text-center mb-3">
                            <button class="btn btn-primary" onclick="updateProductDetails(<?php echo ($pid) ?>);">Update Product Details</button>
                        </div>

                    </div>
                </div>


                <hr class="mt-2 mb-2">

                <?php include "footer.php"; ?>

                <!-- model -->

                <div class="modal" tabindex="-1" id="deleteModel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-danger fw-bold">Delete This Product ????</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are You Sure Do You Want To Delete This Product. Because It Cannot Be Recovered.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" onclick="deleteItem('<?php echo($pid) ?>')">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- model -->

                <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toast">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-secondary text-white">
                            <img src="resources/logo.svg" height="30px" class="rounded me-2" alt="...">
                            <strong class="me-auto">Emart</strong>
                            <small>Massage</small>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body bg-dark fw-bold text-white">
                            Your Product Sucessfully Updated ...
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>

<?php

} else {
}


?>