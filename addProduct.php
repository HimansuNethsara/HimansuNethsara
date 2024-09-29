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
    <title>Add Product | eShop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="style.css">
    
    <style>
        .custom-checkbox .custom-control-label::before,
        .custom-checkbox .custom-control-label::after {
            border-radius: 5px;
        }

        .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
            background-color: #3EB489;
            border-color: #3EB489;
        }
        .animate__animated {
            animation-duration: 1s;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .slide-in {
            animation-name: slideIn;
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
													<li><a href="#">Shop<i class="ti-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="cart.php"><img src="images/header/cart.png" class="header-dicon"/>Cart</a></li>
															<li><a href="#"><img src="images/header/checkout.png" class="header-dicon"/>Checkout</a></li>
														</ul>
													</li>
																					
													<li><a href="adminSignin.php">Admin Panel</a></li>
													<li><a href="#">Contact Us</a></li>
													<li class="active"><a href="#">Advanced Options<i class="ti-angle-down"></i></a>
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

    
    <h2 class="text-center mb-5" style="font-family: StoryElement;">Add Products</h2>

    <form id="addProductForm">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="title" class="form-label">Product Title</label>
                <input type="text" class="form-control" id="title" required>
            </div>
            <div class="col-md-6">
                <label for="category" class="form-label">Product Category</label>
                <select class="form-select-1" id="category" onchange="loadBrands();" >
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
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="brand" class="form-label">Product Brand</label>
                <select class="form-select-1" id="brand" onchange="loadModels();" >
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
            <div class="col-md-6">
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

        <div class="mb-3">
            <label for="description" class="form-label">Product Description</label>
            <textarea class="form-control" style="height: 60px;" id="desc" required></textarea>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="price" class="form-label">Product Price (Rs.)</label>
                <div class="input-group">
                    <span class="input-group-text">Rs</i></span>
                    <input type="number" class="form-control" id="cost" required>
                </div>
            </div>
            <div class="col-md-4">
                <label for="quantity" class="form-label">Product Quantity</label>
                <div class="input-group">
                    <button class="btn btn-outline-secondary" type="button" onclick='qty_dec();'><i class="bi bi-dash"></i></button>
                    <input type="text" class="form-control text-center border-0 fs-5 fw-bold" style="outline: none;" pattern="[1-9]" value="1" onkeyup='check_value(<?php echo $product["qty"]; ?>);' id="qty_input" />
                    <button class="btn btn-outline-secondary" type="button" onclick='qty_inc(<?php echo $product["qty"]; ?>);'><i class="bi bi-plus"></i></button>
                </div>

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
                <div class="input-group mt-2 mb-2">
                <input type="text" class="form-control" placeholder="Add new Colour" id="clr_in"/>
                <button class="btn btn-outline-primary" style="height: 35px; width:35px;" type="button" id="button-addon2">+</button>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Product Condition</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="c" id="b" value="brandNew" checked>
                    <label class="form-check-label" for="b">Brand New</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="c" id="u" value="used">
                    <label class="form-check-label" for="u">Used</label>
                </div>
            </div>                
        </div>
        <br/>               
        <div class="mb-3">
            <label for="images" class="form-label">Upload Product Images</label>
            <div class="dropzone" id="dropzone">
            <input type="file" class="d-none" id="imageuploader" multiple />
                <div class="dz-message">
                    <h3>Drop files here or click to upload</h3>
                    <p>(JPG, JPEG, PNG, SVG supported)</p>
                </div>
                <br/>
                <label for="imageuploader" class="col-12 btn btn-primary" style="width: 200px; border-radius: 30px;" onclick="changeProductImage();">Upload Images</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Product Tags (comma separated)</label>
            <input type="text" class="form-control" id="tags">
        </div>

        <div class="mb-3">
            <label for="specifications" class="form-label">Product Specifications</label>
            <textarea class="form-control" style="height: 80px;" id="spec"></textarea>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col-12">
                    <label class="form-label fw-bold" style="font-size: 20px;">Delivery Cost</label>
                </div>
                <br/><br/>
                 <div class="col-12 col-lg-6 border-end border-success">
                    <div class="row">
                        <div class="col-12 offset-lg-1 col-lg-3">
                            <label class="form-label">Delivery cost within Colombo</label>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="input-group mb-2 mt-2">
                                <span class="input-group-text">Rs.</span>
                                <input type="text" class="form-control" id="dwc"/>
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12 offset-lg-1 col-lg-3">
                            <label class="form-label">Delivery cost out of Colombo</label>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="input-group mb-2 mt-2">
                                <span class="input-group-text">Rs.</span>
                                <input type="text" class="form-control" id="doc"/>
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="mb-3">
            <div class="row">
                <div class="col-12">
                    <label class="form-label fw-bold" style="font-size: 20px;">Approved Payment Methods</label>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="offset-0 offset-lg-2 col-2 pm pm1"></div>
                        <div class="col-2 pm pm2"></div>
                        <div class="col-2 pm pm3"></div>
                        <div class="col-2 pm pm4"></div>
                    </div>
                </div>
            </div>
        </div>
        <br/><br/>

        <button type="submit" class="btn btn-primary" style="border-radius: 10px;" onclick="addProduct();" >Add Product</button>
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
