<?php

session_start();

require "connection.php";

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
    <title>Trendy_tech | Home-Page</title>
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

	
	
</head>
<body>
	
	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->
	
	
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
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
							<a href="index.html"><img src="images/logo/logo.png" alt="logo" style="margin-top: -20px;"></a>
						</div>
						<!--/ End Logo -->
					</div>
					<div class="col-lg-8 col-md-7 col-12">
						<div class="search-bar-top">
							<div class="search-bar">
								<select id="c">
									<option selected="selected">All Category</option>
									<?php

									$category_rs = Database::search("SELECT * FROM `category`");
									$category_num = $category_rs->num_rows;

									for ($x = 0; $x < $category_num; $x++) {

										$category_data = $category_rs->fetch_assoc();

									?>

										<option value="<?php echo $category_data["cat_id"]; ?>">
											<?php echo $category_data["cat_name"]; ?>
										</option>

									<?php

									}

									?>
								</select>
								<form>
									<input name="search" placeholder="Search Products Here....." type="search" id="kw">
									<button class="btnn" onclick="basicSearch(event, 0);"><i class="ti-search"></i></button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 col-12">
						<div class="right-bar">
							<!-- Search Form -->
							<div class="sinlge-bar">
								<a href="watchlist.php" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar">
								<a href="#" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar shopping">
								<a href="cart.php" class="single-icon"><i class="ti-bag"></i> </a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
															<li><a href="sellinghistory.php"><img src="images/header/sell-product.svg" class="header-dicon"/>Selling History</a></li>
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
	<div id="search-results">
	<!-- Slider Area -->
	<section class="hero-slider">
		<!-- Single Slider -->
		<div class="single-slider" >
			<div class="container">
				<div class="row no-gutters">
					<div class="col-lg-9 offset-lg-3 col-12">
						<div class="text-inner">
							<div class="row">
								<div class="col-lg-7 col-12">
									<div class="hero-text">
										<h1><span style="color: #fff;">UP TO 50% OFF </span>Electronics Deals</h1>
										<p style="color: #fff;">Upgrade your tech setup with amazing discounts <br> on laptops, computer accessories, and more! <br> Explore our selection for the best deals.</p>
										<div class="button">
											<a href="#" class="btn">Shop Now!</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Single Slider -->
	</section>
	<!--/ End Slider Area -->
	
	<!-- Start Small Banner  -->
	<section class="small-banner section">
		<div class="container-fluid">
			<div class="row">
				<!-- Single Banner  -->
				<div class="col-lg-4 col-md-6 col-12">
					<div class="single-banner">
						<img src="images/home-page/girl_games_main.jpg" alt="#">
						<div class="content">
							<p>Ultimate Gaming Gear Collection</p>
							<h3 style="color: #fff;">"Unleash the Power <br/> Collection</h3>
							<a href="#">Discover Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-4 col-md-6 col-12">
					<div class="single-banner">
						<img src="images/home-page/family-TV1.jpg" alt="#">
						<div class="content">
							<p>Home Harmony Collection</p>
							<h3>Enhance Family Bonds with Our <br/> TV Selection</h3>
							<a href="#">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-4 col-12">
					<div class="single-banner tab-height">
						<img src="images/home-page/9r_flash_sale.jpg" alt="#">
						<div class="content">
							<p>Flash Sale</p>
							<h3>Mid Season <br> Up to <span>40%</span> Off</h3>
							<a href="#">Discover Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
			</div>
		</div>
	</section>
	<!-- End Small Banner -->
	
	<!-- Start Product Area -->
	<div class="product-area section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Trending Item</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="product-info">
						<div class="nav-main">
							<!-- Tab Nav -->
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<?php
									$categories = Database::search("SELECT * FROM `category`");
									$isFirst = true;
									while ($category = $categories->fetch_assoc()) {
										$activeClass = $isFirst ? 'active' : '';
										echo "<li class='nav-item'><a class='nav-link $activeClass' data-toggle='tab' href='#cat{$category['cat_id']}' role='tab'>{$category['cat_name']}</a></li>";
										$isFirst = false;
									}
								?>
							</ul>
							<!--/ End Tab Nav -->
						</div>
						<div class="tab-content" id="myTabContent">
							<?php
							$categories->data_seek(0); // Reset the pointer to the start
							$isFirst = true;
							while ($category = $categories->fetch_assoc()) {
								$activeClass = $isFirst ? 'show active' : '';
								echo "<div class='tab-pane fade $activeClass' id='cat{$category['cat_id']}' role='tabpanel'>";
								echo "<div class='tab-single'><div class='row'>";

								$products = Database::search("SELECT * FROM `product`
															INNER JOIN `category`
															ON category.cat_id = product.category_cat_id
															WHERE `status_status_id`='1'
															AND product.category_cat_id='{$category['cat_id']}'
															ORDER BY product.title ASC");
								while ($product = $products->fetch_assoc()) {
									$img_rs = Database::search("SELECT * FROM `product_img`
																WHERE `product_id`='{$product['id']}' LIMIT 2");
									$images = [];
									while ($img_data = $img_rs->fetch_assoc()) {
										$images[] = $img_data['img_path'];
									}
									$default_img = isset($images[0]) ? $images[0] : 'images/default.jpg';
									$hover_img = isset($images[1]) ? $images[1] : $default_img;
									$product_url = "singleProductView.php?id=" . $product['id'];
									echo "
										<div class='col-xl-3 col-lg-4 col-md-4 col-12'>
											<div class='single-product'>
												<div class='product-img'>
													<a href='$product_url'>
														<img class='default-img' src='$default_img' alt='#'>
														<img class='hover-img' src='$hover_img' alt='#'>
													</a>
													<div class='button-head'>
														<div class='product-action'>
															<a data-toggle='modal' data-target='#exampleModal' title='Quick View' href='#'><i class='ti-eye'></i><span>Quick Shop</span></a>
															<a title='Wishlist' href='#' onclick='addToWatchlist({$product['id']}); return false;'><i class='ti-heart'></i><span>Add to Wishlist</span></a>
														</div>
														<div class='product-action-2'>
															<a title='Add to cart' href='#' onclick='addToCart({$product['id']}); return false;'>Add to cart</a>
														</div>
													</div>
												</div>
												<div class='product-content text-center'>
													<h3><a href='$product_url' style='font-size: 16px; color: #333; text-decoration: none; display: block; margin-bottom: 10px;'>{$product['title']}</a></h3>
													<span style='display: block; color: #4CAF50; font-weight: bold; margin-top: 5px;'>{$product['qty']} Items Available</span>
													<div class='product-price'>
														<br/>
														<span style='font-size: 18px; color: #e60000; font-weight: bold;'>Rs. {$product['price']}</span>
													</div>
												</div>
											</div>
										</div>";
								}
								echo "</div></div></div>";
								$isFirst = false;
							}
							?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Product Area -->


	<!-- Start Midium Banner  -->
	<section class="midium-banner">
		<div class="container">
			<div class="row">
				<!-- Single Banner  -->
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-banner">
						<img src="images/home-page/phones.jpg" alt="#" style="height: 290px;">
						<div class="content">
							<p style="color: #f6931d;">Exquisite Phone Collection</p>
							<h3 style="color: #fff;">Phones Redefined<br>Up to<span> 30%</span></h3>
							<a href="#">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-banner">
						<img src="images/home-page/cameras.jpg" alt="#">
						<div class="content">
							<p style="color: #000000;">Untamed Beauty Collection</p>
							<h3 style="color: #fff;">Explore the Wilderness Through a Lens <br> up to <span>40%</span></h3>
							<a href="#" class="btn">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
			</div>
		</div>
	</section>
	<!-- End Midium Banner -->
	<br/><br/><br/>
	<!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
		<div class="container" data-aos="zoom-in">
  
			<div class="row">
				<div class="col-lg-9 text-center text-lg-start">
					<h3>Explore Tech Delights</h3>
					<br/>
					<p>Ready to immerse yourself in the world of cutting-edge technology? 
						Discover a curated selection of mobile phones, laptops, TVs, cameras, and more. 
						Our expert team is here to transform your digital experience, providing you with 
						sleek designs, top-notch visuals, and powerful online solutions.</p>
				</div>
				<div class="col-lg-3 cta-btn-container text-center">
					<a class="cta-btn align-middle" href="#">Shop Now</a>
				</div>
			</div>
			 
		</div>
	  </section><!-- End Cta Section -->
	  
	
	<!-- Start Shop Services Area -->
	<section class="shop-services section home">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Free Delivery</h4>
						<p>Orders over Rs 70,000</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Free Return</h4>
						<p>Within 30 days returns</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Secure Payment</h4>
						<p>100% secure payment</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Best Price</h4>
						<p>Guaranteed price</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Services Area -->
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