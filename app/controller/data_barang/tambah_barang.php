<?php
// Koneksi ke database
include '../conf/config.php';

// Ambil data dari AJAX request
$plu = $_POST['plu'];
$barcode = $_POST['barcode'];
$descp = $_POST['descp'];
$tag = $_POST['tag'];
$conv1 = $_POST['conv1'];
$conv2 = $_POST['conv2'];
$planogram = $_POST['planogram'];
$retur_day = $_POST['retur_day'];
$min_disp = $_POST['min_disp'];
$sub_category = $_POST['sub_category'];

// Query untuk menambahkan data barang ke database
$sql = "INSERT INTO tb_produk (plu, barcode, descp, tag, conv1, conv2, planogram, retur_day, min_disp, sub_category)
        VALUES ('$plu', '$barcode', '$descp', '$tag', '$conv1', '$conv2', '$planogram', '$retur_day', '$min_disp', '$sub_category')";

// Eksekusi query
if (mysqli_query($koneksi, $sql)) {
  // Jika data berhasil ditambahkan, kirim respons berhasil ke AJAX
  echo json_encode(array("status" => "success"));
} else {
  // Jika terjadi kesalahan pada query, kirim respons error ke AJAX
  echo json_encode(array("status" => "error", "message" => mysqli_error($koneksi)));
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
