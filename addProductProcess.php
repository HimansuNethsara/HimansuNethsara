<?php
session_start();
require "connection.php";

// Check if the session contains the required user email
if (!isset($_SESSION["u"]["email"])) {
    die("User is not logged in.");
}

$email = $_SESSION["u"]["email"];

// Capture POST data
$category = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["con"];
$clr = $_POST["col"];
$qty = $_POST["qty"];
$cost = $_POST["cost"];
$tags = $_POST["tags"];
$spec = $_POST["spec"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["desc"];

// Debugging: print the received data
echo "Received Data:<br>";
echo "Category: $category<br>";
echo "Brand: $brand<br>";
echo "Model: $model<br>";
echo "Title: $title<br>";
echo "Condition: $condition<br>";
echo "Color: $clr<br>";
echo "Quantity: $qty<br>";
echo "Cost: $cost<br>";
echo "Tags: $tags<br>";
echo "Specification: $spec<br>";
echo "Delivery Fee Colombo: $dwc<br>";
echo "Delivery Fee Other: $doc<br>";
echo "Description: $desc<br>";

// Check if brand and model exists in the database
$mhb_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id`='".$model."' AND `brand_brand_id`='".$brand."'");

if($mhb_rs === false) {
    die("Error in search query: " . Database::$connection->error);
}

$mhb_id;

if($mhb_rs->num_rows > 0){
    $mhb_data = $mhb_rs->fetch_assoc();
    $mhb_id = $mhb_data["id"];
} else {
    // Insert new brand-model relationship
    $insert_result = Database::iud("INSERT INTO `model_has_brand`(`model_model_id`,`brand_brand_id`) VALUES ('".$model."','".$brand."')");
    if($insert_result === false) {
        die("Error inserting brand-model relationship: " . Database::$connection->error);
    }
    $mhb_id = Database::$connection->insert_id;
}

// Get the current date and time
$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$status = 1;

// Insert product data
$product_insert_result = Database::iud("INSERT INTO `product`(`price`,`qty`,`description`,`product_specification`,`product_tags`,`title`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`,`category_cat_id`,`model_has_brand_id`,`color_clr_id`,`status_status_id`,`condition_condition_id`,`users_email`) VALUES ('".$cost."','".$qty."','".$desc."','".$spec."','".$tags."','".$title."','".$date."','".$dwc."','".$doc."','".$category."','".$mhb_id."','".$clr."','".$status."','".$condition."','".$email."')");

if($product_insert_result === false) {
    die("Error inserting product: " . Database::$connection->error);
}

$product_id = Database::$connection->insert_id;

$length = count($_FILES);

// Debugging: print the number of files
echo "Number of files: $length<br>";

if($length <= 2 && $length > 0){
    $allowed_img_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

    for($x = 0; $x < $length; $x++){
        if(isset($_FILES["img".$x])){
            $img_file = $_FILES["img".$x];
            $file_extension = $img_file["type"];

            if(in_array($file_extension, $allowed_img_extensions)){
                $new_img_extension = pathinfo($img_file["name"], PATHINFO_EXTENSION);
                $file_name = "resources/products/".$title."_".$x."_".uniqid().".".$new_img_extension;
                if(move_uploaded_file($img_file["tmp_name"], $file_name)){
                    $img_insert_result = Database::iud("INSERT INTO `product_img`(`img_path`,`product_id`) VALUES ('".$file_name."','".$product_id."')");
                    if($img_insert_result === false) {
                        die("Error inserting product image: " . Database::$connection->error);
                    }
                    echo "Image uploaded successfully: $file_name<br>";
                } else {
                    echo "Error moving uploaded file: " . $img_file["name"] . "<br>";
                }
            } else {
                echo "Not an allowed image type: " . $file_extension . "<br>";
            }
        }
    }
    echo "success";
} else {
    echo "Invalid Image Count<br>";
}
?>
