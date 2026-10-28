<?php
// Koneksi ke database
include '../conf/config.php';

// Mendapatkan ID pengguna dari kiriman form
$userId = $_POST['userId'];

// Mendapatkan data foto yang diunggah
$photo = $_FILES['photo'];

// Mengambil data pengguna berdasarkan ID pengguna
$query = "SELECT * FROM tb_users WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, 'i', $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
  $user = mysqli_fetch_assoc($result);
  $existingPhoto = $user['foto']; // Foto pengguna yang sudah ada sebelumnya
} else {
  // Jika pengguna tidak ditemukan, keluarkan pesan error
  echo 'error';
  exit();
}

// Direktori tujuan penyimpanan foto
$targetDirectory = '../../dist/img/users/';
$targetFile = $targetDirectory . basename($photo['name']);
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Cek apakah file yang diunggah adalah gambar
$check = getimagesize($photo['tmp_name']);
if ($check === false) {
  echo 'error';
  exit();
}

// Batasi jenis file yang diizinkan (dalam contoh ini hanya gambar)
$allowedExtensions = array('jpg', 'jpeg', 'png');
if (!in_array($imageFileType, $allowedExtensions)) {
  echo 'error';
  exit();
}

// Menghapus foto sebelumnya (jika ada)
if (!empty($existingPhoto)) {
  $existingFilePath = $targetDirectory . $existingPhoto;
  if (file_exists($existingFilePath)) {
    unlink($existingFilePath);
  }
}

// Simpan foto baru ke direktori tujuan
if (move_uploaded_file($photo['tmp_name'], $targetFile)) {
  // Update record pengguna dengan nama foto baru
  $newPhoto = basename($photo['name']);
  $query = "UPDATE tb_users SET foto=? WHERE id=?";
  $stmt = mysqli_prepare($koneksi, $query);
  mysqli_stmt_bind_param($stmt, 'si', $newPhoto, $userId);
  $result = mysqli_stmt_execute($stmt);

  if ($result) {
    // Mengirimkan nama foto baru ke front-end untuk pratinjau
    echo $newPhoto;
  } else {
    echo 'error';
  }
} else {
  echo 'error';
}
?>
