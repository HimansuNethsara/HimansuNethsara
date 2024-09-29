<?php

require "connection.php";

if (isset($_GET["b"])) {
    $brand_id = $_GET["b"];

    // Query to get the models related to the brand
    $brandrs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id`='" . $brand_id . "'");

    if ($brandrs) {
        $brand_num = $brandrs->num_rows;

        if ($brand_num > 0) {
            for ($x = 0; $x < $brand_num; $x++) {
                $brand_data = $brandrs->fetch_assoc();
                $model_rs = Database::search("SELECT * FROM `model` WHERE `model_id`='" . $brand_data["model_model_id"] . "'");
                if ($model_rs) {
                    $model_data = $model_rs->fetch_assoc();
                    echo "<option value='{$model_data["model_id"]}'>{$model_data["model_name"]}</option>";
                } else {
                    echo "<option value='0'>No models found</option>";
                }
            }
        } else {
            echo "<option value='0'>No models found for this brand</option>";
        }
    } else {
        echo "<option value='0'>Brand query failed</option>";
    }
}

?>
