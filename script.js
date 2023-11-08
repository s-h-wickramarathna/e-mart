AOS.init({
    duration: 1000,
    once: false
});

function changeLoginMethod() {
    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");
}

var PasswordVeiwType = true;

function viewType() {

    if (!document.getElementById("signup-p").value == "") {
        if (PasswordVeiwType == true) {
            document.getElementById("signup-p").setAttribute('type', 'text');
            document.getElementById("p-icon").className = "bi bi-eye-fill";
            PasswordVeiwType = false;
        } else {
            document.getElementById("signup-p").setAttribute('type', 'password');
            document.getElementById("p-icon").className = "bi bi-eye-slash-fill";
            PasswordVeiwType = true;
        }
    }
}

var PasswordVeiwType1 = true;

function viewType1() {

    if (!document.getElementById("signIn-p").value == "") {
        if (PasswordVeiwType1 == true) {
            document.getElementById("signIn-p").setAttribute('type', 'text');
            document.getElementById("p-icon1").className = "bi bi-eye-fill";
            PasswordVeiwType1 = false;
        } else {
            document.getElementById("signIn-p").setAttribute('type', 'password');
            document.getElementById("p-icon1").className = "bi bi-eye-slash-fill";
            PasswordVeiwType1 = true;
        }
    }
}
var PasswordVeiwType2 = true;

function viewType2() {

    if (!document.getElementById("seller-p").value == "") {
        if (PasswordVeiwType1 == true) {
            document.getElementById("seller-p").setAttribute('type', 'text');
            document.getElementById("seller-icon1").className = "bi bi-eye-fill";
            PasswordVeiwType1 = false;
        } else {
            document.getElementById("seller-p").setAttribute('type', 'password');
            document.getElementById("seller-icon1").className = "bi bi-eye-slash-fill";
            PasswordVeiwType1 = true;
        }
    }
}

function signup() {
    var fname = document.getElementById("signup-f");
    var lname = document.getElementById("signup-l");
    var email = document.getElementById("signup-e");
    var password = document.getElementById("signup-p");
    var mobile = document.getElementById("signup-m");
    var gender = document.getElementById("signup-g");
    var msgBox = document.getElementById("errormsg");
    var msg = document.getElementById("signup-msg");

    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("e", email.value);
    form.append("p", password.value);
    form.append("m", mobile.value);
    form.append("g", gender.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var txt = request.responseText;
            document.getElementById("signSpinner").className = "lorder d-none";

            if (txt == "Enter Your First Name ???" || txt == "First Name must have less than 50 characters ???") {
                lname.className = "form-control";
                email.className = "form-control";
                password.className = "form-control";
                mobile.className = "form-control";
                gender.className = "form-control";
                msg.innerHTML = "&nbsp; &nbsp; &nbsp;" + txt;
                fname.className = "form-control is-invalid";
                msgBox.className = "d-block";

            } else if (txt == "Enter Your Last Name ???" || txt == "Last Name must have less than 50 characters ???") {
                fname.className = "form-control";
                email.className = "form-control";
                password.className = "form-control";
                mobile.className = "form-control";
                gender.className = "form-control";
                msg.innerHTML = "&nbsp; &nbsp; &nbsp;" + txt;
                lname.className = "form-control is-invalid";
                msgBox.className = "d-block";

            } else if (txt == "Enter Your Email Address ???" || txt == "Invalid Email Address ???" || txt == "Email must have less than 100 characters ???") {
                lname.className = "form-control";
                fname.className = "form-control";
                password.className = "form-control";
                mobile.className = "form-control";
                gender.className = "form-control";
                msg.innerHTML = "&nbsp; &nbsp; &nbsp;" + txt;
                email.className = "form-control is-invalid";
                msgBox.className = "d-block";

            } else if (txt == "Enter Your Password ???" || txt == "Password must be between 5 - 20 charcters ???") {
                lname.className = "form-control";
                fname.className = "form-control";
                email.className = "form-control";
                mobile.className = "form-control";
                gender.className = "form-control";
                msg.innerHTML = "&nbsp; &nbsp; &nbsp;" + txt;
                password.className = "form-control is-invalid";
                msgBox.className = "d-block";

            } else if (txt == "Enter Your Mobile Number ???" || txt == "Invalid Mobile Number ???" || txt == "Mobile Number must have 10 characters") {
                fname.className = "form-control";
                lname.className = "form-control";
                email.className = "form-control";
                password.className = "form-control";
                gender.className = "form-control";
                msg.innerHTML = "&nbsp; &nbsp; &nbsp;" + txt;
                mobile.className = "form-control is-invalid";
                msgBox.className = "d-block";

            } else if (txt == "Select Your Gender ???") {
                fname.className = "form-control";
                lname.className = "form-control";
                email.className = "form-control";
                password.className = "form-control";
                mobile.className = "form-control";
                msg.innerHTML = "&nbsp; &nbsp; &nbsp;" + txt;
                gender.className = "form-control is-invalid";
                msgBox.className = "d-block";

            } else if (txt == "Your Details Are Exist") {
                fname.className = "form-control is-invalid";
                lname.className = "form-control is-invalid";
                email.className = "form-control is-invalid";
                password.className = "form-control is-invalid";
                mobile.className = "form-control is-invalid";
                gender.className = "form-control is-invalid";
                msg.innerHTML = "&nbsp; &nbsp; &nbsp;" + txt;
                msgBox.className = "d-block";

            } else if (txt == "Success") {
                fname.className = "form-control";
                lname.className = "form-control";
                email.className = "form-control";
                password.className = "form-control";
                mobile.className = "form-control";
                gender.className = "form-control";
                msg.className = "bi bi-check-circle-fill";
                msg.innerHTML = "&nbsp; &nbsp;" + txt;
                document.getElementById("errormsgBox1").className = "alert alert-success mb-0";
                msgBox.className = "d-block";
                fname.value = "";
                lname.value = "";
                email.value = "";
                password.value = "";
                mobile.value = "";
                gender.value = "";
                document.getElementById("signUpBox").classList = "d-none";
                document.getElementById("signInBox").classList = "d-block";
                msgBox.className = "d-none";
            }

        } else {
            document.getElementById("signSpinner").className = "lorder";
        }
    }

    request.open("POST", "signUpProcess.php", true);
    request.send(form);

}

function signIn() {
    var signInEmail = document.getElementById("signIn-e");
    var signInPassword = document.getElementById("signIn-p");
    var rememberMe = document.getElementById("rememderme");
    var errormsg = document.getElementById("errormsg1");
    var errormsgBox = document.getElementById("errormsgBox2");
    var errormsgText = document.getElementById("signup-msg2");

    var form = new FormData();
    form.append("e", signInEmail.value);
    form.append("p", signInPassword.value);
    form.append("rm", rememberMe.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            document.getElementById("signSpinner").className = "lorder d-none";
            if (text == "Enter Your Email ???" || text == "Invalid Email Address ???" || text == "Email must have less than 100 characters ???") {
                signInPassword.className = "form-control";
                signInEmail.className = "form-control is-invalid";
                errormsgText.innerHTML = "&nbsp; &nbsp;" + text;
                errormsg.className = "d-block";

            } else if (text == "Enter Your Password ???" || text == "Password must be between 5 - 20 charcters ???") {
                signInEmail.className = "form-control";
                signInPassword.className = "form-control is-invalid";
                errormsgText.innerHTML = "&nbsp; &nbsp;" + text;
                errormsg.className = "d-block";

            } else if (text == "Invalid Email Address or Password") {
                signInEmail.className = "form-control is-invalid";
                signInPassword.className = "form-control is-invalid";
                errormsgText.innerHTML = "&nbsp; &nbsp;" + text;
                errormsg.className = "d-block";

            } else if (text == "Success") {
                signInEmail.className = "form-control";
                signInPassword.className = "form-control";
                errormsg.className = "d-none";
                window.location = "index.php";

            } else if (text == "admin_deactivated") {
                document.getElementById("fullcontent").className = "container-fluid vh-100 d-flex justify-content-center background-decoration-02 d-none";
                document.getElementById("errorMassage").className = "w-100 vh-100 d-flex align-items-center justify-content-center";

            } else {
                alert(text);
            }

        } else {
            document.getElementById("signSpinner").className = "lorder";

        }
    }

    request.open("POST", "signInProcess.php", true);
    request.send(form);

}

function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "index.php";
            }
        }
    }

    r.open("GET", "signOutProcess.php", true);
    r.send();

}

var bm;

function forgotPassword() {

    var m = document.getElementById("fmodel");
    bm = new bootstrap.Modal(m);
    bm.show();

}

function sendVcode() {
    var femail = document.getElementById("forgotE");

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var txt = request.responseText;
            document.getElementById("fploader").className = "btn btn-primary d-none";
            document.getElementById("fclosebtn").className = "btn btn-secondary d-block";
            if (txt == "Enter Your Email Address ???" || txt == "Invalid Email Address ???" || txt == "Email must have less than 100 characters ???") {
                femail.className = "form-control is-invalid";
                document.getElementById("fpmsgt1").innerHTML = "&nbsp;&nbsp;" + txt;
                document.getElementById("fpmsgBox").className = "alert alert-danger";
            } else if (txt == "Verification code sending failed ???") {
                femail.className = "form-control";
                document.getElementById("fpmsgt1").innerHTML = "&nbsp;&nbsp;" + txt;
                document.getElementById("fpmsgBox").className = "alert alert-danger";
            } else if (txt == "Verification Code Successfully Send Your Email") {
                femail.className = "form-control";
                document.getElementById("fpmsgt1").className = "bi bi-check-circle-fill";
                document.getElementById("fpmsgt1").innerHTML = "&nbsp;&nbsp;" + txt;
                document.getElementById("fpmsgBox").className = "alert alert-success";
                document.getElementById("VcodeBox").className = "col-12";
                document.getElementById("fesendbtn").className = "col-12 text-end d-none";
                document.getElementById("fvsendbtn").className = "col-12 text-end";
                document.getElementById("fclosebtn").classList = "d-none";

            }
        } else {
            document.getElementById("fploader").className = "btn btn-primary";
            document.getElementById("fclosebtn").classList = "d-none";
        }
    }

    request.open("GET", "forgotPasswordProcess.php?e=" + femail.value, true);
    request.send();
}

