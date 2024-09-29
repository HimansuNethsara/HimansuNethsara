<?php

session_start();

require "connection.php";

if(isset($_SESSION["u"])){

    $email = $_SESSION["u"]["email"];

    $pageno;

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trendy_tech | My Products</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/magnific-popup.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/niceselect.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/flex-slider.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">

	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" type="image/png" href="images/logo.png">

    <style>
        .product__item {
            margin-bottom: 30px;
        }
        .product__item__pic {
            position: relative;
            overflow: hidden;
            height: 300px;
        }
        .product__item__pic img {
            display: block;
        }

        .user-profile-section {
            padding: 50px 0;
            background-color: #f8f9fa;
        }

        .user-profile__text {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        .user-profile__text .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
            object-fit: cover;
        }

        .user-profile__text .user-name {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        .user-profile__text .user-email {
            font-size: 18px;
            color: #777;
            margin-bottom: 20px;
        }
        .user-profile__text .edit-profile-btn {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .user-profile__text .edit-profile-btn:hover {
            background-color: #0056b3;
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

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>My Products</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <section class="user-profile-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="user-profile__text">
                    <?php
                        $profile_img_rs = Database::search("SELECT * FROM `profile_img` WHERE 
                                            `users_email` ='".$email."'");

                        if($profile_img_rs->num_rows == 1){

                            $profile_img_data = $profile_img_rs->fetch_assoc();

                        ?>
                            <img src="<?php echo $profile_img_data["path"]; ?>" class="profile-pic" />
                        <?php

                        }else{
                            ?>
                            <img src="resources/user/profile_img.svg" class="profile-pic" />                              
                            <?php
                        }

                        ?>
                        <h3 class="user-name"><?php echo $_SESSION["u"]["fname"]." ".$_SESSION["u"]["lname"]; ?></h3>
                        <p class="user-email"><?php echo $email; ?></p>
                        <button class="edit-profile-btn" onclick="location.href='user_profile.php'">Edit Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Sort Products</h4>
                            <div class="col-11">
                                <div class="row">
                                    <div class="col-10">
                                        <input type="text" placeholder="Search..." class="form-control-1" id="s" />
                                    </div>
                                    <div class="col-1 p-1">
                                        <label class="form-label"><i class="bi bi-search fs-5"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Active Time</h4>
                            <div class="col-12">
                                <hr/>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="r1" id="n">
                                    <label class="form-check-label" for="n">
                                        Newest to oldest
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="r1" id="o">
                                    <label class="form-check-label" for="o">
                                        Oldest to newest
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Quantity</h4>
                            <div class="col-12">
                                <hr/>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="r2" id="h">
                                    <label class="form-check-label" for="h">
                                        High to low
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="r2" id="l">
                                    <label class="form-check-label" for="l">
                                        Low to high
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Condition</h4>
                            <div class="col-12">
                                <hr/>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="r3" id="b">
                                    <label class="form-check-label" for="b">
                                        Brandnew
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="r3" id="u">
                                    <label class="form-check-label" for="u">
                                        Used
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-3 mb-3 myproduct-side-b">
                            <div class="row g-2">
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-success fw-bold sort-btn" onclick="sort(0);">Sort</button>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-primary fw-bold clear-btn" onclick="clearSort();">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="section-title">
                        <h2>Sale Off</h2>
                    </div>
                    <div class="row" id="sort">
                    <?php
                        // Retrieve page number from URL or set default to 1
                        if (isset($_GET["page"])) {
                            $pageno = $_GET["page"];
                        } else {
                            $pageno = 1;
                        }

                        // Fetch total number of products
                        $product_rs = Database::search("SELECT * FROM `product` WHERE `users_email`='".$email."'");
                        $product_num = $product_rs->num_rows;

                        // Define pagination variables
                        $results_per_page = 6;
                        $number_of_pages = ceil($product_num / $results_per_page);
                        $page_results = ($pageno - 1) * $results_per_page;

                        // Fetch selected products based on pagination
                        $selected_rs = Database::search("SELECT * FROM `product` WHERE `users_email`='".$email."' LIMIT ".$results_per_page." OFFSET ".$page_results);
                        $selected_num = $selected_rs->num_rows;

                        // Loop through selected products
                        for ($x = 0; $x < $selected_num; $x++) {
                            $selected_data = $selected_rs->fetch_assoc();
                            ?>
                            <!-- Start of Product Card -->
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic">
                                        <?php

                                            $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                                                `product_id` = '".$selected_data["id"]."'");
                                            $product_img_data = $product_img_rs->fetch_assoc();

                                        ?>

                                        <img src="<?php echo $product_img_data["img_path"] ?>" class="img-fluid" />
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#" class="update-btn" onclick="sendId(<?php echo $selected_data['id']; ?>);"><i class="fa fa-edit"></i></a></li>
                                            <li><a href="#" class="delete-btn"><i class="fa fa-trash"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h5><?php echo $selected_data["title"]; ?></h5>
                                        <br/>
                                        <span>Rs. <?php echo $selected_data["price"]; ?> .00</span><br/>
                                        <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"]; ?> Items left</span> 
                                        <div class="form-check form-switch acti-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="<?php echo $selected_data["id"]; ?>" onchange="changeStatus(<?php echo $selected_data['id']; ?> );"
                                            <?php if($selected_data["status_status_id"] == 2){ ?> checked <?php } ?>/>
                                            <label class="form-check-label fw-bold text-info" for="<?php echo $selected_data["id"]; ?>">
                                                <?php if($selected_data["status_status_id"] == 2){ ?>
                                                    <span class="activate-text">Activate Product</span>
                                                <?php }else{
                                                ?>
                                                <span class="deactivate-text">Deactivate Product</span>
                                                <?php
                                                } ?>
                                            </label>

                                         </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Product Card -->
                        <?php
                        }
                        ?>


                    </div>
                    <div class="product__pagination">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-lg justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="
                                    <?php if ($pageno <= 1) {
                                        echo ("#");
                                    } else {
                                        echo "?page=" . ($pageno - 1);
                                    } ?>
                                    " aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>

                                <?php
                                for ($y = 1; $y <= $number_of_pages; $y++) {
                                    if ($y == $pageno) {
                                ?>
                                        <li class="page-item active">
                                            <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                        </li>
                                <?php
                                    }
                                }
                                ?>

                                <li class="page-item">
                                    <a class="page-link" href="
                                    <?php if ($pageno >= $number_of_pages) {
                                        echo ("#");
                                    } else {
                                        echo "?page=" . ($pageno + 1);
                                    } ?>
                                    " aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

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
<?php

}

?>