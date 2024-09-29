<?php
session_start();
require "connection.php";

if (!isset($_SESSION["u"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content=''>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Tag  -->
    <title>Watchlist | Trendy_tech</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/logo.png">
    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- StyleSheet -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/magnific-popup.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/niceselect.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/flex-slider.min.css">
    <link rel="stylesheet" href="css/owl-carousel.css">
    <link rel="stylesheet" href="css/slicknav.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <style>
        .btn {
            position: relative;
            font-weight: 500;
            font-size:14px;
            color: #fff;
            background: #333;
            display: inline-block;
            transition: all 0.4s ease;
            z-index: 5;
            display: inline-block;
            padding: 13px 32px;
            border-radius: 0px;
            text-transform:uppercase;
        }
        .btn:hover {
            color: #fff;
            background: #3EB489;
        }
    </style>
</head>
<body class="js">
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
													<li ><a href="index.php">Home</a></li>
													<li><a href="advancedSearch.php">Advance Search</a></li>												
													<li><a href="#">Service<i class="ti-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="#"><img src="images/header/chat_with_us.png" class="header-dicon"/>Chat with Us</a></li>
															<li><a href="#"><img src="images/header/order.png" class="header-dicon"/>Order</a></li>
															<li><a href="#"><img src="images/header/delivery.png" class="header-dicon"/>Shipping and Delivery</a></li>
															<li><a href="#"><img src="images/header/refund.svg" class="header-dicon"/>Returns and Refunds</a></li>
														</ul>
													</li>
													<li class="active"><a href="#">Shop<i class="ti-angle-down"></i></a>
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
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="index.php">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="watchlist.php">Watchlist</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    <?php
    $watchlist_rs = Database::search("SELECT * FROM `watchlist` 
                                      INNER JOIN `product` ON watchlist.product_id = product.id 
                                      INNER JOIN `color` ON product.color_clr_id = color.clr_id 
                                      INNER JOIN `condition` ON product.condition_condition_id = condition.condition_id 
                                      INNER JOIN `users` ON product.users_email = users.email 
                                      WHERE watchlist.users_email = '" . $_SESSION["u"]["email"] . "'");

    $watchlist_num = $watchlist_rs->num_rows;

    if ($watchlist_num == 0) {
    ?>
    <!-- Empty View -->
    <div class="col-12">
        <div class="row">
            <div class="col-12 emptyCart"></div>
            <div class="col-12 text-center mb-2">
                <label class="form-label fs-1 fw-bold">
                    You have no items in your Watchlist yet.
                </label>
            </div>
            <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                <a href="index.php" class="btn btn-outline-info fs-3 fw-bold">
                    Start Shopping
                </a>
            </div>
        </div>
    </div>
    <!-- Empty View -->
    <?php
    } else {
    ?>
    <div class="shopping-cart section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Shopping Summary -->
                    <table class="table shopping-summery">
                        <thead>
                            <tr class="main-hading">
                                <th>PRODUCT</th>
                                <th>NAME</th>
                                <th class="text-center">SELLER NAME</th>
                                <th class="text-center">UNIT PRICE</th>
                                <th class="text-center"><i class="bi bi-cart remove-icon"></i></th>
                                <th class="text-center">BUY NOW</th>
                                <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while ($watchlist_data = $watchlist_rs->fetch_assoc()) {
                                $list_id = $watchlist_data["id"];
                                $title = $watchlist_data["title"];
                                $description = $watchlist_data["description"];
                                $color = $watchlist_data["color_clr_id"];
                                $product_tags = $watchlist_data["product_tags"];
                                $price = $watchlist_data["price"];

                                // Fetch the product image
                                $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $watchlist_data["id"] . "' LIMIT 1");
                                $image_data = $image_rs->fetch_assoc();
                                $product_img = $image_data ? $image_data["img_path"] : 'images/default.jpg';

                                // Fetch the seller's details using the email associated with the product
                                $seller_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $watchlist_data["users_email"] . "'");
                                $seller_data = $seller_rs->fetch_assoc();
                                $seller = $seller_data["fname"] . " " . $seller_data["lname"];

                                $color_rs = Database::search("SELECT * FROM `color` WHERE `clr_id`='" .$color. "'");
                                $color_data = $color_rs->fetch_assoc();
                                $product_color = $color_data["clr_name"];

                            ?>
                            <tr>
                                <td class="image" data-title="No">
                                    <img src="<?php echo $product_img; ?>" alt="#" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $description; ?>">
                                </td>
                                <td class="product-des" data-title="Description" style="text-align: center;">
                                    <p class="product-name"><a href="#"><?php echo $title; ?></a></p>
                                    <p class="product-des"><a href="#"><?php echo $product_tags; ?></a></p><br/>
                                    <p class="product-des"><a href="#">Color : <?php echo $product_color; ?></a></p>
                                </td>
                                <td class="Seller" data-title="Seller" style="text-align: center;"><span><?php echo $seller; ?></span></td>
                                <td class="price" data-title="Price"><span>Rs. <?php echo number_format($price, 2); ?></span></td>
                                <td class="action" data-title="Add-to-cart"><a href="#" ><i class="bi bi-cart remove-icon"></i></a></td>
                                <td class="action" data-title="Buy Now"><a href="#" ><i class="bi bi-credit-card remove-icon"></i></a></td>
                                <td class="action" data-title="Remove"><a href="#" onclick="removeFromWatchlist(<?php echo $list_id; ?>);"><i class="ti-trash remove-icon"></i></a></td>
                            </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                    <!--/ End Shopping Summary -->
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
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
    <!-- Fancybox JS -->
    <script src="js/facnybox.min.js"></script>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
</body>
</html>
