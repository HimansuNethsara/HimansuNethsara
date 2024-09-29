<?php

session_start();
include "connection.php";
 if (isset($_SESSION["au"])) {

    $query = "SELECT product.id, product.title, product.datetime_added, product.description, status.status_name, product.qty, product.price 
          FROM product 
          INNER JOIN status ON product.status_status_id = status.status_id";

    $product_rs = Database::search($query);
    $Product_num = $product_rs->num_rows;

    function limit_words($text, $limit) {
        $words = explode(" ", $text);
        if (count($words) > $limit) {
            return implode(" ", array_slice($words, 0, $limit)) . "...";
        } else {
            return $text;
        }
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
    <title>Product Report Document</title>
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

        .btn-outline-success {
            background-color: #3EB489;
            border: none;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            display: inline-block;
            cursor: pointer;
            text-align: center;
        }

        .btn-outline-success:hover {
            background-color: #218838;
            transform: scale(1.05);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-success:active {
            background-color: #1e7e34;
            transform: scale(1);
        }

        .btn-outline-success:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.5);
        }
        .product-image {
            max-width: 100px; /* Adjust the width as needed */
            height: auto; /* Maintain aspect ratio */
            display: block;
            margin: 0 auto; /* Center the image */
        }
        .table .image {
            width: 120px; /* Adjust as needed */
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
                                <li><i class="ti-headphone-alt"></i></li>
                                <li><i class="ti-email"></i>
                                <span class="text-lg-start"><b>Welcome </b><?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></span>
                                </li>
                            </ul>
                        </div>
                        <!--/ End Top Left -->
                    </div>
                    <div class="col-lg-7 col-md-12 col-12">
                        <!-- Top Right -->
                        <div class="right-content">
                            
                        </div>
                        <!-- End Top Right -->
                    </div>
                </div>
            </div>
        </div>
    <!-- End Topbar -->
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="adminDashboard.php">Admin Dashboard<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="watchlist.php">Product Report</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    
    <div class="shopping-cart section" id="printArea">
        <div class="container">
        <h1 class="report-title">Product Report</h1>
            <div class="row">
                <div class="col-12">
                    
                    <!-- Document -->
                    <table class="table shopping-summery">
                        <thead>
                            <tr class="main-hading">
                                <th> Id</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Item Per Price</th>

                                <th>Added Date</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                for ($i = 0; $i < $Product_num; $i++) {
                                    $d = $product_rs->fetch_assoc();

                                ?>
                            <tr>
                        
                                <td style="text-align: center;"><span><?php echo $i + 1; ?></span></td>
                                <td style="text-align: center;"><span><?php echo $d["title"]; ?></span></td>
                                <td style="text-align: center;"><span><?php echo $d["qty"]; ?></span></td>
                                <td style="text-align: center;"><span>Rs. <?php echo $d["price"]; ?></span></td>
                                <td style="text-align: center;"><span><?php echo $d["datetime_added"]; ?></span></td>
                                <td style="text-align: center;"><span><?php echo limit_words($d["description"], 20); ?></span></td>
                                <td style="text-align: center;"><span><?php echo $d["status_name"]; ?></span></td>

                                <?php
                                    $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $d["id"] . "'");
                                    $image_num = $image_rs->num_rows;
                                    $image_data = $image_rs->fetch_assoc();
                                ?>

                                <td class="image" data-title="No">
                                    <img src="<?php echo $image_data["img_path"]; ?>" class="product-image">
                                </td>
                            </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                    <!--/ End Document -->
                    
                </div>
            </div>

        </div>
    </div>
    <div class="d-flex justify-content-center mt-5 mb-5"> <!-- Add this div -->
        <button class="btn text-white btn-outline-success" onclick="printDiv();">Print</button>
    </div>

    <br/><br/>
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

    <!-- Active JS -->
    <script src="js/active.js"></script>
    <script src="js/script.js"></script>
    

</body>
</head>
</html>
<?php

 } else {
?>
<div class="d-flex flex-column align-items-center mt-5">
    <style>
        .btn-outline-success {
            background-color: #3EB489;
            border: none;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            display: inline-block;
            cursor: pointer;
            text-align: center;
        }

        .btn-outline-success:hover {
            background-color: #218838;
            transform: scale(1.05);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-success:active {
            background-color: #1e7e34;
            transform: scale(1);
        }

        .btn-outline-success:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.5);
        }
    </style>

    <div class="error-container" style="display: flex; flex-direction: column; align-items: center; justify-content: center; margin-top: 5rem; text-align: center; padding: 2rem;
    background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 500px; margin-left: auto; margin-right: auto;">
        <img src="resources/error.png" alt="Not Found Image" >
        <h1 style="font-size: 2.5rem; color: #3EB489; margin-bottom: 0.5rem;">Error</h1>
        <h4 style="    font-size: 1.25rem;color: #6c757d;margin-bottom: 1.5rem;">Sorry, You are not a Valid Admin</h4>
        <button class="btn text-white btn-outline-success" onclick="window.location='index.php';">Back To Home</button>
    </div>

</div>
<?php
 }

?>