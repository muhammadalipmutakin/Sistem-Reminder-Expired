<?php
include '../conf/config.php';

session_start();
$user_confirm = isset($_SESSION['nama']) ? $_SESSION['nama'] : '';

$id = isset($_POST['id']) ? $_POST['id'] : '';
$checkDisplay = isset($_POST['checkDisplay']) ? $_POST['checkDisplay'] : '';
$keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';

// Dapatkan tanggal dan waktu saat ini
$currentDateTime = date('Y-m-d H:i:s');

// Ambil data dari tabel tb_inputexpired berdasarkan ID
$query = "SELECT * FROM tb_inputexpired WHERE id = '$id'";
$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Dapatkan data yang diperlukan dari tb_inputexpired
    $plu = $row['plu'];
    $tgl_expired = $row['tgl_expired'];
    $tgl_tarik = $row['tgl_tarik'];
    $jml_expired = $row['jml_expired'];
    $planogram = $row['planogram'];
    $tgl_input = $row['tgl_input'];
    $user_input = $row['user_input'];

    if ($row['tgl_tarik'] <= $currentDateTime && $row['tgl_expired'] >= $currentDateTime) {
        $status = 'barang memasuki masa retur';
    } elseif ($row['tgl_expired'] < $currentDateTime) {
        $status = 'barang sudah kedaluwarsa';
    } else {
        $status = 'barang dalam kondisi normal';
    }

    // Simpan data ke tabel tb_laporan
    $insertQuery = "INSERT INTO tb_laporan (tgl_confirm, status, status_disp, keterangan, user_confirm, tgl_expired, tgl_tarik, jml_expired, planogram, tgl_input, plu, user_input) 
                    VALUES ('$currentDateTime', '$status', '$checkDisplay', '$keterangan', '$user_confirm', '$tgl_expired', '$tgl_tarik', '$jml_expired', '$planogram', '$tgl_input', '$plu', '$user_input')";
    $insertResult = $koneksi->query($insertQuery);

    if ($insertResult) {
        // Hapus data dari tb_inputexpired
        $deleteQuery = "DELETE FROM tb_inputexpired WHERE id = '$id'";
        $deleteResult = $koneksi->query($deleteQuery);

        if ($deleteResult) {
            $response = array('status' => 'success');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error');
            echo json_encode($response);
        }
    } else {
        $response = array('status' => 'error');
        echo json_encode($response);
    }
} else {
    $response = array('status' => 'error');
    echo json_encode($response);
}

$koneksi->close();
?>