function CodeVerify() {
    var femail = document.getElementById("forgotE");
    var Vcode = document.getElementById("vcode");

    var form = new FormData();
    form.append("fe", femail.value);
    form.append("fv", Vcode.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var txt = request.responseText;
            document.getElementById("fploader").className = "btn btn-primary d-none";
            if (txt == "Enter Your Verificaton Code ???" || txt == "Invalid Verification Code ???") {
                Vcode.className = "form-control is-invalid";
                Vcode.value = "";
                document.getElementById("fpmsgt2").innerHTML = "&nbsp;&nbsp;" + txt;
                document.getElementById("vAlert").className = "alert alert-danger";
            } else if (txt == "success") {
                Vcode.className = "form-control";
                document.getElementById("vAlert").className = "alert alert-danger d-none";
                document.getElementById("fmbody1").classList = "d-none";
                document.getElementById("Rfpbtn").className = "btn btn-primary";
                document.getElementById("fmbody2").className = "modal-body";
            }
        } else {
            document.getElementById("fploader").className = "btn btn-primary";
        }
    }

    request.open("POST", "verificationCodeProcess.php", true);
    request.send(form);

}

function forgotPasswordviewType() {
    var newps = document.getElementById("newp");
    var cnewps = document.getElementById("cnewp");
    var fpicon = document.getElementById("fp-icon");

    if (newps.type == "password" & cnewps.type == "password") {
        newps.type = "text";
        cnewps.type = "text";
        fpicon.className = "bi bi-eye-fill";
    } else {
        newps.type = "password";
        cnewps.type = "password";
        fpicon.className = "bi bi-eye-slash-fill";

    }
}

function resetPassword() {
    var newPassword = document.getElementById("newp");
    var CnewPassword = document.getElementById("cnewp");
    var email = document.getElementById("forgotE");

    var form = new FormData();
    form.append("newp", newPassword.value);
    form.append("Cnp", CnewPassword.value);
    form.append("e", email.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            document.getElementById("fploader").className = "btn btn-primary d-none";
            document.getElementById("Rfpbtn").className = "btn btn-primary";
            if (text == "Enter new Password ???") {
                CnewPassword.className = "form-control";
                newPassword.className = "form-control is-invalid";
                document.getElementById("Pmsgt2").innerHTML = "&nbsp;&nbsp;" + text;
                document.getElementById("fperrormsg2").className = "alert alert-danger";

            } else if (text == "Password must be between 5 - 20 charcters ???" || text == "Password does not matched ???") {
                newPassword.className = "form-control is-invalid";
                CnewPassword.className = "form-control is-invalid";
                CnewPassword.value = "";
                document.getElementById("Pmsgt2").innerHTML = "&nbsp;&nbsp;" + text;
                document.getElementById("fperrormsg2").className = "alert alert-danger";

            } else if (text == "Conform your Password ???") {
                newPassword.className = "form-control";
                CnewPassword.className = "form-control is-invalid";
                document.getElementById("Pmsgt2").innerHTML = "&nbsp;&nbsp;" + text;
                document.getElementById("fperrormsg2").className = "alert alert-danger";

            } else if (text == "success") {
                newPassword.className = "form-control";
                CnewPassword.className = "form-control";
                document.getElementById("fperrormsg2").className = "alert alert-danger d-none";
                document.getElementById("subModel").classList = "d-none";
                document.getElementById("Rfpbtn").classList = "d-none";
                document.getElementById("fpsmsg").className = "alert alert-success";
                document.getElementById("fclosebtn").className = "btn btn-secondary";

            }
        } else {
            document.getElementById("Rfpbtn").classList = "d-none";
            document.getElementById("fploader").className = "btn btn-primary";
        }
    }

    request.open("POST", "passwordChange.php", true);
    request.send(form);


}

function sidemenu() {
    document.getElementById("menuSideUp").className = "side-main-menu1 mt-5 pt-1 col-6 col-md-4 col-lg-4 col-xl-3 ps-5"
    document.getElementById("menuSide").className = "sidemain2 col-8 col-md-6 col-lg-4 col-xl-3 shadow-lg";
}

function closesideMenu() {
    document.getElementById("menuSide").className = "sidemain1 col-8 col-md-6 col-lg-4 col-xl-3 shadow-lg";
}

function upmenu() {
    document.getElementById("menuSideUp").className = "side-main-menu2 mt-4 pt-1 col-6 col-md-4 col-lg-4 col-xl-3 ps-5";
    document.getElementById("menuSide").className = "sidemain1 col-8 col-md-6 col-lg-4 col-xl-3 shadow-lg";
}

function upmenuClose() {
    document.getElementById("menuSideUp").className = "side-main-menu1 mt-4 pt-1 col-6 col-md-4 col-lg-4 col-xl-3 ps-5"
}

function showserachBar() {
    document.getElementById("showbar").className = "col-12 bg-light searchmainBox2";
}

function closeserachBar() {
    document.getElementById("productitemlist").className = "col-12 p-3 rounded shadow-sm bg-light d-none";
    document.getElementById("showbar").className = "col-12 bg-light searchmainBox1";

}


function searchproduct() {
    var searchtext = document.getElementById("searchText");

    if (searchtext.value.length == 0) {
        document.getElementById("productitemlist").className = "d-none";
        document.getElementById("searchBTN").className = "btn btn-primary d-none";

    } else if (searchtext.value.length >= 1) {
        document.getElementById("searchBTN").className = "btn btn-primary";
        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                document.getElementById("productitemlist").innerHTML = t;
                document.getElementById("productitemlist").className = "col-12 p-3 rounded shadow-sm bg-light";
            }
        }

        r.open("GET", "searchProcess.php?sitems=" + searchtext.value, true);
        r.send();

    }

}

function searchproducttext(txt) {
    document.getElementById("searchText").value = txt;
    document.getElementById("productitemlist").className = "d-none";

}

function eraseSearchText() {
    document.getElementById("searchText").value = "";
    document.getElementById("productitemlist").className = "d-none";
}

function searchproductitems() {
    var txt = document.getElementById("searchText");
    window.location = "searchProduct.php?t=" + txt.value;

}

function loadProvince() {
    var ctry = document.getElementById("cntry").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("p").innerHTML = t;
        }
    }

    r.open("GET", "changeProvince.php?c=" + ctry, true);
    r.send();

}

function loadDistrict() {
    var province = document.getElementById("p");

    var f = new FormData();
    f.append("p", province.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("d").innerHTML = t;
        }
    }

    r.open("POST", "changeDistrict.php", true);
    r.send(f);

}

function loadcities() {
    var city = document.getElementById("d").value

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("city").innerHTML = t;
        }
    }

    r.open("GET", "changecities.php?d=" + city, true);
    r.send();
}


function changeImage() {
    var view = document.getElementById("viewImg"); //img tag
    var file = document.getElementById("profileimg"); //file chooser

    file.onchange = function() {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;

    }

}

function user_profile_update() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcd");
    var pimage = document.getElementById("profileimg");

    var f = new FormData();
    f.append("f", fname.value);
    f.append("l", lname.value);
    f.append("m", mobile.value);
    f.append("l1", line1.value);
    f.append("l2", line2.value);
    f.append("city", city.value);
    f.append("pcode", pcode.value);
    f.append("pimg", pimage.files[0]);

    var rq = new XMLHttpRequest();

    rq.onreadystatechange = function() {
        if (rq.readyState == 4) {
            var txt = rq.responseText;
            alert(txt);
            if (txt == "Success") {
                document.getElementById("viewImg").className = "rounded-3 mt-5";
                document.getElementById("iniMage").className = "text-danger d-none";
                line1.className = "form-control";
                line2.className = "form-control";
                city.className = "form-control";
                pcode.className = "form-control";
                window.location.reload();

            } else if (txt == "error") {
                line1.className = "form-control is-invalid";
                line2.className = "form-control is-invalid";
                city.className = "form-control is-invalid";
                pcode.className = "form-control is-invalid";

            } else if (txt == "Invalid Image TypeSuccess") {
                document.getElementById("viewImg").className = "rounded-3 mt-5 border border-danger";
                document.getElementById("iniMage").className = "text-danger";
            }

        }

    }

    rq.open("POST", "updateProfile.php", true);
    rq.send(f);

}


function sellerPasswordTypeChange1() {
    var newPinput = document.getElementById("sellernewpasswordinput");
    var NewPbuttonicone = document.getElementById("sellernewpassword");

    if (newPinput.type == "password") {
        newPinput.type = "text";
        NewPbuttonicone.className = "bi bi-eye-fill";
    } else {
        newPinput.type = "password";
        NewPbuttonicone.className = "bi bi-eye-slash-fill";
    }
}

function sellerConfirmPInput() {
    var newPinput2 = document.getElementById("sellerConformPInput");
    var NewPbuttonicone2 = document.getElementById("sellerPIcone2");

    if (newPinput2.type == "password") {
        newPinput2.type = "text";
        NewPbuttonicone2.className = "bi bi-eye-fill";
    } else {
        newPinput2.type = "password";
        NewPbuttonicone2.className = "bi bi-eye-slash-fill";
    }
}

