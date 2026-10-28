<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Terhubung ke database
    include '../conf/config.php';

    // Menghandle karakter khusus pada input pengguna
    $id = $koneksi->real_escape_string($_POST['id']);
    $tglExpired = $koneksi->real_escape_string($_POST['tgl_expired']);
    $jmlExpired = $koneksi->real_escape_string($_POST['jml_expired']);
    $tempatDisplay = $koneksi->real_escape_string($_POST['planogram']);

    // Ambil retur_day dari database (misalnya dengan query SELECT)
    $returDayQuery = "SELECT retur_day FROM tb_produk WHERE plu = (
        SELECT plu FROM tb_inputexpired WHERE id = '$id'
    )";
    $returDayResult = $koneksi->query($returDayQuery);
    if ($returDayResult && $returDayResult->num_rows > 0) {
        $returDayRow = $returDayResult->fetch_assoc();
        $returDay = $returDayRow['retur_day'];
    } else {
        $returDay = 0; // Jika data retur_day tidak ditemukan, set default ke 0
    }

    // Menghitung tgl_tarik berdasarkan tgl_expired - retur_day
    $tglTarik = date('Y-m-d', strtotime($tglExpired . ' -' . $returDay . ' days'));

    // Membuat query untuk memperbarui data dalam database
    $sql = "UPDATE tb_inputexpired SET tgl_expired = STR_TO_DATE('$tglExpired', '%Y-%m-%d'), tgl_tarik = STR_TO_DATE('$tglTarik', '%Y-%m-%d'), jml_expired = '$jmlExpired', planogram = '$tempatDisplay' WHERE id = '$id'";

    if ($koneksi->query($sql) === TRUE) {
        // Data berhasil diperbarui
        $response = ['status' => 'success', 'message' => 'Edit berhasil disimpan'];
    } else {
        // Terjadi kesalahan saat memperbarui data
        $response = ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $koneksi->error];
    }

    echo json_encode($response);

    $koneksi->close();
}
?>
