<?php
include '../conf/config.php';

// Ambil ID barang dari parameter POST
$id = $_POST["id"];

// Query untuk mendapatkan data barang dengan ID tertentu
$sql = "SELECT tb_inputexpired.*, tb_produk.barcode, tb_produk.descp, tb_produk.retur_day
        FROM tb_inputexpired
        INNER JOIN tb_produk ON tb_inputexpired.plu = tb_produk.plu
        WHERE tb_inputexpired.id = '$id'";
$result = mysqli_query($koneksi, $sql);

// Cek apakah query berhasil dieksekusi
if ($result) {
    // Cek apakah data barang dengan ID tersebut ditemukan
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Mengirim data barang sebagai respons
        echo json_encode([
            'status' => 'success',
            'data' => [
                'id' => $row['id'],
                'plu' => $row['plu'],
                'barcode' => $row['barcode'],
                'descp' => $row['descp'],
                'tgl_expired' => $row['tgl_expired'],
                'retur_day' => $row['retur_day'],
                'tgl_tarik' => $row['tgl_tarik'],
                'jml_expired' => $row['jml_expired'],
                'planogram' => $row['planogram'],
                'tgl_input' => $row['tgl_input'],
                'user_input' => $row['user_input']
            ]
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Data barang tidak ditemukan.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Terjadi kesalahan dalam eksekusi query: ' . mysqli_error($koneksi)
    ]);
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