function nicupload() {
    var imgchooser = document.getElementById("nicImgUploder");

    imgchooser.onchange = function() {
        var file_count = imgchooser.files.length;

        if (file_count == 2) {
            document.getElementById("nicmaindiv1").className = "col-5 border border-2 border-dark d-flex justify-content-center";
            document.getElementById("nicmaindiv2").className = "col-5 border border-2 border-dark d-flex justify-content-center";
            document.getElementById("img_error").innerHTML = "";

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);
                document.getElementById("nic" + x).src = url;

            }
        } else {
            document.getElementById("nicmaindiv1").className = "col-5 border border-2 border-danger d-flex justify-content-center";
            document.getElementById("nicmaindiv2").className = "col-5 border border-2 border-danger d-flex justify-content-center";
            document.getElementById("img_error").innerHTML = "Invalid Image Count";
            document.getElementById("img_error").className = "invalid-field";

        }


    }
}

function CreateSeller() {
    var s_New_Password = document.getElementById("sellernewpasswordinput");
    var s_Confirm_Password = document.getElementById("sellerConformPInput");
    var s_NIC = document.getElementById("s_nic");
    var s_Shop_Name = document.getElementById("shop_name");
    var img_Chooser = document.getElementById("nicImgUploder");

    var form = new FormData();
    form.append("snp", s_New_Password.value);
    form.append("scp", s_Confirm_Password.value);
    form.append("snic", s_NIC.value);
    form.append("sShopn", s_Shop_Name.value);

    var file_count = img_Chooser.files.length;

    for (var x = 0; x < file_count; x++) {
        form.append("img" + x, img_Chooser.files[x]);
    }

    var rq = new XMLHttpRequest();

    rq.onreadystatechange = function() {
        if (rq.readyState == 4) {
            var txt = rq.responseText;

            if (txt == "Enter Your New Seller Email ???" || txt == "Email must have lessthan 100 charactors ???") {
                // seller new password
                document.getElementById("sellernewpasswordinput").className = "form-control shadow-none";
                document.getElementById("np_field").innerHTML = txt;
                document.getElementById("np_field").className = "invalid-field d-none";
                // seller new password
                // seller Confirm Password
                document.getElementById("sellerConformPInput").className = "form-control shadow-none";
                document.getElementById("cp_field").innerHTML = txt;
                document.getElementById("cp_field").className = "invalid-field d-none";
                // seller Confirm Password
                // seller NIC
                document.getElementById("s_nic").className = "form-control shadow-none";
                document.getElementById("nic_field").innerHTML = txt;
                document.getElementById("nic_field").className = "invalid-field d-none";
                // seller NIC
                // seller shop Name
                document.getElementById("shop_name").className = "form-control shadow-none";
                document.getElementById("shop_field").innerHTML = txt;
                document.getElementById("shop_field").className = "invalid-field d-none";
                // seller shop Name
                // NIC Images
                document.getElementById("nicmaindiv1").className = "col-5 border border-2 border-dark d-flex justify-content-center";
                document.getElementById("nicmaindiv2").className = "col-5 border border-2 border-dark d-flex justify-content-center";
                document.getElementById("img_error").innerHTML = txt;
                document.getElementById("img_error").className = "invalid-field d-none";
                // NIC Images

            } else if (txt == "Invalid email Address ???" || txt == "Existing email address ???") {
                // seller new password
                document.getElementById("sellernewpasswordinput").className = "form-control shadow-none";
                document.getElementById("np_field").innerHTML = txt;
                document.getElementById("np_field").className = "invalid-field d-none";
                // seller new password
                // seller Confirm Password
                document.getElementById("sellerConformPInput").className = "form-control shadow-none";
                document.getElementById("cp_field").innerHTML = txt;
                document.getElementById("cp_field").className = "invalid-field d-none";
                // seller Confirm Password
                // seller NIC
                document.getElementById("s_nic").className = "form-control shadow-none";
                document.getElementById("nic_field").innerHTML = txt;
                document.getElementById("nic_field").className = "invalid-field d-none";
                // seller NIC
                // seller shop Name
                document.getElementById("shop_name").className = "form-control shadow-none";
                document.getElementById("shop_field").innerHTML = txt;
                document.getElementById("shop_field").className = "invalid-field d-none";
                // seller shop Name
                // NIC Images
                document.getElementById("nicmaindiv1").className = "col-5 border border-2 border-dark d-flex justify-content-center";
                document.getElementById("nicmaindiv2").className = "col-5 border border-2 border-dark d-flex justify-content-center";
                document.getElementById("img_error").innerHTML = txt;
                document.getElementById("img_error").className = "invalid-field d-none";
                // NIC Images


            } else if (txt == "Enter New Seller Password ???" || txt == "Password must have between 5 - 20 charactors ???") {
                // seller new password
                document.getElementById("sellernewpasswordinput").className = "form-control shadow-none is-invalid";
                document.getElementById("np_field").innerHTML = txt;
                document.getElementById("np_field").className = "invalid-field";
                // seller new password
                // seller Confirm Password
                document.getElementById("sellerConformPInput").className = "form-control shadow-none";
                document.getElementById("cp_field").innerHTML = txt;
                document.getElementById("cp_field").className = "invalid-field d-none";
                // seller Confirm Password
                // seller NIC
                document.getElementById("s_nic").className = "form-control shadow-none";
                document.getElementById("nic_field").innerHTML = txt;
                document.getElementById("nic_field").className = "invalid-field d-none";
                // seller NIC
                // seller shop Name
                document.getElementById("shop_name").className = "form-control shadow-none";
                document.getElementById("shop_field").innerHTML = txt;
                document.getElementById("shop_field").className = "invalid-field d-none";
                // seller shop Name
                // NIC Images
                document.getElementById("nicmaindiv1").className = "col-5 border border-2 border-dark d-flex justify-content-center";
                document.getElementById("nicmaindiv2").className = "col-5 border border-2 border-dark d-flex justify-content-center";
                document.getElementById("img_error").innerHTML = txt;
                document.getElementById("img_error").className = "invalid-field d-none";
                // NIC Images

            } else if (txt == "Enter Your Conform Seller Password ???" || txt == "Password Does Not Matched ???") {
                // seller new password
                document.getElementById("sellernewpasswordinput").className = "form-control shadow-none";
                document.getElementById("np_field").innerHTML = txt;
                document.getElementById("np_field").className = "invalid-field d-none";
                // seller new password
                // seller Confirm Password
                document.getElementById("sellerConformPInput").className = "form-control shadow-none is-invalid";
                document.getElementById("sellerConformPInput").value = "";
                document.getElementById("cp_field").innerHTML = txt;
                document.getElementById("cp_field").className = "invalid-field";
                // seller Confirm Password
                // seller NIC
                document.getElementById("s_nic").className = "form-control shadow-none";
                document.getElementById("nic_field").innerHTML = txt;
                document.getElementById("nic_field").className = "invalid-field d-none";
                // seller NIC
                // seller shop Name
                document.getElementById("shop_name").className = "form-control shadow-none";
                document.getElementById("shop_field").innerHTML = txt;
                document.getElementById("shop_field").className = "invalid-field d-none";
                // seller shop Name
                // NIC Images
                document.getElementById("nicmaindiv1").className = "col-5 border border-2 border-dark d-flex justify-content-center";
                document.getElementById("nicmaindiv2").className = "col-5 border border-2 border-dark d-flex justify-content-center";
                document.getElementById("img_error").innerHTML = txt;
                document.getElementById("img_error").className = "invalid-field d-none";
                // NIC Images

            } else if (txt == "Enter Your National ID ???" || txt == "Invalid National ID ???") {
                // seller new password
                document.getElementById("sellernewpasswordinput").className = "form-control shadow-none";
                document.getElementById("np_field").innerHTML = txt;
                document.getElementById("np_field").className = "invalid-field d-none";
                // seller new password
                // seller Confirm Password
                document.getElementById("sellerConformPInput").className = "form-control shadow-none";
                document.getElementById("sellerConformPInput").value = "";
                document.getElementById("cp_field").innerHTML = txt;
                document.getElementById("cp_field").className = "invalid-field d-none";
                // seller Confirm Password
                // seller NIC
                document.getElementById("s_nic").className = "form-control shadow-none is-invalid";
                document.getElementById("nic_field").innerHTML = txt;
                document.getElementById("nic_field").className = "invalid-field";
                // seller NIC
                // seller shop Name
                document.getElementById("shop_name").className = "form-control shadow-none";
                document.getElementById("shop_field").innerHTML = txt;
                document.getElementById("shop_field").className = "invalid-field d-none";
                // seller shop Name
                // NIC Images
                document.getElementById("nicmaindiv1").className = "col-5 border border-2 border-dark d-flex justify-content-center";
                document.getElementById("nicmaindiv2").className = "col-5 border border-2 border-dark d-flex justify-content-center";
                document.getElementById("img_error").innerHTML = txt;
                document.getElementById("img_error").className = "invalid-field d-none";
                // NIC Images

            } else if (txt == "Enter Your Shop Name ???" || txt == "Shop Name Must Have between 5 - 20 Charactors ???") {
                // seller new password
                document.getElementById("sellernewpasswordinput").className = "form-control shadow-none";
                document.getElementById("np_field").innerHTML = txt;
                document.getElementById("np_field").className = "invalid-field d-none";
                // seller new password
                // seller Confirm Password
                document.getElementById("sellerConformPInput").className = "form-control shadow-none";
                document.getElementById("sellerConformPInput").value = "";
                document.getElementById("cp_field").innerHTML = txt;
                document.getElementById("cp_field").className = "invalid-field d-none";
                // seller Confirm Password
                // seller NIC
                document.getElementById("s_nic").className = "form-control shadow-none";
                document.getElementById("nic_field").innerHTML = txt;
                document.getElementById("nic_field").className = "invalid-field d-none";
                // seller NIC
                // seller shop Name
                document.getElementById("shop_name").className = "form-control shadow-none is-invalid";
                document.getElementById("shop_field").innerHTML = txt;
                document.getElementById("shop_field").className = "invalid-field";
                // seller shop Name
                // NIC Images
                document.getElementById("nicmaindiv1").className = "col-5 border border-2 border-dark d-flex justify-content-center";
                document.getElementById("nicmaindiv2").className = "col-5 border border-2 border-dark d-flex justify-content-center";
                document.getElementById("img_error").innerHTML = txt;
                document.getElementById("img_error").className = "invalid-field d-none";
                // NIC Images

            } else if (txt == "Invalid Image Type ???" || txt == "Invalid Image Count ???") {
                // seller new password
                document.getElementById("sellernewpasswordinput").className = "form-control shadow-none";
                document.getElementById("np_field").innerHTML = txt;
                document.getElementById("np_field").className = "invalid-field d-none";
                // seller new password
                // seller Confirm Password
                document.getElementById("sellerConformPInput").className = "form-control shadow-none";
                document.getElementById("sellerConformPInput").value = "";
                document.getElementById("cp_field").innerHTML = txt;
                document.getElementById("cp_field").className = "invalid-field d-none";
                // seller Confirm Password
                // seller NIC
                document.getElementById("s_nic").className = "form-control shadow-none";
                document.getElementById("nic_field").innerHTML = txt;
                document.getElementById("nic_field").className = "invalid-field d-none";
                // seller NIC
                // seller shop Name
                document.getElementById("shop_name").className = "form-control shadow-none";
                document.getElementById("shop_field").innerHTML = txt;
                document.getElementById("shop_field").className = "invalid-field d-none";
                // seller shop Name
                // NIC Images
                document.getElementById("nicmaindiv1").className = "col-5 border border-2 border-danger d-flex justify-content-center";
                document.getElementById("nicmaindiv2").className = "col-5 border border-2 border-danger d-flex justify-content-center";
                document.getElementById("img_error").innerHTML = txt;
                document.getElementById("img_error").className = "invalid-field";
                // NIC Images

            } else if (txt == "Admin will Cornform Your Seller Email Account Request") {
                // seller new password
                document.getElementById("sellernewpasswordinput").className = "form-control shadow-none";
                document.getElementById("np_field").innerHTML = txt;
                document.getElementById("np_field").className = "invalid-field d-none";
                // seller new password
                // seller Confirm Password
                document.getElementById("sellerConformPInput").className = "form-control shadow-none";
                document.getElementById("sellerConformPInput").value = "";
                document.getElementById("cp_field").innerHTML = txt;
                document.getElementById("cp_field").className = "invalid-field d-none";
                // seller Confirm Password
                // seller NIC
                document.getElementById("s_nic").className = "form-control shadow-none";
                document.getElementById("nic_field").innerHTML = txt;
                document.getElementById("nic_field").className = "invalid-field d-none";
                // seller NIC
                // seller shop Name
                document.getElementById("shop_name").className = "form-control shadow-none";
                document.getElementById("shop_field").innerHTML = txt;
                document.getElementById("shop_field").className = "invalid-field d-none";
                // seller shop Name
                // NIC Images
                document.getElementById("nicmaindiv1").className = "col-5 border border-2 border-dark d-flex justify-content-center";
                document.getElementById("nicmaindiv2").className = "col-5 border border-2 border-dark d-flex justify-content-center";
                document.getElementById("img_error").innerHTML = txt;
                document.getElementById("img_error").className = "invalid-field d-none";
                // NIC Images

                document.getElementById("request_note").innerHTML = "We Are Send Your Request To Admin <br/> & <br/> Admin is Approve Your Create Seller Account Request After You Can Access Your Seller Account";
                document.getElementById("sellerPage_content").className = "col-11 rounded-3 mb-4 shadow-lg d-none";

            } else {
                alert(txt);
            }

        }

    }

    rq.open("POST", "sellerSignUpProcess.php", true);
    rq.send(form);

}

