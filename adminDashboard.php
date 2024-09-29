<?php
session_start();
include "connection.php";

if (isset($_SESSION["au"])) {
    $user = $_SESSION["au"]["email"];

    // Fetch admin details from the database
    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $user . "'");
    $admin_data = $admin_rs->fetch_assoc();
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
    <title>Trendy_tech | AdminDashboard</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/logo.png">
    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    
    <!-- StyleSheet -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
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
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Additional Custom Styles -->
    <style>
        .main-container, .block, .profile, .account, .tweets {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* Additional styles for the reports section buttons */
        .account.block.reports {
            padding: 20px;
            text-align: center;
        }
        
        .account.block.reports button {
            background-color: #3EB489;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .account.block.reports button:hover {
            background-color: #70e9bd;
        }
    </style>
    
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
    
</head>
<body onload="loadChart();">

<div class="main-container">

    <!-- HEADER -->
    <header class="block">
        <ul class="header-menu horizontal-list">
            <li>
                <a class="header-menu-tab" href="#1" ><span class="icon entypo-cog scnd-font-color"></span>Home</a>
            </li>
            <li>
                <a class="header-menu-tab" href="manageUser.php"><span class="icon fontawesome-user scnd-font-color"></span>User Management</a>
            </li>
            <li>
                <a class="header-menu-tab" href="manageProduct.php"><span class="icon fontawesome-envelope scnd-font-color"></span>Product Management</a>
            </li>
            <li>
                <a class="header-menu-tab" href="#5"><span class="icon fontawesome-star-empty scnd-font-color"></span>Stock Management</a>
            </li>
        </ul>
        <div class="profile-menu">
            <p>Me <a href="#26"><span class="entypo-down-open scnd-font-color"></span></a></p>
            <div class="profile-picture small-profile-picture">
                <img width="40px" alt="Admin Picture" src="resources/user/profile_img.svg">
            </div>
        </div>
    </header>

    <!-- LEFT-CONTAINER -->
    <div class="left-container container">
        <div class="menu-box block"> 
            <h2 class="titular">Trendy_tech</h2><br/>
            <p style="text-align: center;"> "Your One-Stop Tech Haven - Discover the Latest in Phones, Gadgets, and More!"</p>
        </div>
        <div class="donut-chart-block block"> 
            <h2 class="titular">Most Sold Products</h2>
            <div class="donut-chart">
            <canvas id="myChart"></canvas>
            </div>
            
        </div>
        <ul class="social block"> 
            <li><a href="#50"><div class="facebook icon"><span class="fa fa-facebook"></span></div><h2 class="facebook titular">SHARE TO FACEBOOK</h2></li></a>
            <li><a href="#51"><div class="twitter icon"><span class="fa fa-twitter"></span></div><h2 class="twitter titular">SHARE TO TWITTER</h2></li></a>
            <li><a href="#52"><div class="googleplus icon"><span class="fa fa-google"></span></div><h2 class="googleplus titular">SHARE TO GOOGLE+</h2></li></a>
        </ul>
    </div>

    <!-- MIDDLE-CONTAINER -->
    <div class="middle-container container">
        <div class="profile block"> 
            <div class="profile-picture big-profile-picture clear">
                <img width="150px" alt="Admin Picture" src="resources/user/profile_img.svg" >
            </div>
            <h1 class="user-name"><?php echo $admin_data['fname'] . " " . $admin_data['lname']; ?></h1>
            <p style="text-align: center;"><?php echo $admin_data['email']; ?></p>
        </div>
        <div class="account block reports"> 
            <h2 class="titular">REPORTS</h2>
            <button>View Stock Report</button>
            <button onclick="window.location='ProductReport.php';">View Product Report</button>
            <button onclick="window.location='UserReport.php';">View User Report</button>
        </div>
        
    </div>

    <!-- RIGHT-CONTAINER -->
    <div class="right-container container">
        <div class="account block" style="height: 250px;"> 
            <br/>
            <h2 class="titular">LOG OUT FROM YOUR ADMIN ACCOUNT</h2>
            <button class="sign-in button" onclick="LogOut();">LOG OUT</button>
        </div>
        <div class="tweets block" style="height: 250px;"> 
            <h2 class="titular"><span></span>Partners</h2>
            <div class="tweet first">
                <p>Asus</p>
                <p>Apple</p>
                <p>MSI</p>
                <p>Nvidia</p>
                <p>Samsung</p>
            </div>
        </div> 
    </div> <!-- end right-container -->
</div> <!-- end main-container -->

<script src="js/script.js"></script>
</body>
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