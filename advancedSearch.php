<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Search | Trendy Tech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="style.css">
    
    <style>
        .form-control, .form-select-1 {
            height: 45px;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            background-color: #fff;
            color: #333;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-sort {
            border: 2px solid #3EB489; 
            border-top: 0;
            border-left: 0;
            border-right: 0;
            border-radius: 0;
        }

        .custom-sort:focus, .custom-sort:hover {
            outline: none;
            box-shadow: 0 0 5px rgba(62, 180, 137, 0.5); 
            border-color: #3EB489; 
        }

        .custom-sort option {
            color: #333;
        }

        .card {
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
													<li><a href="index.php">Home</a></li>
													<li class="active"> <a href="advancedSearch.php">Advance Search</a></li>												
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

<section class="addProduct">
<div class="container">

    
    <h2 class="text-center mb-5" style="font-family: StoryElement;">Advanced Search</h2>

    <form id="addProductForm">
        <div class="row mb-3">
            <div class="col-md-9">
                <input type="text" class="form-control" placeholder="Type keyword to search..." id="t" required>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-primary adsearch" onclick="advancedSearch(0);">Search</button>
            </div>
        </div>
        <br/>                                    
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="category" class="form-label">Product Category</label>
                <select class="form-select-1" id="category" >
                    <option value="0">Select Category</option>
                    <?php
                        $category_rs = Database::search("SELECT * FROM `category`");
                        $category_num = $category_rs->num_rows;

                        for ($x = 0; $x < $category_num; $x++) {
                            $category_data = $category_rs->fetch_assoc();
                    ?>
                    <option value="<?php echo $category_data["cat_id"]; ?>"><?php echo $category_data["cat_name"]; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="brand" class="form-label">Product Brand</label>
                <select class="form-select-1" id="brand"  >
                    <option value="0">Select Brand</option>
                    <?php
                        $brand_rs = Database::search("SELECT * FROM `brand`");
                        $brand_num = $brand_rs->num_rows;

                        for ($x = 0; $x < $brand_num; $x++) {
                             $brand_data = $brand_rs->fetch_assoc();
                    ?>
                    <option value="<?php echo $brand_data["brand_id"]; ?>"><?php echo $brand_data["brand_name"]; ?></option>
                    <?php
                       }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="category" class="form-label">Product Model</label>
                <select class="form-select-1" id="model" >
                <option value="0">Select Model</option>
                <?php
                    $model_rs = Database::search("SELECT * FROM `model`");
                    $model_num = $model_rs->num_rows;

                    for ($x = 0; $x < $model_num; $x++) {
                        $model_data = $model_rs->fetch_assoc();
                    ?>
                    <option value="<?php echo $model_data["model_id"]; ?>"><?php echo $model_data["model_name"]; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div> 
        </div>
        <br/>
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Product Condition</label>
                <select class="form-select-1" id="c2">
                    <option value="0">Select Condition</option>
                    <?php 
                        $condition_rs = Database::search("SELECT * FROM `condition`");
                        $condition_num = $condition_rs->num_rows;
                        for($x = 0; $x < $condition_num; $x++){
                            $condition_data = $condition_rs->fetch_assoc();
                    ?>
                    <option value="<?php echo $condition_data["condition_id"] ?>"><?php echo $condition_data["condition_name"] ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
                <label for="category" class="form-label">Product Colour</label>
                <select class="form-select-1" id="clr" required>
                <option value="0">Select Colour</option>
                    <?php

                    $clr_rs = Database::search("SELECT * FROM `color`");
                    $clr_num = $clr_rs->num_rows;

                    for ($x = 0; $x < $clr_num; $x++) {
                        $clr_data = $clr_rs->fetch_assoc();
                    ?>

                    <option value="<?php echo $clr_data["clr_id"]; ?>"><?php echo $clr_data["clr_name"]; ?></option>

                    <?php
                        }

                    ?>
                </select>
            </div>
        </div>
        <br/><br/>
        <div class="row mb-3">
                <div class="col-md-6 border-end border-success">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <label class="form-label">Price From</label>
                        </div>
                        <div class="col-8">
                            <div class="input-group">
                                <span class="input-group-text">Rs.</span>
                                <input type="text" class="form-control" id="pf" />
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <label class="form-label">Price To</label>
                        </div>
                        <div class="col-8">
                            <div class="input-group">
                                <span class="input-group-text">Rs.</span>
                                <input type="text" class="form-control" id="pt" />
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <br/>
        <div class="row mb-3">
                <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-8"></div>
                            <div class="col-12 col-md-6 col-lg-4 mt-2 mb-2">
                                <select class="form-select-2 custom-sort" id="s">
                                    <option value="0">SORT BY</option>
                                    <option value="1">PRICE LOW TO HIGH</option>
                                    <option value="2">PRICE HIGH TO LOW</option>
                                    <option value="3">QUANTITY LOW TO HIGH</option>
                                    <option value="4">QUANTITY HIGH TO LOW</option>
                                </select>
                            </div>
                        </div>
                        <div class="offset-lg-2 col-12 col-lg-8 bg-body rounded mb-3">
                            <div class="row">
                                <div class="offset-lg-1 col-12 col-lg-10 text-center">
                                    <div class="row" id="view_area">
                                        <div class="offset-5 col-2 mt-5">
                                            <span class="fw-bold text-black-50"><i class="bi bi-search h1" style="font-size: 100px;"></i></span>
                                        </div>
                                        <div class="offset-3 col-6 mt-3 mb-5">
                                            <span class="h1 text-black-50 fw-bold" style="font-size: 25px;">No Items Searched Yet...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php

    } else {
    header("Location:index.php");
    }
?>

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
	

	<script src="js/script.js"></script>
</script>
</body>
</html>
