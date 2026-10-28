<?php
// koneksi ke database
include '../conf/config.php';

// mendapatkan data dari form tambah user
$nama = $_POST['nama'];
$nik = $_POST['nik'];
$jenisKelamin = $_POST['jenis_kelamin'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$level = $_POST['level'];
$password = $_POST['password'];
$tanggalBuat = date('Y-m-d'); // tanggal sekarang

// mengupload file foto
$targetDir = "../../dist/img/users/"; // direktori tempat menyimpan file foto
$fileName = basename($_FILES["foto"]["name"]); // nama file foto
$targetFile = $targetDir . $fileName; // path lengkap file foto yang diupload
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Periksa apakah file yang diunggah adalah gambar yang valid
$check = getimagesize($_FILES["foto"]["tmp_name"]);
if ($check !== false) {
  $uploadOk = 1;
} else {
  $uploadOk = 0;
}

// Periksa apakah file sudah ada
if (file_exists($targetFile)) {
  $uploadOk = 0;
}

// Periksa ukuran file
if ($_FILES["foto"]["size"] > 50000000) {
  $uploadOk = 0;
}

// Hanya izinkan format file tertentu
if (
  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"
) {
  $uploadOk = 0;
}

// Jika tidak ada kesalahan pada upload file, lakukan operasi tambah user
if ($uploadOk == 1) {
  // pindahkan file foto ke direktori tujuan
  if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
    // query untuk menambahkan user baru
    $query = "INSERT INTO tb_users (nama, nik, jk, email, alamat, level, foto, password, tgl_buat) VALUES ('$nama', '$nik', '$jenisKelamin', '$email', '$alamat', '$level', '$fileName', '$password', '$tanggalBuat')";
    $result = mysqli_query($koneksi, $query);

    // tampilkan pesan sukses atau gagal
    if ($result) {
      echo 'success';
    } else {
      echo 'error';
    }
  } else {
    echo 'error';
  }
} else {
  echo 'error';
}
