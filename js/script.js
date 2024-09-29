/*This is the js for the sign in - sign up movement of login.php*/
const container = document.getElementById('container');
container.classList.add('right-panel-active');

function showSignUpPanel() {
    container.classList.add('right-panel-active');
}

function showSignInPanel() {
    container.classList.remove('right-panel-active');
}

/*This is the signup process of login.php*/

function signUp() {

    var fn = document.getElementById("fname");
    var ln = document.getElementById("lname");
    var e = document.getElementById("email");
    var pw = document.getElementById("password");
    var rpw = document.getElementById("repassword");
    var m = document.getElementById("mobile");
    var g = document.getElementById("gender");

    var f = new FormData();
    f.append("fname", fn.value);
    f.append("lname", ln.value);
    f.append("email", e.value);
    f.append("password", pw.value);
    f.append("repassword", rpw.value);
    f.append("mobile", m.value);
    f.append("gender", g.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var text = r.responseText;

            if (text == "success") {
                document.getElementById("msg").innerHTML = text;
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";
            } else {
                document.getElementById("msg").innerHTML = text;
                document.getElementById("msgdiv").className = "d-block";
            }

        }
    }

    r.open("POST", "signUpProcess.php", true);
    r.send(f);

}

/*This is the signin process of login.php*/

function signIn() {

    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("rememberme");

    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "index.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "signInProcess.php", true);
    r.send(f);

}

/*This is the js for the visibility of password using checkbox of login.php*/

function showPassword_check() {
    const passwordInput = document.getElementById('password2');
    const showPasswordCheckbox = document.getElementById('show-password-checkbox');

    if (showPasswordCheckbox.checked) {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
}

/*This is the js for the forgot password to send a verification code and the modal to appear in login.php*/

var bm;
function forgotPassword() {

    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                var m = document.getElementById("forgotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}

/*This is the js for the reset password of the modal to in login.php*/

function resetPassword() {

    var email = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    var f = new FormData();
    f.append("e", email.value);
    f.append("np", np.value);
    f.append("rnp", rnp.value);
    f.append("vc", vc.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {

                bm.hide();
                alert("Your password has been changed successfully.\nUse your new password to log in");
                window.location.reload();

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "resetPasswordProcess.php", true);
    r.send(f);

}

function showPassword() {
    var password = document.getElementById("u-password");
    var sipb = document.getElementById("sipb");

    if (password.type === "password") {
        password.type = "text";
        sipb.innerHTML = '<i class="bi bi-eye-slash"></i>';
    } else {
        password.type = "password";
        sipb.innerHTML = '<i class="bi bi-eye"></i>';
    }
}


function showPassword1() {
    var password = document.getElementById("pw");
    var sipb = document.getElementById("pwb");

    if (password.type === "password") {
        password.type = "text";
        sipb.innerHTML = '<i class="bi bi-eye-slash"></i>';
    } else {
        password.type = "password";
        sipb.innerHTML = '<i class="bi bi-eye"></i>';
    }
}

function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {

                // window.location.reload();
                window.location = "login-page.php";

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "signoutProcess.php", true);
    r.send();

}

function updateProfile() {

    var profile_img = document.getElementById("profileImage");
    var first_name = document.getElementById("fname");
    var last_name = document.getElementById("lname");
    var mobile_no = document.getElementById("mobile");
    var password = document.getElementById("pw");
    var email_address = document.getElementById("email");
    var address_line_1 = document.getElementById("line1");
    var address_line_2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var postal_code = document.getElementById("pc");

    var f = new FormData();
    f.append("img", profile_img.files[0]);
    f.append("fn", first_name.value);
    f.append("ln", last_name.value);
    f.append("mn", mobile_no.value);
    f.append("pw", password.value);
    f.append("ea", email_address.value);
    f.append("al1", address_line_1.value);
    f.append("al2", address_line_2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);
    f.append("pc", postal_code.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                signout();
                // window.location = "home.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "userProfileUpdateProcess.php", true);
    r.send(f);

}

function loaDistrict(){
    var province = document.getElementById("province").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("district").innerHTML = t;

        }
    }

    r.open("GET", "loadDistrictProcess.php?c=" + category, true);
    r.send();

}

function loadBrands() {

    var category = document.getElementById("category").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("brand").innerHTML = t;

        }
    }

    r.open("GET", "loadBrandProcess.php?c=" + category, true);
    r.send();

}

function loadModels() {
    var brand = document.getElementById("brand").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            document.getElementById("model").innerHTML = t;
        }
    };
    r.open("GET", "loadModelProcess.php?b=" + brand, true);
    r.send();
}

