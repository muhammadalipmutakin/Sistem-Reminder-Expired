<?php
// koneksi database
require_once "../conf/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];

  // Dapatkan nama file foto sebelum menghapus data user
  $query = "SELECT foto FROM tb_users WHERE id = '$id'";
  $result = mysqli_query($koneksi, $query);
  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $foto = $row['foto'];

    // Hapus data user
    $queryDelete = "DELETE FROM tb_users WHERE id = '$id'";
    $resultDelete = mysqli_query($koneksi, $queryDelete);

    if ($resultDelete) {
      // Hapus foto dari direktori
      $targetFile = "../../dist/img/users/" . $foto;
      if (unlink($targetFile)) {
        echo "success";
      } else {
        echo "error";
      }
    } else {
      echo "error";
    }
  } else {
    echo "error";
  }
}
?>