function sellerSignin() {
    var seller_email = document.getElementById("seller_signIn-e");
    var seller_password = document.getElementById("seller_signIn-p");
    var s_rememberme = document.getElementById("seller_rememderme").checked


    var f = new FormData();

    f.append("se", seller_email.value);
    f.append("sp", seller_password.value);
    f.append("sr", s_rememberme);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var txt = r.responseText;
            if (txt == "Enter Your NIC Number ???") {
                document.getElementById("seller_signIn-e").className = "form-control shadow-none is-invalid";
                document.getElementById("signup-msgseller2").innerHTML = "&nbsp;&nbsp;" + txt;
                document.getElementById("errormsgseller1").className = "col-12";

            } else if (txt == "Enter Your Password ???") {
                document.getElementById("seller_signIn-e").className = "form-control shadow-none";
                document.getElementById("seller_signIn-p").className = "form-control shadow-none is-invalid";
                document.getElementById("signup-msgseller2").innerHTML = "&nbsp;&nbsp;" + txt;
                document.getElementById("errormsgseller1").className = "col-12";

            } else if (txt == "Invalid Email Or Password ???") {
                document.getElementById("seller_signIn-e").className = "form-control shadow-none is-invalid";
                document.getElementById("seller_signIn-p").className = "form-control shadow-none is-invalid";
                document.getElementById("signup-msgseller2").innerHTML = "&nbsp;&nbsp;" + txt;
                document.getElementById("errormsgseller1").className = "col-12";

            } else if (txt == "success") {
                document.getElementById("seller_signIn-e").className = "form-control shadow-none";
                document.getElementById("seller_signIn-p").className = "form-control shadow-none";
                document.getElementById("signup-msgseller2").innerHTML = "&nbsp;&nbsp;" + txt;
                document.getElementById("errormsgseller1").className = "col-12 d-none";
                window.location = "sellerpanel.php";

            } else if (txt == "blocked") {
                document.getElementById("sellercontent").className = "container-fluid vh-100 d-flex justify-content-center background-decoration-02 d-none";
                document.getElementById("sellererrorMassage").className = "w-100 vh-100 d-flex align-items-center justify-content-center";

            } else {
                alert(txt);
            }
        }
    }


    r.open("POST", "sellerSignInProcess.php", true);
    r.send(f);

}

function sellerFilterShow() {
    document.getElementById("s_filter").className = "col-6 col-md-4 col-lg-3 col-xxl-2 pe-3 vh-100 d-flex align-items-center fixed-top bg-transparent fiterSlideshow";
}

function sellerFilterHide() {
    document.getElementById("s_filter").className = "col-6 col-md-4 col-lg-3 col-xxl-2 pe-3 vh-100 d-flex align-items-center fixed-top bg-transparent fiterSlidehidden";
}

function productImageView() {

    var img_chooser = document.getElementById("a_imgChooser");
    img_chooser.onchange = function() {
        var file_count = img_chooser.files.length;
        if (file_count <= 4) {
            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);
                document.getElementById("a_img" + x).src = url;
            }
        }

    }

}

function addProduct() {
    var p_category = document.getElementById("a_category");
    var p_brand = document.getElementById("a_brand");
    var p_model = document.getElementById("a_model");
    var p_condition = document.getElementById("a_condition");
    var p_colour = document.getElementById("a_colour");
    var p_quentity = document.getElementById("a_quentity");
    var img_chooser = document.getElementById("a_imgChooser");
    var p_size = document.getElementById("a_productSize");
    var p_price = document.getElementById("a_price");

    var p_dc_cost = document.getElementById("a_dc_cost");
    var p_dw_cost = document.getElementById("a_dw_cost");
    var p_desc = document.getElementById("a_desc");
    var p_title = document.getElementById("p_title");

    var form = new FormData();

    form.append("ca", p_category.value);
    form.append("b", p_brand.value);
    form.append("m", p_model.value);
    form.append("con", p_condition.value);
    form.append("clur", p_colour.value);
    form.append("qty", p_quentity.value);
    form.append("price", p_price.value);
    form.append("title", p_title.value);

    var file_count = img_chooser.files.length;

    for (var x = 0; x < file_count; x++) {
        form.append("img" + x, img_chooser.files[x]);
    }

    form.append("dwc", p_dc_cost.value);
    form.append("doc", p_dw_cost.value);
    form.append("desc", p_desc.value);

    if (p_category.value == "2") {
        form.append("size", p_size.value);
    }

    var rq = new XMLHttpRequest();

    rq.onreadystatechange = function() {
        if (rq.readyState == 4) {
            var txt = rq.responseText;
            if (txt == "empty") {
                p_category.className = "form-select shadow-none is-invalid";
                p_brand.className = "form-select shadow-none is-invalid";
                p_model.className = "form-select shadow-none is-invalid";
                p_condition.className = "form-select shadow-none is-invalid";
                p_colour.className = "form-select shadow-none is-invalid";
                p_quentity.className = "form-control shadow-none is-invalid";
                p_size.className = "form-select shadow-none is-invalid";
                p_price.className = "form-control shadow-none is-invalid";
                p_dc_cost.className = "form-control shadow-none is-invalid";
                p_dw_cost.className = "form-control shadow-none is-invalid";
                p_desc.className = "col-12 p-3 border-danger";
                p_title.className = "form-control me-3 shadow-none is-invalid";

            } else if (txt == "invalid Image Count") {
                p_category.className = "form-select shadow-none";
                p_brand.className = "form-select shadow-none";
                p_model.className = "form-select shadow-none";
                p_condition.className = "form-select shadow-none";
                p_colour.className = "form-select shadow-none";
                p_quentity.className = "form-control shadow-none";
                p_size.className = "form-select shadow-none";
                p_price.className = "form-control shadow-none";
                p_dc_cost.className = "form-control shadow-none";
                p_dw_cost.className = "form-control shadow-none";
                p_desc.className = "col-12 p-3";
                p_title.className = "form-control me-3 shadow-none";

                document.getElementById("addImg1").className = "col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center border-danger";
                document.getElementById("addImg2").className = "col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center border-danger";
                document.getElementById("addImg3").className = "col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center border-danger";
                document.getElementById("addImg4").className = "col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center border-danger";

            } else if (txt == "success") {
                p_category.className = "form-select shadow-none";
                p_brand.className = "form-select shadow-none";
                p_model.className = "form-select shadow-none";
                p_condition.className = "form-select shadow-none";
                p_colour.className = "form-select shadow-none";
                p_quentity.className = "form-control shadow-none";
                p_size.className = "form-select shadow-none";
                p_price.className = "form-control shadow-none";
                p_dc_cost.className = "form-control shadow-none";
                p_dw_cost.className = "form-control shadow-none";
                p_desc.className = "col-12 p-3";
                p_title.className = "form-control me-3 shadow-none";

                document.getElementById("addImg1").className = "col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center";
                document.getElementById("addImg2").className = "col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center";
                document.getElementById("addImg3").className = "col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center";
                document.getElementById("addImg4").className = "col-12 col-lg-2 border border-2 mx-2 d-flex justify-content-center";

                var toastElList = [].slice.call(document.querySelectorAll('.toast'))
                var toastList = toastElList.map(function(toastEl) {
                    return new bootstrap.Toast(toastEl)
                })
                toastList.forEach(toast => toast.show())

            } else {
                alert(txt);
            }
        }
    }

    rq.open("POST", "addProductProcess.php", true);
    rq.send(form);

}