function changeProductImage(){

    var images = document.getElementById("imageuploader");

    images.onchange = function () {

        var file_count = images.files.length;

        if (file_count <= 2) {

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);
                document.getElementById("i" + x).src = url;
            }

        } else {
            alert(file_count + " files uploaded. You are proceed to upload 02 or less than 02 files.");
        }

    }

}

function addProduct() {

    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");
    var condition = 0;
    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    }
    var clr = document.getElementById("clr");
    var qty = document.getElementById("qty_input");
    var cost = document.getElementById("cost");
    var tags = document.getElementById("tags");
    var spec = document.getElementById("spec");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("ca", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("con", condition);
    f.append("col", clr.value);
    f.append("qty", qty.value);
    f.append("cost", cost.value);
    f.append("tags", tags.value);
    f.append("spec", spec.value);
    f.append("dwc", dwc.value);
    f.append("doc", doc.value);
    f.append("desc", desc.value);

    var file_count = image.files.length;
    for (var x = 0; x < file_count; x++) {
        f.append("img" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

                alert(t);


        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);

}


function changeStatus(id) {

    var product_id = id;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "activated" || t == "deactivated") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "changeStatusProcess.php?p=" + product_id, true);
    r.send();

}


function sort(x) {

    var search = document.getElementById("s");
    var time = "0";

    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2";
    }

    var qty = "0";

    if (document.getElementById("h").checked) {
        qty = "1";
    } else if (document.getElementById("l").checked) {
        qty = "2";
    }

    var condition = "0";

    if (document.getElementById("b").checked) {
        condition = "1";
    } else if (document.getElementById("u").checked) {
        condition = "2";
    }
    document.querySelector('.product__pagination').style.display = 'none';

    var f = new FormData();
    f.append("s", search.value);
    f.append("t", time);
    f.append("q", qty);
    f.append("c", condition);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("sort").innerHTML = t;

        }
    }

    r.open("POST", "sortProcess.php", true);
    r.send(f);

}

function clearSort() {
    window.location.reload();
}

function sendId(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "updateProduct.php";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "sendIdProcess.php?id=" + id, true);
    r.send();

}

function updateProduct() {
    var title = document.getElementById("t");
    var qty = document.getElementById("qty_input");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var description = document.getElementById("d");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("t", title.value);
    f.append("q", qty.value);
    f.append("dwc", dwc.value);
    f.append("doc", doc.value);
    f.append("d", description.value);

    var file_count = image.files.length;
    for (var x = 0; x < file_count; x++) {
        f.append("i" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                window.location = "myProducts.php";
            } else if (t == "Invalid Image Count") {

                if (confirm("Don't you want to update Product Images?") == true) {
                    window.location = "myProducts.php";
                } else {
                    alert("Select images.");
                }
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateProductProcess.php", true);
    r.send(f);
}


function basicSearch(event, x) {
    // Prevent default form submission behavior
    event.preventDefault();

    var text = document.getElementById("kw").value;
    var select = document.getElementById("c").value;

    var f = new FormData();
    f.append("t", text);
    f.append("s", select);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            document.getElementById("search-results").innerHTML = t;
        }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);
}



function advancedSearch(x) {

    var txt = document.getElementById("t");
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var condition = document.getElementById("c2");
    var color = document.getElementById("clr");
    var from = document.getElementById("pf");
    var to = document.getElementById("pt");
    var sort = document.getElementById("s");

    var f = new FormData();

    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("b", brand.value);
    f.append("mo", model.value);
    f.append("con", condition.value);
    f.append("col", color.value);
    f.append("pf", from.value);
    f.append("pt", to.value);
    f.append("s", sort.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("view_area").innerHTML = t;
        }
    }

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(f);

}

function addToCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "This Product Already Exists In The Cart") {
                alert("This Product Already Exists In The Cart");
            } else if (t == "Product Added") {
                alert("Product Added");
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();

}

function removeFromCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "deleted") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "removeFromCartProcess.php?id=" + id, true);
    r.send();

}


function addToWatchlist(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Added") {
                alert("Product added to the watchlist successfully.");
                window.location.reload();
            } else if (t == "Removed") {
                alert("Product removed from watchlist successfully.");
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "addWatchListProcess.php?id=" + id, true);
    r.send();

}

function removeFromWatchlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "removeFromWatchListProcess.php?id=" + id, true);
    r.send();
}


