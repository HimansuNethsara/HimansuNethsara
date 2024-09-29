<?php

session_start();
include "connection.php";
 if (isset($_SESSION["au"])) {

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
    <title>Manage Users | Admins | Trendy_tech</title>
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
    .category-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 3rem;
    }

    .category-item {
        width: 100%;
        max-width: 300px;
        border: 1px solid #dc3545;
        border-radius: 0.5rem;
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
        background-color: #f8d7da; /* Optional background color */
    }

    .category-item:last-child {
        margin-bottom: 0;
    }

    .category-name {
        font-weight: bold;
        font-size: 1rem;
        color: black;
    }

    .add-category {
        width: 100%;
        max-width: 300px;
        border: 1px solid #28a745;
        border-radius: 0.5rem;
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
        background-color: #3EB489; /* Optional background color */
    }

    .add-category:hover {
        background-color: #c3e6cb; /* Optional hover background color */
        cursor: pointer;
    }

    .add-category-label {
        font-weight: bold;
        font-size: 1.25rem;
        color: #28a745;
    }

    .add-category-icon {
        font-size: 1.5rem;
        color: #28a745;
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
                            <a class="nav-link  text-dark" style="cursor: pointer;" onclick="LogOut();"><i class="uil uil-signout" ></i>Log Out </a>
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
                            <li class="active"><a href="manageUser.php">Users Management</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    
    <div class="shopping-cart section">
        <div class="container">
        <h1 class="report-title">Users Management</h1>
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                            <div class="row">
                                <div class="col-8">
                                    <input type="text" class="form-control-1" style="width: 350px;" />
                                </div>
                                <div class="col-4 d-grid">
                                    <button class="btn btn-warning">Search User</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    
                    <!-- Document -->
                    <table class="table shopping-summery">
                        <thead>
                            <tr class="main-hading">
                                <th>#</th>
                                <th>Profile Image</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Registered Date</th>
                                <th>Mobile</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $query = "SELECT * FROM `users`";
                            $pageno;

                            if (isset($_GET["page"])) {
                                $pageno = $_GET["page"];
                            } else {
                                $pageno = 1;
                            }

                            $user_rs = Database::search($query);
                            $user_num = $user_rs->num_rows;

                            $results_per_page = 6;
                            $number_of_pages = ceil($user_num / $results_per_page);

                            $page_results = ($pageno - 1) * $results_per_page;
                            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                            $selected_num = $selected_rs->num_rows;

                            for ($x = 0; $x < $selected_num; $x++) {
                                $selected_data = $selected_rs->fetch_assoc();
                            ?>


                            <tr>
                                <td style="text-align: center;"><span><?php echo $x + 1; ?></span></td>
                                <td class="image" data-title="No">
                                <?php
                                    $profile_img_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $selected_data["email"] . "'");
                                    $profile_img_num = $profile_img_rs->num_rows;
                                    if ($profile_img_num == 1) {
                                        $profile_img_data = $profile_img_rs->fetch_assoc();
                                    ?>
                                        <img src="<?php echo $profile_img_data["path"]; ?>" style="height: 180px; width:80px;" />
                                    <?php
                                        } else {
                                    ?>
                                        <img src="resources/home/phone.png" style="height: 80px; width:80px;" />
                                    <?php
                                    }

                                    ?>
                                </td>
                                <td style="text-align: center;"><span><?php echo $selected_data["email"]; ?></span></td>
                                <td style="text-align: center;"><span><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></span></td>
                                <td style="text-align: center;"><span><?php echo $selected_data["joined_date"]; ?></span></td>
                                <td style="text-align: center;"><span><?php echo $selected_data["mobile"]; ?></span></td>
                                    <div class="col-12 d-none" id="msgdiv1">
                                        <div class="alert alert-danger" role="alert" id="msg1">

                                        </div>
                                    </div>
                                <td style="text-align: center;">
                                <?php
                                        if ($selected_data["status"] == 1) {
                                        ?>
                                            <button id="ub<?php echo $selected_data["email"]; ?>" onclick="blockUser('<?php echo $selected_data['email']; ?>');" class="col-12 btn btn-danger">Block
                                            </button>
                                        <?php
                                        } else {
                                        ?>
                                            <button class=" col-12 btn btn-success" id="ub<?php echo $selected_data["email"]; ?>" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Unblock</button>
                                        <?php
                                        }

                                        ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <!--/ End Document -->

                    <!-- Pagination -->
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

                    <!--/ End Pagination -->
                </div>
            </div>
        </div>
               

    </div>
    
   

    <br/><br/>
    <?php include "footer.php"; ?>
    <!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/jquery-ui.min.js"></script>

    <!-- Active JS -->
    <script src="js/active.js"></script>
    <script src="js/script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    

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