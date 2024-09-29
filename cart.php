<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $user = $_SESSION["u"]["email"];

    $total = 0;
    $subtotal = 0;
    $shipping = 0;

    // Calculate total, subtotal, and shipping
    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='" . $user . "'");
    $cart_num = $cart_rs->num_rows;

    if ($cart_num > 0) {
        while ($cart_data = $cart_rs->fetch_assoc()) {
            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
            $product_data = $product_rs->fetch_assoc();

            $product_price = $product_data["price"];
            $product_qty = $cart_data["qty"];
            $product_total = $product_price * $product_qty;

            $subtotal += $product_total;

            $address_rs = Database::search("SELECT district.district_id AS `did` FROM `users_has_address` INNER JOIN `city` ON
            users_has_address.city_city_id=city.city_id INNER JOIN `district` ON city.district_district_id=district.district_id WHERE `users_email`='" . $user . "'");
            $address_data = $address_rs->fetch_assoc();

            $delivery_fee = ($address_data["did"] == 5) ? $product_data["delivery_fee_colombo"] : $product_data["delivery_fee_other"];
            $shipping += $delivery_fee * $product_qty; // Correct calculation by considering product quantity
        }

        // Compute the total including shipping
        $total = $subtotal + $shipping;
    }
?>

<!DOCTYPE html>
<html lang="">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>Cart | Trendy_tech</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/logo.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
	
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
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl-carousel.css">
	<!-- Slicknav -->
    <link rel="stylesheet" href="css/slicknav.min.css">
	
	<!-- Eshop StyleSheet -->
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
		.btn:hover{
			color:#fff;
			background:#3EB489;
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
													<li><a href="index.php">Home</a></li>
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
							<li class="active"><a href="cart.php">Cart</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
	<?php
        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='" . $user . "'");
        $cart_num = $cart_rs->num_rows;

        if ($cart_num == 0) {
    ?>
    <!-- Empty View -->
    <div class="col-12">
        <div class="row">
        	<div class="col-12 emptyCart"></div>
            <div class="col-12 text-center mb-2">
                <label class="form-label fs-1 fw-bold">
                    You have no items in your Cart yet.
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
		<div class="container ">
			<div class="row">
				<div class="col-12">
					<?php if ($cart_num > 0): // Check if there are items in the cart ?>
						<!-- Shopping Summary -->
						<table class="table shopping-summery">
							<thead>
								<tr class="main-hading">
									<th>PRODUCT</th>
									<th>NAME</th>
									<th class="text-center">SELLER NAME</th>
									<th class="text-center">UNIT PRICE</th>
									<th class="text-center">QUANTITY</th>
									<th class="text-center">TOTAL</th>
									<th class="text-center"><i class="ti-trash remove-icon"></i></th>
								</tr>
							</thead>
							<tbody>
							<?php
                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $product_total = $product_data["price"] * $cart_data["qty"];

                                        $address_rs = Database::search("SELECT district.district_id AS `did` FROM `users_has_address` INNER JOIN `city` ON
                                            users_has_address.city_city_id=city.city_id INNER JOIN `district` ON city.district_district_id=district.district_id WHERE `users_email`='" . $user . "'");
                                        $address_data = $address_rs->fetch_assoc();

                                        $delivery_fee = ($address_data["did"] == 5) ? $product_data["delivery_fee_colombo"] : $product_data["delivery_fee_other"];
                                        $shipping += $delivery_fee * $cart_data["qty"];

                                        $seller_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["users_email"] . "'");
                                        $seller_data = $seller_rs->fetch_assoc();
                                        $seller = $seller_data["fname"] . " " . $seller_data["lname"];

                                        $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "' LIMIT 1");
                                        $image_data = $image_rs->fetch_assoc();
                                        $product_img = $image_data ? $image_data["img_path"] : 'images/default.jpg';
                                ?>
								<tr>
									<td class="image" data-title="No">
										<img src="<?php echo $product_img; ?>" alt="#" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $product_data["description"]; ?>">
									</td>
									<td class="product-des" data-title="Description">
										<p class="product-name"><a href="#"><?php echo $product_data["title"]; ?></a></p>
										<p class="product-des"><a href="#"><?php echo $product_data["product_tags"]; ?></p>
									</td>
									<td class="Seller" data-title="Seller"><span><?php echo $seller ?></span></td>
									<td class="price" data-title="Price"><span>Rs. <?php echo $product_data["price"]; .00 ?></span></td>
									<td class="qty" data-title="Qty">
										<div class="input-group">
											<div class="button minus">
												<button type="button" class="btn btn-primary btn-number" data-type="minus" data-id="<?php echo $cart_data['product_id']; ?>" data-price="<?php echo $product_data['price']; ?>">
													<i class="ti-minus"></i>
												</button>
											</div>
											<input type="text" name="quant[<?php echo $cart_data['product_id']; ?>]" class="input-number" data-id="<?php echo $cart_data['product_id']; ?>" data-price="<?php echo $product_data['price']; ?>" data-min="1" data-max="100" value="<?php echo $cart_data['qty']; ?>">
											<div class="button plus">
												<button type="button" class="btn btn-primary btn-number" data-type="plus" data-id="<?php echo $cart_data['product_id']; ?>" data-price="<?php echo $product_data['price']; ?>">
													<i class="ti-plus"></i>
												</button>
											</div>
										</div>
									</td>
									<td class="total-amount" data-title="Total"><span id="total-<?php echo $cart_data['product_id']; ?>">Rs. <?php echo $product_data['price'] * $cart_data['qty']; ?></span></td>
									<td class="action" data-title="Remove"><a href="#" onclick="removeFromCart(<?php echo $cart_data['cart_id']; ?>);"><i class="ti-trash remove-icon"></i></a></td>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
						<!--/ End Shopping Summary -->
					<?php else: ?>
						<p>No items in the cart.</p>
					<?php endif; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<!-- Total Amount -->
					<div class="total-amount">
					<div class="row">
                            <div class="col-lg-8 col-md-5 col-12">
                                <div class="left">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-7 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart Subtotal<span id="cart-subtotal">Rs. <?php echo number_format($subtotal, 2); ?></span></li>
                                        <li>Shipping<span id="shipping-fee">Rs. <?php echo number_format($shipping, 2); ?></span></li>
                                        <li class="last">You Pay<span id="overall-total">Rs. <?php echo number_format($total, 2); ?></span></li>
                                    </ul>
                                    <div class="button5">
                                        <a href="#" class="btn">Checkout</a>
                                        <a href="index.php" class="btn">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<!--/ End Total Amount -->
				</div>
			</div>
		</div>
	</div>
	
	<?php
        }
    ?>
	<!--/ End Shopping Cart -->
	<!-- Start Footer Area -->
	<footer class="footer">
		<!-- Footer Top -->
		<div class="footer-top section">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer about">
							<div class="logo">
								<a href="index.html"><img src="images/logo1.png" style="height: 100px; width:auto;" alt="#"></a>
							</div>
							<p class="text">Here we are the <strong>Trendy_tech.lk&trade;</strong> to support you for accomplish your desire by selling high quality products.</p>
							<p class="call">Got Question? Call us 24/7<span><a href="tel : 0112 345 876">+94112 345 876</a></span></p>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Information</h4>
							<ul style="margin-left: -30px;">
								<li><a href="#">About Us</a></li>
								<li><a href="#">Faq</a></li>
								<li><a href="#">Terms & Conditions</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Help</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Customer Service</h4>
							<ul style="margin-left: -30px;">
								<li><a href="#">Payment Methods</a></li>
								<li><a href="#">Money-back</a></li>
								<li><a href="#">Returns</a></li>
								<li><a href="#">Shipping</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer social">
							<h4>Get In Touch</h4>
							<!-- Single Widget -->
							<div class="contact">
								<ul style="margin-left: -30px;">
									<li>Raddolugama, Seeduwa, </li>
									<li>Srilanka.</li>
									<li>Trendy_tech.lk</li>
									<li>+94112 345 876</li>
								</ul>
							</div>
							<!-- End Single Widget -->
							<ul>
								<li><a href="#"><i class="ti-facebook"></i></a></li>
								<li><a href="#"><i class="ti-twitter"></i></a></li>
								<li><a href="#"><i class="ti-flickr"></i></a></li>
								<li><a href="#"><i class="ti-instagram"></i></a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer Top -->
		<div class="copyright">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="left">
								<p>Copyright © 2023 <a href="#" target="_blank">Trendy_tech.lk</a>  -  All Rights Reserved.</p>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="right">
								<img src="images/payments.png" alt="#">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- /End Footer Area -->
				
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
            })
        });
    </script>

	
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to update the total price for each product
        function updateProductTotal(id, price, qty) {
            const totalElement = document.getElementById(`total-${id}`);
            const newTotal = price * qty;
            totalElement.textContent = `Rs. ${newTotal.toFixed(2)}`;
            return newTotal;
        }

        // Function to update the overall total amount
        function updateOverallTotal() {
            let overallTotal = 0;
            document.querySelectorAll('.input-number').forEach(input => {
                const id = input.dataset.id;
                const price = parseFloat(input.dataset.price);
                const qty = parseInt(input.value);
                overallTotal += price * qty;
            });

            // Update the displayed subtotal, shipping, and total amount
            document.getElementById('cart-subtotal').textContent = `Rs. ${overallTotal.toFixed(2)}`;
            // Assume shipping is a fixed amount for simplicity. Adjust if needed.
            const shippingFee = parseFloat(document.getElementById('shipping-fee').textContent.replace('Rs. ', ''));
            document.getElementById('overall-total').textContent = `Rs. ${(overallTotal + shippingFee).toFixed(2)}`;
        }

        // Handle quantity input changes
        document.querySelectorAll('.input-number').forEach(input => {
            input.addEventListener('input', function () {
                const id = this.dataset.id;
                const price = parseFloat(this.dataset.price);
                const qty = parseInt(this.value);
                updateProductTotal(id, price, qty);
                updateOverallTotal();
            });
        });

        // Handle plus and minus buttons
        document.querySelectorAll('.btn-number').forEach(button => {
            button.addEventListener('click', function () {
                const type = this.dataset.type;
                const id = this.dataset.id;
                const price = parseFloat(this.dataset.price);
                const input = document.querySelector(`input[data-id="${id}"]`);
                let qty = parseInt(input.value);
                if (type === 'plus') {
                    qty += 1;
                } else if (type === 'minus' && qty > 1) {
                    qty -= 1;
                }
                input.value = qty;
                updateProductTotal(id, price, qty);
                updateOverallTotal();
            });
        });
    });
    </script>
	
</body>
</html>

<?php

}

?>