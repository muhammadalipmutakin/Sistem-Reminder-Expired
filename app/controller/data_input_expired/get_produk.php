<?php
if (isset($_GET['search'])) {
    // Koneksi ke database
    include '../conf/config.php';

    // Mendapatkan kata kunci pencarian yang dikirim melalui parameter GET
    $search = $_GET['search'];

    // Mengambil detail produk berdasarkan plu atau barcode
    $sql = "SELECT descp, retur_day, planogram, plu
            FROM tb_produk
            WHERE plu = '$search' OR barcode = '$search' ";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        // Mengambil data produk
        $row = $result->fetch_assoc();
        $plu = $row['plu'];
        $descp = $row['descp'];
        $retur_day = $row['retur_day'];
        $planogram = $row['planogram'];

        // Mengisi nilai pada kolom plu, descp, retur_day, dan planogram
        echo json_encode([
            'plu' => $plu,
            'descp' => $descp,
            'retur_day' => $retur_day,
            'planogram' => $planogram
        ]);
    }

    $koneksi->close();
}
