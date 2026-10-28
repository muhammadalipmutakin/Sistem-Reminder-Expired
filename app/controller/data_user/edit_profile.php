<?php
// Koneksi ke database
include '../conf/config.php';

// Mendapatkan data dari form edit user
$id = $_POST['id'];
$nama = $_POST['nama'];
$jenisKelamin = $_POST['jk'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$level = $_POST['level'];

// Query untuk memperbarui data pengguna
$query = "UPDATE tb_users SET nama='$nama', jk='$jenisKelamin', email='$email', alamat='$alamat', level='$level', tgl_update=NOW() WHERE id=$id";
$result = mysqli_query($koneksi, $query);

// Tampilkan pesan sukses atau gagal
if ($result) {
  echo 'Sukses';
} else {
  echo 'Gagal';
}
?>

