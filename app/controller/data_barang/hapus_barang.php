<?php
// koneksi database
require_once "../conf/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];

  // hapus data user
  $query = "DELETE FROM tb_produk WHERE id = '$id'";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    echo "success";
  } else {
    echo "error";
  }
}
?>