function seeproductSize() {
    var x = document.getElementById("a_category");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Have Sizes") {
                document.getElementById("p_size_field").className = "col-6 col-lg-3 border-end mt-3 mb-3";
                document.getElementById("p_field").className = "col-6 col-lg-3 border-end mt-3 mb-3";
                document.getElementById("dc_field1").className = "col-6 col-lg-3 border-end mt-3 mb-3";
                document.getElementById("dc_field2").className = "col-6 col-lg-3 mt-4 mt-lg-2 mb-3 pt-2";
                document.getElementById("a_dw_cost").className = "form-control mt-4 mt-lg-0";

            } else if (t == "Havent Sizes") {
                document.getElementById("p_size_field").className = "col-6 col-lg-3 border-end mt-3 mb-3 d-none";
                document.getElementById("p_field").className = "col-6 col-lg-4 border-end mt-3 mb-3";
                document.getElementById("dc_field1").className = "col-6 col-lg-4 border-end mt-3 mb-3";
                document.getElementById("dc_field2").className = "col-10 col-lg-4 mt-0 mt-lg-3 mb-3 offset-1 offset-lg-0";
            }
        }
    }

    r.open("GET", "displaySize.php?id=" + x.value, true);
    r.send();

}

function filter_model() {

    var brand = document.getElementById("a_brand");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("a_model").innerHTML = t;
        }
    }

    r.open("GET", "loadModel.php?b=" + brand.value, true);
    r.send();

}

function updateProduct(pid) {

    window.location = "updateProduct.php?id=" + pid;

}


function updateProductChange() {
    var img_ch = document.getElementById("imgP");

    img_ch.onchange = function() {
        var file_count = img_ch.files.length;

        if (file_count <= 4) {

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);
                document.getElementById("u_img" + x).src = url;
            }
        }

    }

}


function updateProductDetails(id) {
    var qty = document.getElementById("p_qty");
    var dc = document.getElementById("d_cost_colombo");
    var doc = document.getElementById("d_cost_other");
    var desc = document.getElementById("p_desc");
    var title = document.getElementById("p_title");

    var f = new FormData();
    f.append("q", qty.value);
    f.append("dc", dc.value);
    f.append("do", doc.value);
    f.append("decs", desc.value);
    f.append("t", title.value);
    f.append("id", id);

    var imgChooser = document.getElementById("imgP");
    var file_count = imgChooser.files.length;

    for (var x = 0; x < file_count; x++) {
        f.append("i" + x, imgChooser.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Invalid Image Count") {
                qty.className = "form-control shadow-none";
                dc.className = "form-control shadow-none";
                doc.className = "form-control shadow-none";
                desc.className = "col-12 p-3 shadow-none";
                title.className = "form-control shadow-none";

                document.getElementById("img1").className = "col-12 col-lg-2 border border-danger border-2 mx-2 d-flex justify-content-center";
                document.getElementById("img2").className = "col-12 col-lg-2 border border-danger border-2 mx-2 d-flex justify-content-center";
                document.getElementById("img3").className = "col-12 col-lg-2 border border-danger border-2 mx-2 d-flex justify-content-center";
                document.getElementById("img4").className = "col-12 col-lg-2 border border-danger border-2 mx-2 d-flex justify-content-center";

            } else if (t == "error") {
                qty.className = "form-control shadow-none is-invalid";
                dc.className = "form-control shadow-none is-invalid";
                doc.className = "form-control shadow-none is-invalid";
                desc.className = "col-12 p-3 shadow-none border-danger";
                title.className = "form-control shadow-none is-invalid";
            } else if (t == "success") {
                qty.className = "form-control shadow-none";
                dc.className = "form-control shadow-none";
                doc.className = "form-control shadow-none";
                desc.className = "col-12 p-3 shadow-none";
                title.className = "form-control shadow-none";

                document.getElementById("img1").className = "col-12 col-lg-2 border  border-2 mx-2 d-flex justify-content-center";
                document.getElementById("img2").className = "col-12 col-lg-2 border  border-2 mx-2 d-flex justify-content-center";
                document.getElementById("img3").className = "col-12 col-lg-2 border  border-2 mx-2 d-flex justify-content-center";
                document.getElementById("img4").className = "col-12 col-lg-2 border  border-2 mx-2 d-flex justify-content-center";

                var toastElList = [].slice.call(document.querySelectorAll('.toast'))
                var toastList = toastElList.map(function(toastEl) {
                    return new bootstrap.Toast(toastEl)
                })
                toastList.forEach(toast => toast.show())

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateProcess.php", true);
    r.send(f);

}

function ProductActive(number, pid) {
    var active_btn = document.getElementById("activeProduct" + number);
    var active_number;

    if (active_btn.checked) {
        active_number = 1;

    } else {
        active_number = 2;
    }

    var rq = new XMLHttpRequest();

    rq.onreadystatechange = function() {
        if (rq.readyState == 4) {
            var t = rq.responseText;

            if (t == "product Successfully Deactivated") {
                document.getElementById("toastText").innerHTML = t;

                var toastElList = [].slice.call(document.querySelectorAll('.toast'))
                var toastList = toastElList.map(function(toastEl) {
                    return new bootstrap.Toast(toastEl)
                })
                toastList.forEach(toast => toast.show());

            } else if (t == "product Successfully Activated") {
                document.getElementById("toastText").innerHTML = t;

                var toastElList = [].slice.call(document.querySelectorAll('.toast'))
                var toastList = toastElList.map(function(toastEl) {
                    return new bootstrap.Toast(toastEl)
                })
                toastList.forEach(toast => toast.show());

            } else if (t == "Somthing Went Wrong") {
                window.location.reload();

            } else {
                alert(t);
                window.location.reload();
            }

        }
    }


    rq.open("GET", "productActiveProcess.php?c=" + active_number + "&id=" + pid, true);
    rq.send();

}

function activeDeactiveP() {
    window.location = "ActivedeactiveProducts.php";
}

function productMethod() {
    var s_bar = document.getElementById("ad_product_search");
    var s_select = document.getElementById("ad_product_method");
    var idntifier;

    if (s_bar.value.length == 0 && s_select.value == 0) {
        window.location.reload();

    } else {

        var f = new FormData;
        if (s_bar.value.length == 0 && s_select.value != 0) {
            f.append("m", s_select.value);
            idntifier = 1;
            f.append("i", idntifier);

        } else if (s_bar.value.length != 0 && s_select.value == 0) {
            f.append("s", s_bar.value);
            idntifier = 2;
            f.append("i", idntifier);

        } else if (s_bar.value.length != 0 && s_select.value != 0) {
            f.append("m", s_select.value);
            f.append("s", s_bar.value);
            idntifier = 3;
            f.append("i", idntifier);

        }

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                document.getElementById("showProductCards").innerHTML = t;
            }
        }
        r.open("POST", "activeDeactivePageProcess.php", true);
        r.send(f);

    }
}

function SearchSellerStoreProducts() {
    window.location = "searchSellerStore.php"
}

function paginationSearch(x) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("loadProducts").innerHTML = t;
        }
    }

    r.open("GET", "ProductLoadPaginationProcess.php?page=" + x, true);
    r.send();
}

function sellerFilterbrand() {
    var brand = document.getElementById("brand").value

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("model").innerHTML = t;
        }
    }

    r.open("GET", "loadSellerBrand.php?b=" + brand, true);
    r.send();

}