function paynow(pid) {

    var qty = document.getElementById("qty_input").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var umail = obj["umail"];
            var amount = obj["amount"];

            if (t == "address error") {
                alert("Please Update Your Profile.");
                window.location = "userProfile.php";
            } else {

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    window.location = "invoice.php";
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
                    "merchant_id": "1227068",    // Replace your Merchant ID
                    "return_url": "http://localhost/eshop/singleProductView.php?id=" + pid,     // Important
                    "cancel_url": "http://localhost/eshop/singleProductView.php?id=" + pid,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": umail,
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
                // document.getElementById('payhere-payment').onclick = function (e) {
                    payhere.startPayment(payment);
                // };

            }
        }
    }

    r.open("GET", "payNowProcess.php?id=" + pid + "&qty=" + qty, true);
    r.send();

}

var av;
function adminVerification() {
  var email = document.getElementById("admin_email");

  var form = new FormData();
  form.append("e", email.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "Success") {
        // alert(
        //   "Please take a look at your email to find the VERIFICATION CODE."
        // );

        document.getElementById("msg2").innerHTML =
          "Please take a look at your email to find the VERIFICATION CODE.";
        document.getElementById("msg2").className = "alert alert-success";
        document.getElementById("msgdiv2").className = "d-block";

        var adminVerificationModal =
          document.getElementById("verificationModal");
        av = new bootstrap.Modal(adminVerificationModal);
        av.show();
      } else {
        // alert(response);
        document.getElementById("msg2").innerHTML = response;
        document.getElementById("msgdiv2").className = "d-block";
      }
    }
  };
  request.open("POST", "adminVerificationProcess.php", true);
  request.send(form);
}

function verify() {
    var code = document.getElementById("vcode");
  
    var form = new FormData();
    form.append("c", code.value);
  
    var request = new XMLHttpRequest();
  
    request.onreadystatechange = function () {
      if ((request.status == 200) & (request.readyState == 4)) {
        var response = request.responseText;
        if (response == "success") {
          av.hide();
          window.location = "adminDashboard.php";
        } else {
          alert(response);
        }
      }
    };
  
    request.open("POST", "verificationProcess.php", true);
    request.send(form);
}

function LogOut() {
    var request = new XMLHttpRequest();
  
    request.onreadystatechange = function () {
      if ((request.status == 200) & (request.readyState == 4)) {
        var response = request.responseText;
        if (response == "Success") {
          window.location.reload();
        }
      }
    };
    request.open("GET", "LogOutProcess.php", true);
    request.send();
}

function printDiv() {
    // alert("ok");
  
    var originalContent = document.body.innerHTML;
    var printArea = document.getElementById("printArea").innerHTML;
  
    document.body.innerHTML = printArea;
  
    window.print();
  
    document.body.innerHTML = originalContent;

}

function blockProduct(id) {
    var request = new XMLHttpRequest();
  
    request.onreadystatechange = function () {
      if ((request.status == 200) & (request.readyState == 4)) {
        var response = request.responseText;
        // alert(response);
        // window.location.reload();
        swal("Good job!", response, "success").then((value) => {
          swal(`The returned value is: ${value}`);
          window.location.reload();
        });
      }
    };
  
    request.open("GET", "productBlockProcess.php?id=" + id, true);
    request.send();
}

function blockUser(email) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
      if ((request.status == 200) & (request.readyState == 4)) {
        var response = request.responseText;
        // alert(response);
        document.getElementById("msg1").innerHTML = response;
        document.getElementById("msgdiv1").className = "d-block";
        window.location.reload();
      }
    };
    request.open("GET", "userBlockProcess.php?email=" + email, true);
    request.send();
}

function check_value(qty) {
    var input = document.getElementById("qty_input");
  
    if (input.value <= 0) {
      alert("Quantity must be 01 or more.");
      input.value = 1;
    } else if (input.value > qty) {
      alert("Insufficient Quantity.");
      input.value = qty;
    }
  }
  
  function qty_inc(qty) {
    var input = document.getElementById("qty_input");
  
    if (input.value < qty) {
      var newValue = parseInt(input.value) + 1;
      input.value = newValue;
    } else {
      alert("Maximum quantity has achieved.");
      input.value = qty;
    }
  }
  
  function qty_dec() {
    var input = document.getElementById("qty_input");
  
    if (input.value > 1) {
      var newValue = parseInt(input.value) - 1;
      input.value = newValue;
    } else {
      alert("Minimum quantity has achieved.");
      input.value = 1;
    }
  }


function loadChart() {
    var ctx = document.getElementById("myChart");
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
      if ((request.readyState == 4) & (request.status == 200)) {
        var response = request.responseText;
        // alert(response);
        var data = JSON.parse(response);
        new Chart(ctx, {
          type: "doughnut",
          data: {
            labels: data.lables,
            datasets: [
              {
                label: "# Item",
                data: data.data,
                borderWidth: 1,
              },
            ],
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
              },
            },
          },
        });
      }
    };
    request.open("POST", "loadChartProcess.php", true);
    request.send();
}
