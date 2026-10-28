<?php
include '../conf/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['category_id'])) {
        $categoryId = $_POST['category_id'];
        $subCategory = $_POST['sub_category'];
        $category = $_POST['category'];

        $query = "UPDATE tb_category SET sub_category='$subCategory', category='$category' WHERE id='$categoryId'";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            echo "success";
        } else {
            echo "error";
        }
    }
}

mysqli_close($koneksi);
?>
