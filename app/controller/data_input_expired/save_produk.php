<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    include '../conf/config.php';

    // Handle special characters in user input
    $retur_day = $koneksi->real_escape_string($_POST['retur_day']);
    $planogram = $koneksi->real_escape_string($_POST['planogram']);
    $tgl_expired = $koneksi->real_escape_string($_POST['tgl_expired']);
    $jml_expired = $koneksi->real_escape_string($_POST['jml_expired']);
    $plu = $koneksi->real_escape_string($_POST['plu']);
    $user = isset($_SESSION["nama"]) ? $_SESSION["nama"] : "";

    // Calculate tgl_tarik based on tgl_expired and retur_day
    $tgl_tarik = date('Y-m-d', strtotime('-' . $retur_day . ' days', strtotime($tgl_expired)));

    // Create a query to save the data to the database
    $sql = "INSERT INTO tb_inputexpired (tgl_expired, tgl_tarik, jml_expired, planogram, tgl_input, plu, user_input)
            VALUES ('$tgl_expired', '$tgl_tarik', '$jml_expired', '$planogram', NOW(), '$plu', '$user')";

    if ($koneksi->query($sql) === TRUE) {
        // Data saved successfully
        echo "Data berhasil disimpan.";
    } else {
        // An error occurred while saving the data
        echo "Terjadi kesalahan: " . $koneksi->error;
    }

    $koneksi->close();
}
?>