<?php
include '../conf/config.php';

// Get the category ID from the GET parameter
$category_id = $_GET["category_id"];

// Query to retrieve category data with the specified ID
$sql = "SELECT * FROM tb_category WHERE id = $category_id";
$result = $koneksi->query($sql);

// Check if category data is found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $sub_category = $row['sub_category'];
    $category = $row['category'];

    // Send category data as response
    echo $sub_category . ',' . $category;
} else {
    echo 'false';
}

// Close the database connection
$koneksi->close();
