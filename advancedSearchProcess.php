<!DOCTYPE html>
<html lang="eng">

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
    </style>
</head>

<body>
<?php
require "connection.php";

$search_txt = $_POST["t"];
$category = $_POST["cat"];
$brand = $_POST["b"];
$model = $_POST["mo"];
$condition = $_POST["con"];
$color = $_POST["col"];
$price_from = $_POST["pf"];
$price_to = $_POST["pt"];
$sort = $_POST["s"];

$query = "SELECT * FROM `product`";
$conditions = [];
$status = 0;

if (!empty($search_txt)) {
    $conditions[] = "`title` LIKE '%" . $search_txt . "%'";
}

if ($category != 0) {
    $conditions[] = "`category_cat_id` = '" . $category . "'";
}

if ($brand != 0 && $model == 0) {
    $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id` = '" . $brand . "'");
    $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
    $pid = $model_has_brand_data["id"];
    $conditions[] = "`model_has_brand_id` = '" . $pid . "'";
}

if ($brand == 0 && $model != 0) {
    $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id` = '" . $model . "'");
    $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
    $pid = $model_has_brand_data["id"];
    $conditions[] = "`model_has_brand_id` = '" . $pid . "'";
}

if ($brand != 0 && $model != 0) {
    $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id` = '" . $brand . "' AND `model_model_id` = '" . $model . "'");
    $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
    $pid = $model_has_brand_data["id"];
    $conditions[] = "`model_has_brand_id` = '" . $pid . "'";
}

if ($condition != 0) {
    $conditions[] = "`condition_condition_id` = '" . $condition . "'";
}

if ($color != 0) {
    $conditions[] = "`color_clr_id` = '" . $color . "'";
}

if (!empty($price_from) && empty($price_to)) {
    $conditions[] = "`price` >= '" . $price_from . "'";
} elseif (empty($price_from) && !empty($price_to)) {
    $conditions[] = "`price` <= '" . $price_to . "'";
} elseif (!empty($price_from) && !empty($price_to)) {
    $conditions[] = "`price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
}

if ($conditions) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

if ($sort == 1) {
    $query .= " ORDER BY `price` ASC";
} elseif ($sort == 2) {
    $query .= " ORDER BY `price` DESC";
} elseif ($sort == 3) {
    $query .= " ORDER BY `qty` ASC";
} elseif ($sort == 4) {
    $query .= " ORDER BY `qty` DESC";
}

if ($_POST["page"] != "0") {
    $pageno = $_POST["page"];
} else {
    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 6;
$number_of_pages = ceil($product_num / $results_per_page);

$viewed_results_count = ((int)$pageno - 1) * $results_per_page;

$query .= " LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count;
$results_rs = Database::search($query);
$results_num = $results_rs->num_rows;

while ($results_data = $results_rs->fetch_assoc()) {
?>
    <div class="card mb-3 mt-3 col-12 col-lg-6">
        <div class="row">
            <div class="col-md-4 mt-4">
                <img src="resources/mobile_images/iphone12.jpg" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?php echo $results_data["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold"><?php echo $results_data["price"]; ?></span>
                    <br />
                    <span class="card-text text-success fw-bold fs">10 Items Left</span>
                    <div class="row">
                        <div class="col-12">
                            <div class="row g-1">
                                <div class="col-12 col-lg-6 d-grid">
                                    <a href="#" class="btn btn-success fs">Buy Now</a>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <a href="#" class="btn btn-danger fs">Add Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div></div>
<?php
}
?>
<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center" style="margin-top: 20px;">
            <li class="page-item" style="margin: 0 5px;">
                <a class="page-link" style="border-radius: 50%; padding: 10px 20px; color: #007bff;" <?php if ($pageno <= 1) {
                    echo ("href='#'");
                } else { ?>
                    onclick="advancedSearch('<?php echo ($pageno - 1); ?>');" style="cursor: pointer;"
                <?php } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php
            for ($y = 1; $y <= $number_of_pages; $y++) {
                if ($y == $pageno) {
            ?>
                    <li class="page-item active" style="margin: 0 5px;">
                        <a class="page-link" style="border-radius: 50%; padding: 10px 20px; background-color: #007bff; color: #ffffff;" onclick="advancedSearch('<?php echo ($y); ?>');"><?php echo $y; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item" style="margin: 0 5px;">
                        <a class="page-link" style="border-radius: 50%; padding: 10px 20px; color: #007bff;" onclick="advancedSearch('<?php echo ($y); ?>');"><?php echo $y; ?></a>
                    </li>
            <?php
                }
            }
            ?>

            <li class="page-item" style="margin: 0 5px;">
                <a class="page-link" style="border-radius: 50%; padding: 10px 20px; color: #007bff;" <?php if ($pageno >= $number_of_pages) {
                    echo ("href='#'");
                } else { ?>
                    onclick="advancedSearch('<?php echo ($pageno + 1); ?>');" style="cursor: pointer;"
                <?php } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>


<!-- Jquery -->
<script src="js/script.js"></script>
</body>
</html>