function sellerProductfiter(x) {

    var bar = document.getElementById("search_bar");
    var c_brandnew = document.getElementById("brandnew");
    var brandnew_condition;

    if (c_brandnew.checked) {
        brandnew_condition = 1;

    } else {
        brandnew_condition = 2;

    }

    var c_used = document.getElementById("used");
    var used_condition;

    if (c_used.checked) {
        used_condition = 1;

    } else {
        used_condition = 2;

    }

    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var colour = document.getElementById("colour");
    var qty = document.getElementById("quentity");
    var priceto = document.getElementById("priceTo");
    var pricefrom = document.getElementById("PriceFrom");

    var f = new FormData();
    f.append("s_bar", bar.value);
    f.append("brndnw", brandnew_condition);
    f.append("u", used_condition);
    f.append("c", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("clur", colour.value);
    f.append("qty", qty.value);
    f.append("to", priceto.value);
    f.append("from", pricefrom.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("loadProducts").innerHTML = t;
        }
    }

    r.open("POST", "allFilterMethods.php", true);
    r.send(f);
}

function EraseFilterSearchText() {
    var tsxtfield = document.getElementById("search_bar");

    if (tsxtfield.value.length > 0) {
        tsxtfield.value = null;
    }

}

var dm;

function viewDeleteModel() {
    var m = document.getElementById("deleteModel");
    dm = new bootstrap.Modal(m);
    dm.show();
}

function deleteItem(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                dm.hide();
                window.location = "sellerpanel.php";
            }
        }
    }
    r.open("GET", "DeleteSellerProduct.php?id=" + id, true);
    r.send();

}

function showdetails() {
    var details = document.getElementById("showdetails_S");
    var Nic = document.getElementById("NicSellerDetails_s");
    var details_btn = document.getElementById("show_d_btn");
    var Nic_btn = document.getElementById("Show_NIC_btn");

    Nic.classList = "row px-2 d-none";
    details_btn.classList = "col-6 cursor rounded-top slide_01_bg";
    Nic_btn.classList = "col-6 cursor rounded-top slidebtn01_bg";
    details.classList = "row px-2";
}

function showNic() {
    var details = document.getElementById("showdetails_S");
    var Nic = document.getElementById("NicSellerDetails_s");
    var details_btn = document.getElementById("show_d_btn");
    var Nic_btn = document.getElementById("Show_NIC_btn");

    Nic.classList = "row px-2";
    details_btn.classList = "col-6 cursor rounded-top slidebtn01_bg";
    Nic_btn.classList = "col-6 cursor rounded-top slide_01_bg";
    details.classList = "row px-2 d-none";
}

function updateProfileImage() {
    var img_chooser = document.getElementById("editProfileImg");
    var img_view = document.getElementById("viewImg");

    img_chooser.onchange = function() {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        img_view.src = url;
    }

}

function updateSellerProfile() {

    var Shop_name = document.getElementById("shopName");
    var image = document.getElementById("editProfileImg");

    var f = new FormData();
    f.append("s", Shop_name.value);

    if (image.files.length != 0) {
        f.append("sellerimage", image.files[0]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location.reload();
            }
        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);

}

function goToSingleProductVeiw(pid) {
    var reviews = 1;
    window.location = "singleProductVeiw.php?pid=" + pid + "&s=" + reviews;
}

var sm;
var si;

function payNow(id) {

    var b_qty = document.getElementById("buy_qty");


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            var obj = JSON.parse(t);

            var email = obj["email"];
            var amount = obj["amount"];

            if (t == "1") {
                var m = document.getElementById("editProfile");
                sm = new bootstrap.Modal(m);
                sm.show();

            } else {

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(orderId, id, email, amount, b_qty);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221574", // Replace your Merchant ID
                    "return_url": "http://localhost/e-mart/singleProductVeiw.php?pid=" + id + "&s=1", // Important
                    "cancel_url": "http://localhost/e-mart/singleProductVeiw.php?pid=" + id + "&s=1", // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": obj["email"],
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function(e) {
                payhere.startPayment(payment);
                // };

            }

        }
    }
    r.open("GET", "buyNowProcess.php?pid=" + id + "&q=" + b_qty.value, true);
    r.send();

}


function saveInvoice(orderId, id, user_email, amount, qty) {

    var form = new FormData();
    form.append("o", orderId);
    form.append("i", id);
    form.append("u", user_email);
    form.append("a", amount);
    form.append("q", qty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveInvoice.php", true);
    r.send(form);

}


function printInvoice() {

    var restorepage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;

}

function sendAsEmail() {

    var content = document.getElementById("page");

    var f = new FormData();
    f.append("c", content.innerHTML);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var txt = r.responseText;

            document.getElementById("invoicecoastText").innerHTML = txt;

            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl)
            })
            toastList.forEach(toast => toast.show());

        }
    }

    r.open("POST", "sendInvoiceEmail.php", true);
    r.send(f);

}

function imageLoder() {
    var bigImg = document.getElementById("digImg");
    var subImg1 = document.getElementById("img2").src;

    bigImg.style.backgroundImage = "url(" + subImg1 + ")";

}

function deleteFromPurchasedHistory(in_id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location.reload();
            }
        }
    }

    r.open("GET", "deleteFromPurchasedHistory.php?id=" + in_id, true);
    r.send();

}

function deleteALLpurchesedItems() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success Update") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "deletePurchasedItems.php", true);
    r.send();
}


function searchPurchasedHistoryitems() {

    var search = document.getElementById("purchased_S").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("purchesedItemView").innerHTML = t;

        }
    }

    r.open("GET", "searchPurchasedItems.php?i=" + search, true);
    r.send();


}

var fm;

function feedbackModel(in_id) {
    var m = document.getElementById("Rate&Feedbacts" + in_id);
    fm = new bootstrap.Modal(m);
    fm.show();
}

function rates1(id) {

    if (document.getElementById("star1" + id).checked) {
        document.getElementById("star1" + id).checked = true;
        document.getElementById("starpic1" + id).className = "bi bi-star-fill";
        document.getElementById("rateText" + id).className = "fw-bold text-danger";
        document.getElementById("rateText" + id).innerHTML = "Bad";

    } else {
        document.getElementById("starpic1" + id).className = "bi bi-star";
        document.getElementById("starpic2" + id).className = "bi bi-star";
        document.getElementById("star2" + id).checked = false;
        document.getElementById("starpic3" + id).className = "bi bi-star";
        document.getElementById("star3" + id).checked = false;
        document.getElementById("starpic4" + id).className = "bi bi-star";
        document.getElementById("star4" + id).checked = false;
        document.getElementById("rateText" + id).className = "fw-bold ";
        document.getElementById("rateText" + id).innerHTML = "";
    }

}

function rates2(id) {

    if (document.getElementById("star2" + id).checked) {
        document.getElementById("star1" + id).checked = true;
        document.getElementById("starpic1" + id).className = "bi bi-star-fill";
        document.getElementById("star2" + id).checked = true;
        document.getElementById("starpic2" + id).className = "bi bi-star-fill";
        document.getElementById("rateText" + id).className = "fw-bold";
        document.getElementById("rateText" + id).innerHTML = "Good";

    } else {
        document.getElementById("starpic2" + id).className = "bi bi-star";
        document.getElementById("starpic3" + id).className = "bi bi-star";
        document.getElementById("star3" + id).checked = false;
        document.getElementById("starpic4" + id).className = "bi bi-star";
        document.getElementById("star4" + id).checked = false;
        document.getElementById("rateText" + id).className = "fw-bold text-danger";
        document.getElementById("rateText" + id).innerHTML = "Bad";
    }

}

function rates3(id) {

    if (document.getElementById("star3" + id).checked) {
        document.getElementById("starpic3" + id).className = "bi bi-star-fill";
        document.getElementById("star1" + id).checked = true;
        document.getElementById("starpic1" + id).className = "bi bi-star-fill";
        document.getElementById("star2" + id).checked = true;
        document.getElementById("starpic2" + id).className = "bi bi-star-fill";
        document.getElementById("rateText" + id).className = "fw-bold text-info";
        document.getElementById("rateText" + id).innerHTML = "Very Good";


    } else {
        document.getElementById("starpic3" + id).className = "bi bi-star";
        document.getElementById("starpic4" + id).className = "bi bi-star";
        document.getElementById("star4" + id).checked = false;
        document.getElementById("rateText" + id).className = "fw-bold";
        document.getElementById("rateText" + id).innerHTML = "Good";
    }

}


function rates4(id) {

    if (document.getElementById("star4" + id).checked) {
        document.getElementById("starpic4" + id).className = "bi bi-star-fill";
        document.getElementById("star1" + id).checked = true;
        document.getElementById("starpic1" + id).className = "bi bi-star-fill";
        document.getElementById("star2" + id).checked = true;
        document.getElementById("starpic2" + id).className = "bi bi-star-fill";
        document.getElementById("star3" + id).checked = true;
        document.getElementById("starpic3" + id).className = "bi bi-star-fill";
        document.getElementById("rateText" + id).className = "fw-bold text-success";
        document.getElementById("rateText" + id).innerHTML = "Excelent";

    } else {
        document.getElementById("starpic4" + id).className = "bi bi-star";
        document.getElementById("rateText" + id).className = "fw-bold text-info";
        document.getElementById("rateText" + id).innerHTML = "Very Good";
    }

}

function sendFeedBacks(id, pid) {
    var ftxt = document.getElementById("f_text" + id);
    var star_01 = document.getElementById("star1" + id).checked;
    var star_02 = document.getElementById("star2" + id).checked;
    var star_03 = document.getElementById("star3" + id).checked;
    var star_04 = document.getElementById("star4" + id).checked;

    var star_rate;

    if (star_01 == true) {
        star_rate = 1;
        if (star_01 == true && star_02 == true) {
            star_rate = 2;
            if (star_01 == true && star_02 == true && star_03 == true) {
                star_rate = 3;
                if (star_01 == true && star_02 == true && star_03 == true && star_04 == true) {
                    star_rate = 4;
                }
            }
        }
    }

    var f = new FormData();
    f.append("r", star_rate);
    f.append("f", ftxt.value);
    f.append("i", pid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                fm.hide();
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "sendFeddbackProcess.php", true);
    r.send(f);

}

