<?php
include '../conf/config.php';

// Ambil ID kategori dari parameter POST
$categoryId = $_POST["category_id"];

// Query untuk mendapatkan data sub category berdasarkan ID kategori
$sql = "SELECT sub_category FROM tb_category WHERE id = '$categoryId'";
$result = mysqli_query($koneksi, $sql);

// Mengambil data sub category
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $subCategory = $row['sub_category'];

        // Mengirimkan data sub category sebagai respons
        echo $subCategory;
    } else {
        echo "error";
    }
} else {
    echo "error";
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
