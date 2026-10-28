<?php
include '../conf/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data ID dari AJAX request
    $id = $_POST['category_id'];

    // Hapus data dari tabel category
    $query = "DELETE FROM tb_category WHERE id = '$id'";
    if (mysqli_query($koneksi, $query)) {
        echo "success";
    } else {
        echo "error";
    }

    mysqli_close($koneksi);
}
?>
