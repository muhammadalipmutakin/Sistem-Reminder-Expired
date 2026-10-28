<?php
include '../conf/config.php';

// Ambil ID barang dari parameter GET
$id = $_GET["id"];

// Query untuk mendapatkan data user dengan ID tertentu
$sql = "SELECT * FROM tb_produk WHERE id = '$id'";
$result = mysqli_query($koneksi, $sql);

// Ambil data user dan kirim sebagai response JSON
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
} else {
    echo "error";
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
