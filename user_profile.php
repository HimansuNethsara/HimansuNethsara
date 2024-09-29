<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

	$email = $_SESSION["u"]["email"];

	$details_rs = Database::search("SELECT * FROM `users` INNER JOIN `gender` ON  
									users.gender_id=gender.id WHERE `email`='" . $email . "'");

	$image_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $email . "'");

	$address_rs = Database::search("SELECT * FROM `users_has_address` INNER JOIN `city` ON  
									users_has_address.city_city_id=city.city_id INNER JOIN 
									`district` ON city.district_district_id=district.district_id 
									INNER JOIN `province` ON 
									district.province_province_id=province.province_id 
									WHERE `users_email`='" . $email . "'");

	$details_data = $details_rs->fetch_assoc();
	$image_data = $image_rs->fetch_assoc();
	$address_data = $address_rs->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="eng">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>Trendy_tech | User- Profile</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/logo.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.min.css">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">
	<!-- Fancybox -->
	<link rel="stylesheet" href="css/jquery.fancybox.min.css">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="css/themify-icons.css">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/niceselect.css">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="css/flex-slider.min.css">
	<!-- Slicknav -->
    <link rel="stylesheet" href="css/slicknav.min.css">
	
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        .all-category .main-category {
            display: none;
			
        }

        .all-category:hover .main-category {
            display: block;
        }

        .header.sticky .all-category .main-category {
            display: none;
        }

        .header.sticky .all-category:hover .main-category {
            display: block;
        }
    </style>
	
</head>
<body>
	
	
	<!-- Header -->
	<header class="header shop">
		 <!-- Topbar -->
		 <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            <li><i class="ti-headphone-alt"></i> +94 76-6748088</li>
                            <li><i class="ti-email"></i>
                                <?php
                                if (isset($_SESSION["u"])) {
                                    $session_data = $_SESSION["u"];
                                    echo '<span class="text-lg-start welcome-message"><b style="color: #333;">Welcome ' . $session_data["fname"] . ' ' . $session_data["lname"] . '</b></span> <span class="separator">|</span>
                                        <span class="text-lg-start fw-bold sign-out" onclick="signout();">Sign Out</span> ';
                                } else {
                                    echo '<a href="login-page.php" class="text-decoration-none text-danger fw-bold sign-in-register-link">Sign In or Register</a>';
                                }
                                ?>
                            </li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-7 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                            <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li>
                            <li><i class="ti-user"></i> <a href="user_profile.php">My account</a></li>
                            <?php
                            if (!isset($_SESSION["u"])) {
                                echo '<li><i class="ti-power-off"></i><a href="login.html#">Login</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
						<div class="col-lg-3">
							<div class="all-category">
								<h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
								<ul class="main-category">
									<li><a href="#">New Arrivals <i class="fa fa-angle-right" aria-hidden="true"></i></a>
										<ul class="sub-category">
											<?php
											$category_rs = Database::search("SELECT * FROM `category`");
											$category_num = $category_rs->num_rows;

											for ($x = 0; $x < $category_num; $x++) {
												$category_data = $category_rs->fetch_assoc();
											?>
											<li><a href="#"><?php echo $category_data["cat_name"]; ?></a></li>
											<?php
											}
											?>
										</ul>
									</li>
									<li class="main-mega"><a href="#">best selling <i class="fa fa-angle-right" aria-hidden="true"></i></a>
										<ul class="mega-menu">
											<li class="single-menu">
												<a href="#" class="title-link">Cameras</a>
												<div class="image">
													<img src="images/home-page/camera.jpg" alt="#" >
												</div>
												<div class="inner-link">
													<a href="#">Canon</a>
													<a href="#">Sony</a>
													<a href="#">Nikon</a>
													<a href="#">Fujifilm</a>
												</div>
											</li>
											<li class="single-menu">
												<a href="#" class="title-link">Laptops</a>
												<div class="image">
													<img src="images/home-page/laptop.jpg" alt="#">
												</div>
												<div class="inner-link">
													<a href="#">Asus</a>
													<a href="#">Acer</a>
													<a href="#">Lenovo</a>
													<a href="#">MSI</a>
												</div>
											</li>
											<li class="single-menu">
												<a href="#" class="title-link">Mobile Phones</a>
												<div class="image">
													<img src="images/home-page/iphone.webp" alt="#" >
												</div>
												<div class="inner-link">
													<a href="#">Apple</a>
													<a href="#">Oppo</a>
													<a href="#">Redmi</a>
													<a href="#">Samsung</a>
												</div>
											</li>
										</ul>
									</li>
									<li><a href="#">Top Offers</a></li>
									<li><a href="#">Air Conditioners</a></li>
									<li><a href="#">Computer Accessories</a></li>
									<li><a href="#">Cameras</a></li>
									<li><a href="#">Laptops</a></li>
									<li><a href="#">Mobile Phones</a></li>
									<li><a href="#">Refrigerators</a></li>
									<li><a href="#">TV </a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-9 col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">	
										<div class="nav-inner">	
											<ul class="nav main-menu menu navbar-nav">
													<li class="active"><a href="index.php">Home</a></li>
													<li><a href="advancedSearch.php">Advance Search</a></li>												
													<li><a href="#">Service<i class="ti-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="#"><img src="images/header/chat_with_us.png" class="header-dicon"/>Chat with Us</a></li>
															<li><a href="#"><img src="images/header/order.png" class="header-dicon"/>Order</a></li>
															<li><a href="#"><img src="images/header/delivery.png" class="header-dicon"/>Shipping and Delivery</a></li>
															<li><a href="#"><img src="images/header/refund.svg" class="header-dicon"/>Returns and Refunds</a></li>
														</ul>
													</li>
													<li><a href="#">Shop<i class="ti-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="cart.php"><img src="images/header/cart.png" class="header-dicon"/>Cart</a></li>
															<li><a href="#"><img src="images/header/checkout.png" class="header-dicon"/>Checkout</a></li>
														</ul>
													</li>
																					
													<li><a href="adminSignin.php">Admin Panel</a></li>
													<li><a href="#">Contact Us</a></li>
													<li><a href="#">Advanced Options<i class="ti-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="addProduct.php"><img src="images/header/add_product.png" class="header-dicon"/>Add New Product</a></li>
															<li><a href="myProducts.php"><img src="images/header/product.png" class="header-dicon"/>My Products</a></li>
															<li><a href="#"><img src="images/header/sell-product.svg" class="header-dicon"/>My Sellings</a></li>
															<li><a href="#"><img src="images/header/history.png" class="header-dicon"/>Purchased History</a></li>
														</ul>
													</li>
												</ul>
										</div>
									</div>
								</nav>
								<!--/ End Main Menu -->	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!--/ End Header -->

	<div class="container-xl px-4 mt-4">
                    <div class="row">

                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <h4 class="title02 fw-bold" style="font-size: 25px;">Profile Settings</h4>
                        </div>
                        <hr class="mt-0 mb-4">

                        <div class="col-12 bg-body mt-4 mb-4">
                            <div class="row g-2">

                                <div class="col-md-3 border-end">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                        <br/><br/><br/>
                                        <?php

                                        if (empty($image_data["path"])) {
                                        ?>
                                            <img src="resources/user/profile_img.svg" class="rounded mt-5" style="width:300px; height:auto" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $image_data["path"]; ?>" class="rounded mt-5" style="width:300px; height:auto" />
                                        <?php
                                        }

                                        ?>

                                        <br />

                                        <span class="fw-bold"><?php echo $details_data["fname"] . " " . $details_data["lname"]; ?></span>
                                        <span class="fw-bold text-black-50"><?php echo $email; ?></span>

                                        <input type="file" class="d-none" id="profileImage" />
                                        <label for="profileImage" class="btn btn-primary mt-5">Update Profile Image</label>

                                    </div>
                                </div>

                                <div class="col-md-9 border-end card ">
                                    <div class="title01 user-card-header" style="font-size: 20px;">Account Details</div>
                                    <div class="card-body">

                                        

                                        <div class="row mt-4">

                                            <div class="col-6">
                                                <label class="form-label">First Name</label>
                                                <input type="text" id="fname" class="form-control" value="<?php echo $details_data["fname"]; ?>" />
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" id="lname" class="form-control" value="<?php echo $details_data["lname"]; ?>" />
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">Mobile Number</label>
                                                <input type="text" id="mobile" class="form-control" value="<?php echo $details_data["mobile"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" id="pw" value="<?php echo $details_data["password"]; ?>" class="form-control" aria-describedby="pwb">
                                                    <span class="input-group-text" id="pwb" onclick="showPassword1();"><i class="bi bi-eye-fill"></i></span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Email</label>
                                                <input type="text" id="email" class="form-control" value="<?php echo $email; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Registered Date</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $details_data["joined_date"]; ?>" />
                                            </div>

                                            <?php

                                            if (empty($address_data["line1"])) {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 01</label>
                                                    <input type="text" id="line1" class="form-control" placeholder="Enter Address Line 01" />
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 01</label>
                                                    <input type="text" id="line1" class="form-control" value="<?php echo $address_data["line1"]; ?>" />
                                                </div>
                                            <?php
                                            }

                                            if (empty($address_data["line2"])) {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 02</label>
                                                    <input type="text" id="line2" class="form-control" placeholder="Enter Address Line 02" />
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 02</label>
                                                    <input type="text" id="line2" class="form-control" value="<?php echo $address_data["line2"]; ?>" />
                                                </div>
                                            <?php
                                            }

                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $district_rs = Database::search("SELECT * FROM `district`");
                                            $city_rs = Database::search("SELECT * FROM `city`");

                                            $province_num = $province_rs->num_rows;
                                            $district_num = $district_rs->num_rows;
                                            $city_num = $city_rs->num_rows;

                                            ?>

                                            <div class="col-6">
                                                <label class="form-label">Province</label>
                                                <select class="form-select-1" id="province">
                                                    <option value="0">Select Province</option>
                                                    <?php

                                                    for ($x = 0; $x < $province_num; $x++) {
                                                        $province_data = $province_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $province_data["province_id"]; ?>" <?php
                                                                                                                        if (!empty($address_data["province_province_id"])) {
                                                                                                                            if ($province_data["province_id"] == $address_data["province_province_id"]) {
                                                                                                                        ?> selected <?php
                                                                                                                                }
                                                                                                                            }
                                                                                                                                    ?>>
                                                            <?php echo $province_data["province_name"]; ?>
                                                        </option>
                                                    <?php
                                                    }

                                                    ?>

                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">District</label>
                                                <select class="form-select-1" id="district">
                                                    <option value="0">Select District</option>
                                                    <?php

                                                    for ($x = 0; $x < $district_num; $x++) {
                                                        $district_data = $district_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $district_data["district_id"]; ?>" <?php
                                                                                                                        if (!empty($address_data["district_district_id"])) {
                                                                                                                            if ($district_data["district_id"] == $address_data["district_district_id"]) {
                                                                                                                        ?>selected<?php
                                                                                                                            }
                                                                                                                        }
                                                                        ?>><?php echo $district_data["district_name"] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">City</label>
                                                <select class="form-select-1" id="city">
                                                    <option value="0">Select City</option>
                                                    <?php
                                                    
                                                    for ($x = 0; $x < $city_num; $x++) {
                                                        $city_data = $city_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $city_data["city_id"]; ?>" 
                                                        <?php
                                                            if (!empty($address_data["city_id"])) {
                                                                if ($city_data["city_id"] == $address_data["city_city_id"]) {
                                                            ?>selected<?php
                                                                    }
                                                                }
                                                                        ?>><?php echo $city_data["city_name"] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <?php

                                            if (empty($address_data["postal_code"])) {
                                            ?>
                                                <div class="col-6">
                                                    <label class="form-label">Postal Code</label>
                                                    <input type="text" id="pc" class="form-control" placeholder="Enter Your Postal Code" />
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-6">
                                                    <label class="form-label">Postal Code</label>
                                                    <input type="text" id="pc" class="form-control" value="<?php echo $address_data["postal_code"]; ?>" />
                                                </div>
                                            <?php
                                            }

                                            ?>



                                            <div class="col-12">
                                                <label class="form-label">Gender</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $details_data["gender_name"]; ?>" />
                                            </div>

                                            <!-- Save changes button-->
                                            <div class="col-12 d-grid mt-2 mb-2">
                                                <button class="btn btn-primary" type="button" onclick="updateProfile();">Update My Profile</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                                

                            </div>
                        </div>

                    </div>
                </div>

            <?php

            } else {
            }

            ?>


        </div>
    </div>

	
	
	<?php include "footer.php"; ?>
 
	<!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<!-- Popper JS -->
	<script src="js/popper.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Color JS -->
	<script src="js/colors.js"></script>
	<!-- Slicknav JS -->
	<script src="js/slicknav.min.js"></script>
	<!-- Owl Carousel JS -->
	<script src="js/owl-carousel.js"></script>
	<!-- Magnific Popup JS -->
	<script src="js/magnific-popup.js"></script>
	<!-- Waypoints JS -->
	<script src="js/waypoints.min.js"></script>
	<!-- Countdown JS -->
	<script src="js/finalcountdown.min.js"></script>
	<!-- Nice Select JS -->
	<script src="js/nicesellect.js"></script>
	<!-- Flex Slider JS -->
	<script src="js/flex-slider.js"></script>
	<!-- ScrollUp JS -->
	<script src="js/scrollup.js"></script>
	<!-- Onepage Nav JS -->
	<script src="js/onepage-nav.min.js"></script>
	<!-- Easing JS -->
	<script src="js/easing.js"></script>
	<!-- Active JS -->
	<script src="js/active.js"></script>

	<script src="js/script.js"></script>


    
</body>
</html>