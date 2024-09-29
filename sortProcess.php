<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="css/styles.css">

    <style>
        .product__item {
            margin-bottom: 30px;
            padding: 5px;
            border: 1px solid #eaeaea;
            background-color: #fff;
            box-sizing: border-box;
            overflow: hidden;
            flex: 1 1 calc(33.333% - 40px); /* Increased width to 33.333% */
        }

        .product__item__pic {
            position: relative;
            overflow: hidden;
            height: 300px;
            margin-bottom: 10px;
        }

        .product__item__pic img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product__item__text {
            text-align: center;
        }

        .product__item__pic__hover {
            position: absolute;
            top: 10px;
            right: 10px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .product__item__pic__hover li {
            display: inline-block;
            margin-left: 10px;
        }

        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Adjust gap between items */
            justify-content: center; /* Center the grid items */
        }

    </style>
</head>
<body>

<?php
session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];

$search = isset($_POST["s"]) ? $_POST["s"] : '';
$time = isset($_POST["t"]) ? $_POST["t"] : '0';
$qty = isset($_POST["q"]) ? $_POST["q"] : '0';
$condition = isset($_POST["c"]) ? $_POST["c"] : '0';

$query = "SELECT * FROM `product` WHERE `users_email`='" . $email . "' ";

if (!empty($search)) {
    $query .= " AND `title` LIKE '%" . $search . "%'";
}

if ($condition != "0") {
    $query .= " AND `condition_condition_id`='" . $condition . "'";
}

if ($time != "0") {
    if ($time == "1") {
        $query .= " ORDER BY `datetime_added` DESC";
    } else if ($time == "2") {
        $query .= " ORDER BY `datetime_added` ASC";
    }
}

if ($qty != "0") {
    if ($qty == "1") {
        $query .= " ORDER BY `qty` DESC";
    } else if ($qty == "2") {
        $query .= " ORDER BY `qty` ASC";
    }
}

if ($time != "0" && $qty != "0") {
    if ($qty == "1") {
        $query .= " , `qty` DESC";
    } else if ($qty == "2") {
        $query .= " , `qty` ASC";
    }
}

$pageno = isset($_POST["page"]) ? (int)$_POST["page"] : 1;
if ($pageno < 1) {
    $pageno = 1;
}

$results_per_page = 4;
$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$number_of_pages = ceil($product_num / $results_per_page);
$page_results = ($pageno - 1) * $results_per_page;
if ($page_results < 0) {
    $page_results = 0;
}

$final_query = $query . " LIMIT " . $results_per_page . " OFFSET " . $page_results;

$selected_rs = Database::search($final_query);
$selected_num = $selected_rs->num_rows;

?>

<div class="offset-1 col-10 text-center">
    <div class="row justify-content-center">
        <?php
        for ($x = 0; $x < $selected_num; $x++) {
            $selected_data = $selected_rs->fetch_assoc();
        ?>

        <!-- card -->
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="product__item">
                <div class="product__item__pic">
                    <?php
                    $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                    $product_img_data = $product_img_rs->fetch_assoc();
                    ?>
                    <img src="<?php echo $product_img_data["img_path"]; ?>" class="img-fluid" />
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
                            <?php }else{ ?>
                                <span class="deactivate-text">Deactivate Product</span>
                            <?php } ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- card -->

        <?php
        }
        ?>
    </div>
</div>

<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center" style="margin-top: 20px;">
            <li class="page-item" style="margin: 0 5px;">
                <a class="page-link" style="border-radius: 50%; padding: 10px 20px; color: #007bff;" <?php if ($pageno <= 1) {
                    echo ("href='#'");
                } else { ?>
                    onclick="sort(<?php echo ($pageno - 1); ?>);" style="cursor: pointer;"
                <?php } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php
            for ($y = 1; $y <= $number_of_pages; $y++) {
                if ($y == $pageno) {
            ?>
                    <li class="page-item active" style="margin: 0 5px;">
                        <a class="page-link" style="border-radius: 50%; padding: 10px 20px; background-color: #007bff; color: #ffffff;" onclick="sort(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item" style="margin: 0 5px;">
                        <a class="page-link" style="border-radius: 50%; padding: 10px 20px; color: #007bff;" onclick="sort(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                    </li>
            <?php
                }
            }
            ?>

            <li class="page-item" style="margin: 0 5px;">
                <a class="page-link" style="border-radius: 50%; padding: 10px 20px; color: #007bff;" <?php if ($pageno >= $number_of_pages) {
                    echo ("href='#'");
                } else { ?>
                    onclick="sort(<?php echo ($pageno + 1); ?>);" style="cursor: pointer;"
                <?php } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

</body>

</html>