var rm;

function showAllRates(id) {
    var m = document.getElementById("rate_model" + id);
    rm = new bootstrap.Modal(m);
    rm.show();
}

function addToCart(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Successfully Update This Product Quentity" || t == "Allready Applied Maximum Quentity" || t == "Successfully Insert From Cart") {
                document.getElementById("toastCbody").innerHTML = t;
                const toastLiveExample = document.getElementById('liveToast')
                const toast = new bootstrap.Toast(toastLiveExample)
                toast.show()

            }

        }
    }

    r.open("GET", "addToCartProcess.php?i=" + id, true);
    r.send();
}

function cartQtyPlus(id, method) {

    var plus_qty = document.getElementById("p_quentity" + id);
    var f = new FormData();

    if (method == 1) {
        var status = 1;
        f.append("i", id);
        f.append("q", plus_qty.value);
        f.append("s", status);

    } else if (method == 2) {
        var status = 2;
        f.append("id", id);
        f.append("qty", plus_qty.value);
        f.append("s", status);
    }


    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("p_quentity" + id).value = t;
            window.location.reload();


        }
    }

    r.open("POST", "cartProductQTYProcess.php", true);
    r.send(f);
}

function searchFromCart() {
    var c_searchBar = document.getElementById("cartP_search");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("loadProductfromcart").innerHTML = t;

        }
    }

    r.open("GET", "searchCartProduct.php?txt=" + c_searchBar.value, true);
    r.send();

}

function removeFromProduct(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location.reload();
            }

        }
    }

    r.open("GET", "productRemoveFromCart.php?id=" + id, true);
    r.send();

}

function loadSearchCategory() {
    var category = document.getElementById("category01");
    window.location = "searchProduct.php?c=" + category.value;

}


function SearchPRoductfilter() {

    var SearchBar = document.getElementById("searchProduct");
    var category = document.getElementById("category01");
    var colour = document.getElementById("colourFilter");
    var price_to = document.getElementById("pt");
    var price_from = document.getElementById("pf");

    var condition = 0;
    var quentity = 0;

    // condition
    if (document.getElementById("Bn").checked && document.getElementById("Us").checked) {
        condition = 1;

    } else if (document.getElementById("Bn").checked) {
        condition = 2;

    } else if (document.getElementById("Us").checked) {
        condition = 3;

    }
    // condition

    // quentity
    if (document.getElementById("Hl").checked) {
        quentity = 1;

    } else if (document.getElementById("Lh").checked) {
        quentity = 2;

    }
    // quentity



    var f = new FormData();
    f.append("s", SearchBar.value);
    f.append("cat", category.value);
    f.append("c", condition);
    f.append("clr", colour.value);
    f.append("q", quentity);
    f.append("t", price_to.value);
    f.append("f", price_from.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("loadSearchProductDiv").innerHTML = t;
        }
    }

    r.open("POST", "searchProductFilter.php", true);
    r.send(f);

}

function SearchPRoducttxt() {

    var t = document.getElementById("searchProduct").value;

    window.location = "searchProduct.php?txt=" + t;

}

function loadAmodels() {
    var brand = document.getElementById("p_brand").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("p_model").innerHTML = t;
        }
    }

    r.open("GET", "loadAdvacedModel.php?b=" + brand, true);
    r.send();

}

function showSize() {

    if (document.getElementById("p_category").value == 2) {
        document.getElementById("siziDiv").className = "col-4 col-md-3 mt-3 border-end";
        document.getElementById("SearchbarDIV").className = "col-9 col-md-6 offset-3 offset-md-3 mt-3 mt-md-5";
    }

}

function AdvancedSearch() {

    var category = document.getElementById("p_category");
    var brand = document.getElementById("p_brand");
    var model = document.getElementById("p_model");
    var colour = document.getElementById("p_colour");
    var condition = document.getElementById("p_condition");
    var quentity = document.getElementById("p_qty");
    var price_to = document.getElementById("p_priceto");
    var price_from = document.getElementById("p_pricefrom");
    var size = document.getElementById("p_size");
    var text = document.getElementById("p_searchtxt");

    var f = new FormData();
    f.append("ca", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("clr", colour.value);
    f.append("con", condition.value);
    f.append("q", quentity.value);
    f.append("pt", price_to.value);
    f.append("pf", price_from.value);
    f.append("r", size.value);
    f.append("t", text.value);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("veiw_resultDIV").innerHTML = t;
        }
    }

    r.open("POST", "advanceSearchProcess.php", true);
    r.send(f);

}

function addToWatchList(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Successfully add to Watchlist ...." || t == "This Product Already Exist In Watchlist ....") {
                document.getElementById("toastCbody").innerHTML = t;
                const toastLiveExample = document.getElementById('liveToast')
                const toast = new bootstrap.Toast(toastLiveExample)
                toast.show()

            }

        }
    }

    r.open("GET", "addToWatchListProcess.php?i=" + id, true);
    r.send();

}

function removeFromWatchlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {
                window.location.reload();
            }

        }
    }

    r.open("GET", "removeFromWatchListProcess.php?i=" + id, true);
    r.send();
}

function searchfromwatchlist() {
    var txt = document.getElementById("watchlistbar").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("watchlistresulDIV").innerHTML = t;

        }
    }

    r.open("GET", "SearchFromWatchListProcess.php?t=" + txt, true);
    r.send();
}

function AddColour() {
    var txt = document.getElementById("addColourbar");

    if (txt.value.length > 1) {
        txt.className = "form-control";
        var r = new XMLHttpRequest();

        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == "This Colour Already Exist ....") {
                    document.getElementById("toastCbody").innerHTML = t;
                    const toastLiveExample = document.getElementById('liveToastcolour')
                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show();

                } else {
                    document.getElementById("a_colour").innerHTML = t;
                    txt.value = " ";
                    const toastLiveExample = document.getElementById('liveToastcolour')
                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show();
                }

            }
        }

        r.open("GET", "AddColourProcess.php?t=" + txt.value, true);
        r.send();
    } else {
        txt.className = "form-control is-invalid";
    }

}

function sendInquiries() {
    var text = document.getElementById("in_text");

    if (text.value.length > 1) {

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                text.value = null;
                document.getElementById("viewInquieryMSG").innerHTML = t;
            }
        }

        r.open("GET", "sendInquiryProcess.php?c=" + text.value, true);
        r.send();

    }

}

function sendSellerMSG(nic) {
    var content = document.getElementById("sendMSGS" + nic);

    if (content.value.length > 1) {
        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == "success") {
                    content.value = null;
                    window.location.reload();

                }
            }
        }

        r.open("GET", "sendMSGSeller.php?c=" + content.value + "&n=" + nic, true);
        r.send();
    }

}

function loadMSGUser(nic) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("massageappendDIV").innerHTML = t;
        }
    }

    r.open("GET", "loadMSGuserview.php?n=" + nic, true);
    r.send();
}

function loadMSGSeller(email) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("massageappendDIV").innerHTML = t;
        }
    }

    r.open("GET", "loadMSGSellerview.php?e=" + email, true);
    r.send();
}

function senduserMSG(email) {
    var content = document.getElementById("sendMSGS" + email);

    if (content.value.length > 1) {
        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                if (t == "success") {
                    content.value = null;
                    window.location.reload();

                }
            }
        }

        r.open("GET", "sendMSGuser.php?c=" + content.value + "&e=" + email, true);
        r.send();
    }

}
var a_email = document.getElementById("admin_email");
var a_password = document.getElementById("admin_password");
var a_v;

function logAdmin() {

    var f = new FormData();
    f.append("ae", a_email.value);
    f.append("ap", a_password.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Invalid Email Or Password ???") {
                a_email.className = "form-control shadow-none is-invalid";
                a_password.className = "form-control shadow-none is-invalid";
                document.getElementById("signup-msg2").innerHTML = "&nbsp;&nbsp;" + t;
                document.getElementById("errormsg1").className = "col-12";

            } else if (t == "Verification Code Successfully Send Your Email") {
                var m = document.getElementById("a_vcode_verify");
                a_v = new bootstrap.Modal(m);
                a_v.show();

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "adminSignProcess.php", true);
    r.send(f);

}

function check_admin_vcode() {
    vcode = document.getElementById("a-vcode");

    var f = new FormData();
    f.append("v", vcode.value);
    f.append("a", a_email.value);
    f.append("p", a_password.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                a_v.hide();
                window.location = "adminPanal.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "adminverifyCodeProcess.php", true);
    r.send(f);

}

function showDiff() {
    var date1 = new Date("2022/10/12 06:59:00");
    var date2 = new Date();
    //Customise date2 for your required future time

    var diff = (date2 - date1) / 1000;
    var diff = Math.abs(Math.floor(diff));

    var years = Math.floor(diff / (365 * 24 * 60 * 60));
    var leftSec = diff - years * 365 * 24 * 60 * 60;

    var month = Math.floor(leftSec / ((365 / 12) * 24 * 60 * 60));
    var leftSec = leftSec - month * (365 / 12) * 24 * 60 * 60;

    var days = Math.floor(leftSec / (24 * 60 * 60));
    var leftSec = leftSec - days * 24 * 60 * 60;

    var hrs = Math.floor(leftSec / (60 * 60));
    var leftSec = leftSec - hrs * 60 * 60;

    var min = Math.floor(leftSec / (60));
    var leftSec = leftSec - min * 60;

    document.getElementById("showTime").innerHTML = "Emart Start At Since ( [Y]" + years + " - [M]" + month + " - [D]" + days + " )  " + hrs + " : " + min + " : " + leftSec + " Ago.";

    setTimeout(showDiff, 1000);

}


function block_Unblock_Users(email) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deactived") {
                document.getElementById("b&Ubtn" + email).className = "btn btn-success";
                document.getElementById("b&Ubtn" + email).innerHTML = "Unblock";

            } else if (t == "Activated") {
                document.getElementById("b&Ubtn" + email).className = "btn btn-danger";
                document.getElementById("b&Ubtn" + email).innerHTML = "Block";

            }
        }
    }

    r.open("GET", "userBlockUnblockProcess.php?e=" + email, true);
    r.send();
}

