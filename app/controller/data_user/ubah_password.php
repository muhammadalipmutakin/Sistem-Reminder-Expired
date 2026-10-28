<?php
// Koneksi ke database
include '../conf/config.php';

// Mendapatkan data dari permintaan Ajax
$id = $_POST['id'];
$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];

// Periksa apakah password baru dan konfirmasi password sama
if ($newPassword !== $confirmPassword) {
    echo "Konfirmasi password tidak sesuai. Silakan coba lagi.";
    exit;
}

// Periksa kecocokan password saat ini dengan yang ada di database
$query = "SELECT password FROM tb_users WHERE id = $id";
$result = mysqli_query($koneksi, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $validCurrentPassword = $row['password'];
    if ($currentPassword !== $validCurrentPassword) {
        echo "Password saat ini salah. Silakan coba lagi.";
        exit;
    }
} else {
    echo "Terjadi kesalahan saat memeriksa password saat ini.";
    exit;
}

// Update password baru ke database berdasarkan ID
$query = "UPDATE tb_users SET password = '$newPassword' WHERE id = $id";
$result = mysqli_query($koneksi, $query);

// Periksa apakah pengubahan password berhasil
if ($result) {
    echo "Password berhasil diubah.";
} else {
    echo "Terjadi kesalahan. Password gagal diubah.";
}
?>
