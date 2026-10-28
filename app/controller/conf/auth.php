<?php
session_start();
include('config.php');
$nik = $_POST['nik'];
$password = $_POST['password'];

if (empty($nik) || empty($password)) {
    $_SESSION['error_message'] = 'Kolom username atau password tidak boleh kosong.';
    header('Location: ../../../index.php?error=2', true, 303);
    exit;
}

if (!ctype_digit($nik)) {
    $_SESSION['error_message'] = 'Format NIK tidak valid. NIK harus terdiri dari angka.';
    header('Location: ../../../index.php?error=1', true, 303);
    exit;
}

$query = mysqli_query($koneksi, "SELECT * FROM tb_users WHERE nik = '$nik' AND password = '$password'");
if (mysqli_num_rows($query) == 1) {
    $user = mysqli_fetch_array($query);
    $_SESSION['id'] = $user['id'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['level'] = $user['level'];
    $_SESSION['foto'] = $user['foto']; // Menyimpan 'foto' ke dalam session

    unset($_SESSION['error_message']);
    header('Location: ../../', true, 303);
    exit;
} else {
    // Menghapus session saat login gagal
    unset($_SESSION['id']);
    unset($_SESSION['nama']);
    unset($_SESSION['level']);
    $_SESSION['error_message'] = 'NIK atau password salah. Silakan coba lagi.';
    header('Location: ../../../index.php?error=1', true, 303);
    exit;
}

// Menghapus pesan kesalahan saat mengakses halaman login tanpa melakukan submit form
if (!isset($_POST['nik']) && !isset($_POST['password'])) {
    unset($_SESSION['error_message']);
}
