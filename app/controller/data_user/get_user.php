<?php
// koneksi ke database
include '../conf/config.php';

// ambil ID pengguna dari parameter
$id = $_GET['id'];

// query untuk mendapatkan data pengguna berdasarkan ID
$query = "SELECT * FROM tb_users WHERE id = $id";
$result = mysqli_query($koneksi, $query);

if ($result) {
  // konversi data pengguna menjadi array
  $user = mysqli_fetch_assoc($result);

  // kirimkan data pengguna sebagai respon JSON
  echo json_encode(array('status' => 'success', 'data' => $user));
} else {
  // jika terjadi kesalahan saat mengambil data pengguna
  echo json_encode(array('status' => 'error'));
}
?>