var um;

function ShowFullUserDetails(email) {

    var m = document.getElementById("uerModel" + email);
    um = new bootstrap.Modal(m);
    um.show();

}

function SearchAdminUsers(status) {
    var email = document.getElementById("u_MobileEmail");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("UserdataRows").innerHTML = t;

        }
    }

    r.open("GET", "adminSearchUsers.php?e=" + email.value + "&s=" + status, true);
    r.send();
}

function redirectAdminUser() {
    var select = document.getElementById("pageValue");

    if (select.value == 2 || select.value == 3) {
        window.location = "adminManageUsers.php?s=" + select.value;
    }
}

function Sblock_Unblock_Users(nic) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deactived") {
                document.getElementById("seller_b&Ubtn" + nic).className = "btn btn-success";
                document.getElementById("seller_b&Ubtn" + nic).innerHTML = "Unblock";

            } else if (t == "Activated") {
                document.getElementById("seller_b&Ubtn" + nic).className = "btn btn-danger";
                document.getElementById("seller_b&Ubtn" + nic).innerHTML = "Block";

            }
        }
    }

    r.open("GET", "SellerBlockUnblockProcess.php?n=" + nic, true);
    r.send();
}

var sm;

function sellerfullDetails(nic) {
    var s_model = document.getElementById("SellerModel" + nic);
    sm = new bootstrap.Modal(s_model);
    sm.show();

}

function sellerredirect() {
    var s_select = document.getElementById("selectcount");

    if (s_select.value == 2 || s_select.value == 3) {
        window.location = "adminManageSellers.php?s=" + s_select.value;
    }

}

function adminSearchSeller(status) {
    var nic = document.getElementById("adminSearchsellernic");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("contentFullDetails").innerHTML = t;

        }
    }

    r.open("GET", "adminSearchSellers.php?n=" + nic.value + "&s=" + status, true);
    r.send();
}


var pm;

function veiwFullProductDetails(id) {
    var product_m = document.getElementById("ProductModel" + id);
    pm = new bootstrap.Modal(product_m);
    pm.show();
}

function block_Unblock_Product(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deactived") {
                document.getElementById("Productb&Ubtn" + id).className = "btn btn-success";
                document.getElementById("Productb&Ubtn" + id).innerHTML = "Unblock";

            } else if (t == "Activated") {
                document.getElementById("Productb&Ubtn" + id).className = "btn btn-danger";
                document.getElementById("Productb&Ubtn" + id).innerHTML = "Block";

            }
        }
    }

    r.open("GET", "ProductBlockUnblockProcess.php?i=" + id, true);
    r.send();
}

function redirectProducts() {
    var select = document.getElementById("selectPproductStatus");

    if (select.value == 2 || select.value == 3) {
        window.location = "adminManageProducts.php?s=" + select.value;
    }
}


function SearchAdminproduct(status) {
    var id = document.getElementById("searchProductAdmin");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("ProductSearchveiw").innerHTML = t;

        }
    }

    r.open("GET", "adminSearchProducts.php?i=" + id.value + "&s=" + status, true);
    r.send();
}

var sellingHS;

function viewSELLERDetails(nic) {
    var seller = document.getElementById("SellinghistorysellerModel" + nic);
    sellingHS = new bootstrap.Modal(seller);
    sellingHS.show();
}

var sellingHP;

function SellingHProductView(id) {
    var seller = document.getElementById("SellingProductModel" + id);
    sellingHS = new bootstrap.Modal(seller);
    sellingHP = new bootstrap.Modal(seller);
    sellingHP.show();
}

var sbd;

function VeiwBuyeSellingHistory(email) {
    var user = document.getElementById("SellingHuerModel" + email);
    sbd = new bootstrap.Modal(user);
    sbd = new bootstrap.Modal(user);
    sbd.show();
}

function changeSellingStatus(inID) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 0) {
                document.getElementById("btn" + inID).innerHTML = "Confirm Order";
                document.getElementById("btn" + inID).className = "btn btn-success fw-bold mt-1 mb-1";

            } else if (t == 1) {
                document.getElementById("btn" + inID).innerHTML = "Packing";
                document.getElementById("btn" + inID).className = "fw-bold mt-1 mb-1 btn btn-warning";

            } else if (t == 2) {
                document.getElementById("btn" + inID).innerHTML = "Dispatch";
                document.getElementById("btn" + inID).className = "btn btn-info fw-bold mt-1 mb-1";

            } else if (t == 3) {
                document.getElementById("btn" + inID).innerHTML = "Shipping";
                document.getElementById("btn" + inID).className = "btn btn-primary fw-bold mt-1 mb-1";

            } else if (t == 4) {
                document.getElementById("btn" + inID).innerHTML = "Delivered";
                document.getElementById("btn" + inID).className = "btn btn-danger fw-bold mt-1 mb-1 disabled";

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "changeSellerStatus.php?id=" + inID, true);
    r.send();

}

function searchSellingHistory() {

    var id = document.getElementById("SearchsellingHId");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("SellingHistorydataRows").innerHTML = t;

        }
    }

    r.open("GET", "searchSellingHistory.php?id=" + id.value, true);
    r.send();
}

var msg_m;

function showFullMSGUser(email) {
    var m = document.getElementById("uerMSGModel" + email);
    msg_m = new bootstrap.Modal(m);
    msg_m.show();

}

var msgadmin;

function veiwMSGContentAdmin(e) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                var Msg = document.getElementById("veiwMSGadmin" + e);
                msgadmin = new bootstrap.Modal(Msg);
                msgadmin.show();
            }
            alert(t);
        }
    }

    r.open("GET", "SetMsgStatus.php?e=" + e, true);
    r.send();

}

function sendMsgToUser(email) {
    var content = document.getElementById("adminMSGSend" + email);

    if (content.value.length > 1) {
        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                var t = r.responseText;
                document.getElementById("loadSendInquieryMSG" + email).innerHTML = t;

            }
        }

        r.open("GET", "SendMsgTOUser.php?c=" + content.value + "&e=" + email, true);
        r.send();
    }

}

var sd;

function UserSellerDetails(nic) {

    var m = document.getElementById("requestSeller" + nic);
    sd = new bootstrap.Modal(m);
    sd.show();
}
var sid;

function veiwSellerNicImages(nic) {

    var m = document.getElementById("requestSellerNICImages" + nic);
    sid = new bootstrap.Modal(m);
    sid.show();
}

function acceptSellerReqquest(nic) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t = "succcess") {
                window.location.reload();
            }

        }
    }

    r.open("GET", "AcceptSellerRequenst.php?n=" + nic, true);
    r.send();
}

function RejectSellerReqquest(nic) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t = "succcess") {
                window.location.reload();
            }

        }
    }

    r.open("GET", "RejectSellerRequenst.php?n=" + nic, true);
    r.send();
}

var s_fogot_m;

function showSellerForgotPasswordModal() {
    var m = document.getElementById("sellerForgotPassword");
    s_fogot_m = new bootstrap.Modal(m);
    s_fogot_m.show();
}

function sellerforgotPasswordModel() {
    var nic = document.getElementById("sellerNic");

    var f = new FormData();
    f.append("n", nic.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "invalid NIC No ???" || t == "Verification code sending failed ???") {
                document.getElementById("alertTextSeller").innerHTML = t;
                document.getElementById("alertsellerforgot").className = "alert alert-danger mt-2";

            } else if (t == "Verification Code Successfully Send Your User Email") {
                document.getElementById("alertsellerforgot").className = "alert alert-danger mt-2 d-none";
                document.getElementById("showSellerverifyNIC").className = "btn btn-primary d-none";
                document.getElementById("showSellerverificationCode").className = "btn btn-primary";
                document.getElementById("sendVcodeSeller").className = "col-12 mt-2";
                document.getElementById("sendnewSeller").className = "col-12 mt-2";
                document.getElementById("sendconformSeller").className = "col-12 mt-2";
                document.getElementById("successText").innerHTML = t;
            }
        }
    }

    r.open("POST", "sellerforgotPassword.php", true);
    r.send(f);

}

function sellerverificationCode() {
    var code = document.getElementById("sellerverificationCode");
    var nic = document.getElementById("sellerNic");
    var nP = document.getElementById("seller_NP");
    var cP = document.getElementById("seller_CP");

    var f = new FormData();
    f.append("c", code.value);
    f.append("n", nic.value);
    f.append("np", nP.value);
    f.append("cp", cP.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                document.getElementById("mainsellermDIV").className = "modal-body d-none";
                document.getElementById("SubsellermDIV").className = "modal-body";
                document.getElementById("showSellerverificationCode").className = "btn btn-primary d-none";

            } else if (t == "Enter Passwords ????" || t == "Password Should Have Between 5-20 Charactors ????") {
                document.getElementById("alertTextSeller").innerHTML = t;
                document.getElementById("alertsellerforgot").className = "alert alert-danger mt-2";

            } else if (t == "Password Does Not Matched ????" || t == "Invalid Verification Code") {
                document.getElementById("alertTextSeller").innerHTML = t;
                document.getElementById("alertsellerforgot").className = "alert alert-danger mt-2";
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "sellervrifyVerification.php", true);
    r.send(f);
}