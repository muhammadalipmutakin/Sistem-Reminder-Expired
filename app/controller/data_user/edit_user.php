<?php
// koneksi ke database
include '../conf/config.php';

// mendapatkan data dari form edit user
$id = $_POST['id'];
$nik = $_POST['nik'];
$nama = $_POST['nama'];
$jenisKelamin = $_POST['jenis_kelamin'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$level = $_POST['level'];

// query untuk memperbarui data pengguna
$query = "UPDATE tb_users SET nik='$nik', nama='$nama', jk='$jenisKelamin', email='$email', alamat='$alamat', level='$level' WHERE id=$id";
$result = mysqli_query($koneksi, $query);

// tampilkan pesan sukses atau gagal
if ($result) {
  echo 'success';
} else {
  echo 'error';
}
?>
