<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="css/styles.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .product-section .card {
            width: 400px; /* Set the width of the card */
            height: 600px; /* Set the height of the card */
            background-color: #fff;
            border: 1px solid #eaeaea;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            margin: 40px;
        }

        .product-section .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
 
<section class="product-section">
    <?php
    require "connection.php";

    $text = $_POST["t"];
    $select = $_POST["s"];

    $query = "SELECT * FROM `product`";

    if (!empty($text) && $select == 0) {
        $query .= " WHERE `title` LIKE '%" . $text . "%'";
    } else if (empty($text) && $select != 0) {
        $query .= " WHERE `category_cat_id`='" . $select . "'";
    } else if (!empty($text) && $select != 0) {
        $query .= " WHERE `title` LIKE '%" . $text . "%' AND `category_cat_id`='" . $select . "'";
    }

    ?>
    <div class="offset-1 col-10 text-center">
        <div class="product-grid">

            <?php
            if ("0" != $_POST["page"]) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 3;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results);

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

                $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                $product_img_data = $product_img_rs->fetch_assoc();
            ?>

            <!-- card -->
            <div class="col-xl-3 col-lg-4 col-md-4 col-12 mb-4">
            <div class="single-product card">
                <div class="product-img">
                    <a href="singleProductView.php">
                        <img class="default-img" src="<?php echo $product_img_data["img_path"]; ?>" alt="#">
                        <img class="hover-img" src="<?php echo $product_img_data["img_path"]; ?>" alt="#">
                    </a>
                    <div class="button-head">
                        <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View"><i class="ti-eye"></i><span>Quick Shop</span></a>
                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Add to Wishlist</span></a>
                        </div>
                        <div class="product-action-2">
                            <a title="Add to cart" href="#">Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="product-content">
                    <h3><a href="product-details.html"><?php echo $selected_data["title"]; ?></a></h3>
                    <div class="product-price">
                        <span>Rs. <?php echo $selected_data["price"]; ?></span><br/>
                        <span class="card-text text-warning fw-bold">In Stock</span><br />
                        <span class="card-text text-success fw-bold"><?php echo $selected_data["qty"]; ?> Items Available</span><br />
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
</section>

</body>

</html>