<?php
// Koneksi ke database
include '../conf/config.php';

// Ambil data dari AJAX request
$subCategory = $_POST['sub_category'];
$category = $_POST['category'];

// Query untuk menambahkan data kategori ke database
$query = "INSERT INTO tb_category (sub_category, category) VALUES ('$subCategory', '$category')";

// Eksekusi query
if ($koneksi->query($query)) {
  // Jika data berhasil ditambahkan, kirim respons berhasil ke AJAX
  echo 'success';
} else {
  // Jika terjadi kesalahan pada query, kirim respons error ke AJAX
  echo 'error';
}

// Tutup koneksi ke database
$koneksi->close();
?>
