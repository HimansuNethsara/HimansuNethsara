<?php
session_start();
require "connection.php";

if (!isset($_SESSION["u"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Selling History | Admins | Trendy_tech</title>

    <!-- Bootstrap.css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Style.css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="style.css">>

    <style>
        body {
    background-color: #343a40;
    color: #f8f9fa;
    font-family: 'Arial', sans-serif;
}

.breadcrumbs {
    background-color: #212529;
    padding: 10px 0;
}

.breadcrumbs ol {
    background: transparent;
    padding-left: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: ">";
    color: #ffc107;
}

.breadcrumb-item a {
    color: #ffc107;
}

.container-fluid {
    margin-top: 20px;
}

.bg-primary {
    background-color: #007bff !important;
}

.bg-light {
    background-color: #f8f9fa !important;
    color: #343a40;
}

.bg-secondary {
    background-color: #6c757d !important;
}

.text-dark {
    color: #343a40 !important;
}

.text-light {
    color: #f8f9fa !important;
}

.btn {
    border-radius: 50px;
}

.form-control {
    border-radius: 50px;
    padding: 10px 15px;
}

.fs-1 {
    font-size: 2.5rem;
}

.fs-2 {
    font-size: 2rem;
}

.fs-5 {
    font-size: 1.25rem;
}

.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}

.pagination .page-link {
    color: #007bff;
}

.pagination .page-link:hover {
    background-color: #007bff;
    color: #fff;
}

.breadcrumb-item.active {
    color: #fff;
}

    </style>

</head>

<body class="bg-black">
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
													<li ><a href="#">Shop<i class="ti-angle-down"></i></a>
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

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="index.php" class="text-decoration-none fw-bolder text-warning">Home &nbsp; </a></li>
                <li class="fw-bold"> / Selling History</li>
            </ol>
            <h2 class="fs-2">Selling History</h2>
        </div>
    </section><!-- End Breadcrumbs -->

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center">
                <label class="form-label text-primary fw-bold fs-1">Selling History</label>
            </div>

            <div class="col-12 bg-light text-black mt-3 mb-3">
                <div class="row">
                    <div class="col-12 col-lg-3 mt-3 mb-3">
                        <label class="form-label fs-5">Search by Invoice ID: </label>
                        <input type="text" class="form-control fs-5" onkeyup="searchInvoice();" id="searchtxt" />
                    </div>
                    <div class="col-12 col-lg-2 mt-3 mb-3"></div>
                    <div class="col-12 col-lg-3 mt-3 mb-3">
                        <label class="form-label fs-5">From Date: </label>
                        <input type="date" class="form-control fs-5" id="from" />
                    </div>
                    <div class="col-12 col-lg-3 mt-3 mb-3">
                        <label class="form-label fs-5">To Date: </label>
                        <input type="date" class="form-control fs-5" id="to" />
                    </div>
                    <div class="col-12 col-lg-1 mt-3 mb-3 d-grid">
                        <button class="btn btn-primary fs-5 fw-bold" onclick="findsellings();">Find</button>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-1 bg-secondary text-end">
                        <label class="form-label fs-5 fw-bold text-white">Invoice ID</label>
                    </div>
                    <div class="col-3 bg-body text-end">
                        <label class="form-label fs-5 fw-bold text-white">Product</label>
                    </div>
                    <div class="col-3 bg-secondary text-end">
                        <label class="form-label fs-5 fw-bold text-white">Buyer</label>
                    </div>
                    <div class="col-2 bg-body text-end">
                        <label class="form-label fs-5 fw-bold text-white">Amount</label>
                    </div>
                    <div class="col-1 bg-secondary text-end">
                        <label class="form-label fs-5 fw-bold text-white">Quantity</label>
                    </div>
                    <div class="col-2 bg-white"></div>
                </div>
            </div>

            <div class="col-12 mt-2" id="viewArea">
            <?php
                if (isset($_SESSION["u"])) {
                    $mail = $_SESSION["u"]["email"];

                    $query = "SELECT invoice.*, product.title AS product_title, users.fname AS buyer_name, product.price, invoice.qty 
          FROM invoice  
          INNER JOIN users ON users.email = invoice.users_email 
          INNER JOIN product ON product.id = invoice.product_id 
          WHERE product.users_email='" . $mail . "'";

                    $pageno;

                    if (isset($_GET["page"])) {
                        $pageno = $_GET["page"];
                    } else {
                        $pageno = 1;
                    }

                    $invoice_rs = Database::search($query);
                    $invoice_num = $invoice_rs->num_rows;

                    $results_per_page = 20;
                    $number_of_pages = ceil($invoice_num / $results_per_page);

                    $page_results = ($pageno - 1) * $results_per_page;
                    $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                    $selected_num = $selected_rs->num_rows;

                    for ($x = 0; $x < $selected_num; $x++) {
                        $selected_data = $selected_rs->fetch_assoc();
                ?>
                <div class="row">
                
                    <div class="col-1 bg-secondary text-end">
                        <label class="form-label fs-5 fw-bold text-white mt-1 mb-1"><?php echo $selected_data["invoice_id"]; ?></label>
                    </div>
                    <div class="col-3 bg-body text-end">
                        <label class="form-label fs-5 fw-bold text-white mt-1 mb-1 text-truncate"><?php echo $selected_data["product_title"]; ?></label>
                    </div>
                    <div class="col-3 bg-secondary text-end">
                        <label class="form-label fs-5 fw-bold text-white mt-1 mb-1"><?php echo $selected_data["buyer_name"]; ?></label>
                    </div>
                    <div class="col-2 bg-body text-end">
                        <label class="form-label fs-5 fw-bold text-white mt-1 mb-1">Rs. <?php echo $selected_data["amount"]; ?>.00</label>
                    </div>
                    <div class="col-1 bg-secondary text-end">
                        <label class="form-label fs-5 fw-bold text-white mt-1 mb-1"><?php echo $selected_data["quantity"]; ?></label>
                    </div>

                </div>
            </div>
            <?php
                    }
                    ?>
            
            <div class="col-2 d-grid" style="margin-left: 800px;">
            <br/>
                        <button class="btn btn-success fw-bold mt-1 mb-1">Confirm Order</button>
                        <br/>
                    </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center text-right mt-2 centered">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>


<?php include "footer.php"; ?>
    <!-- Custom Script.js -->
    <script src="js/script.js"></script>
    <!-- Bootstrap.js -->
    <script src="js/bootstrap.bundle.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>
<?php

                } else {

?>
    <script>
        window.location = "signup.php";
    </script>
<?php

                }

?>