<?php
session_start();
require "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    $user = $_SESSION["u"];

    $product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,product.product_specification,product.product_tags,
    product.title,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,product.category_cat_id,product.model_has_brand_id,
    product.color_clr_id,product.status_status_id,product.condition_condition_id,product.users_email,model.model_name AS mname,brand.brand_name AS bname,
    brand.brand_id,model.model_id FROM `product` INNER JOIN `model_has_brand` ON model_has_brand.id = product.model_has_brand_id INNER JOIN `brand` 
    ON brand.brand_id = model_has_brand.brand_brand_id INNER JOIN `model` ON model.model_id = model_has_brand.model_model_id WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {
        $product_data = $product_rs->fetch_assoc();

        $brand_name = $product_data['bname'];
        $model_name = $product_data['mname'];

        // Fetch images for the product
        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='{$product_data['id']}' LIMIT 2");
        $images = [];
        while ($img_data = $img_rs->fetch_assoc()) {
            $images[] = $img_data['img_path'];
        }
        $default_img = isset($images[0]) ? $images[0] : 'images/default.jpg';
        $hover_img = isset($images[1]) ? $images[1] : $default_img;

        // Product URL
        $product_url = "singleProductView.php?id=" . $product_data['id'];
        
?>

<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title><?php echo htmlspecialchars($product_data["title"]); ?> | Trendy_tech</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/logo.png">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <style>
        img {
            max-width: 100%;
        }
        .set-bg {
            background-repeat: no-repeat;
            background-size: cover;
            background-position: top center;
        }
        .spad {
            padding-top: 100px;
            padding-bottom: 100px;
        }
        .primary-btn {
            display: inline-block;
            font-size: 14px;
            padding: 10px 28px 10px;
            color: #ffffff;
            text-transform: uppercase;
            font-weight: 700;
            background: #7fad39;
            letter-spacing: 2px;
        }    
        
        .product__details__pic .hover-img {
            display: none;
        }

        .product__details__pic:hover .hover-img {
            display: block;
        }

        .product__details__pic:hover .default-img {
            display: none;
        }
        .tabcontent {
            display: none;
        }

        .tabcontent.active {
            display: block;
        }
        /* Tab content */
        .product__details__tab {
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 10px;
        }

        /* Tabs */
        .tabs {
            margin-bottom: 20px;
        }

        /* Tab button */
        .tablinks {
            background-color: #ffffff;
            color: #333;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .tablinks.active {
            background-color: #3EB489;
            color: #fff;
        }

/*paynow doesnt work because of CORB */
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
								<a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar">
								<a href="#" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar shopping">
								<a href="#" class="single-icon"><i class="ti-bag"></i> </a>
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
													<li class="active"><a href="#">Home</a></li>
													<li><a href="#">Product</a></li>												
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
															<li><a href="cart.html"><img src="images/header/cart.png" class="header-dicon"/>Cart</a></li>
															<li><a href="checkout.html"><img src="images/header/checkout.png" class="header-dicon"/>Checkout</a></li>
														</ul>
													</li>
													<li><a href="#">Pages</a></li>									
													<li><a href="#">Blog<i class="ti-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="blog-single-sidebar.html">Blog Single Sidebar</a></li>
														</ul>
													</li>
													<li><a href="contact.html">Contact Us</a></li>
													<li><a href="#">Advanced<i class="ti-angle-down"></i></a>
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
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <img class="default-img" src="<?php echo $default_img; ?>" alt="#">
                        <img class="hover-img" src="<?php echo $hover_img; ?>" alt="#">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo htmlspecialchars($product_data["title"]); ?></h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <?php
                            $price = $product_data["price"];
                            $add = ($price / 100) * 10;
                            $new_price = $price + $add;
                            $diff = $new_price - $price;
                            $percent = ($diff / $price) * 100;
                        ?>
                        <div class="product__details__price">Rs <?php echo number_format($price, 2); ?></div>
                        <p><?php echo htmlspecialchars($product_data["product_tags"]); ?></p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                <input type="text" pattern="[1-9]" value="1" onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' id="qty_input" />
                                </div>
                            </div>
                        </div>
                        <a href="#" class="primary-btn">ADD TO CART</a>
                        <a href="#" class="primary-btn" id="payhere-payment" onclick="paynow(<?php echo $pid; ?>);">PAY NOW</a>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Brand</b> <span><?php echo htmlspecialchars($product_data["bname"]); ?></span></li>
                            <li><b>Model</b> <span><?php echo htmlspecialchars($product_data["mname"]); ?></span></li>
                            <hr/>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Warrenty Period</b> <span>01 Year </span></li>
                            <li><b>Return Policy</b> <span>01 Month</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <div class="tabs">
                            <button class="tablinks active" onclick="openTab(event, 'tabs-1')">Description</button>
                            <button class="tablinks" onclick="openTab(event, 'tabs-2')">Specification</button>
                            <button class="tablinks" onclick="openTab(event, 'tabs-3')">Reviews</button>
                        </div>
                        <div id="tabs-1" class="tabcontent active">
                            <div class="product__details__tab__desc" style="margin-top: 20px;">
                                <h6 style="font-size: 18px; color: #333; margin-bottom: 10px;">Product Description</h6>
                                <p ><?php echo htmlspecialchars($product_data["description"]); ?></p>
                            </div>
                        </div>
                        <div id="tabs-2" class="tabcontent">
                            <div class="product__details__tab__desc" style="margin-top: 20px;" >
                                <h6 style="font-size: 18px; color: #333; margin-bottom: 10px;">Product Specification</h6>
                                <p><?php echo htmlspecialchars($product_data["product_specification"]); ?></p>
                            </div>
                        </div>
                        <div id="tabs-3" class="tabcontent">
                            <div class="product__details__tab__desc" style="margin-top: 20px;">
                                <h6 style="font-size: 18px; color: #333; margin-bottom: 10px;">Product Reviews</h6>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Product Details Section End -->
    
    <?php include "footer.php"; ?>
    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/script.js"></script>
    <script>
        function openTab(evt, tabId) {
            // Get all elements with class "tabcontent" and hide them
            var tabcontent = document.getElementsByClassName("tabcontent");
            for (var i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            
            // Get all elements with class "tablinks" and remove the "active" class
            var tablinks = document.getElementsByClassName("tablinks");
            for (var i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            
            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tabId).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // By default, display the first tab
        document.getElementById("tabs-1").style.display = "block";
    </script>


    <script>
        (function ($) {
            /*--------------------------
                Select
            ----------------------------*/
            $("select").niceSelect();

            /*-------------------
                Quantity change
            --------------------- */
            var proQty = $('.pro-qty');
            proQty.prepend('<span class="dec qtybtn">-</span>');
            proQty.append('<span class="inc qtybtn">+</span>');
            proQty.on('click', '.qtybtn', function () {
                var $button = $(this);
                var oldValue = $button.parent().find('input').val();
                if ($button.hasClass('inc')) {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    // Don't allow decrementing below 1
                    if (oldValue > 1) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 1;
                    }
                }
                $button.parent().find('input').val(newVal);
            });

            /*-------------------
                Tab functionality
            --------------------- */
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr("href");
                console.log(target);
            });

        })(jQuery);
    </script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>
</html>

<?php
    }
}
?>
