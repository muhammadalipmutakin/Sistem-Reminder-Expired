<?php
include '../conf/config.php';

// Ambil ID barang dari parameter POST
$id = $_POST["id"];

// Query untuk mendapatkan data barang dengan ID tertu
$sql = "SELECT tb_inputexpired.tgl_expired, tb_inputexpired.tgl_tarik, tb_inputexpired.jml_expired, tb_inputexpired.planogram, tb_inputexpired.tgl_input, tb_inputexpired.plu, tb_inputexpired.user_input, tb_produk.barcode, tb_produk.descp, tb_produk.retur_day, tb_produk.tag, tb_produk.conv1, tb_produk.conv2, tb_produk.min_disp, tb_produk.sub_category, tb_category.category
        FROM tb_inputexpired 
        INNER JOIN tb_produk ON tb_inputexpired.plu = tb_produk.plu 
        INNER JOIN tb_category ON tb_produk.sub_category = tb_category.sub_category
        WHERE tb_inputexpired.id = '$id'";
$result = mysqli_query($koneksi, $sql);

// Cek apakah query berhasil dieksekusi
if ($result) {
    // Cek apakah data barang dengan ID tersebut ditemukan
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Mendapatkan tanggal sekarang
        $currentDate = date('Y-m-d');

        // Menentukan status berdasarkan tanggal tarik dan tanggal expired
        if ($row['tgl_tarik'] <= $currentDate && $row['tgl_expired'] >= $currentDate) {
            $status = 'barang memasuki masa retur';
        } elseif ($row['tgl_expired'] < $currentDate) {
            $status = 'barang sudah expired';
        } else {
            $status = 'barang dalam kondisi normal';
        }

        // Mengirim data barang sebagai respons
        $response = [
            'status' => 'success',
            'data' => [
                'id' => $id,
                'plu' => $row['plu'],
                'barcode' => $row['barcode'],
                'descp' => $row['descp'],
                'tgl_expired' => $row['tgl_expired'],
                'retur_day' => $row['retur_day'],
                'tgl_tarik' => $row['tgl_tarik'],
                'jml_expired' => $row['jml_expired'],
                'planogram' => $row['planogram'],
                'tag' => $row['tag'],
                'conv1' => $row['conv1'],
                'conv2' => $row['conv2'],
                'min_disp' => $row['min_disp'],
                'sub_category' => $row['sub_category'],
                'category' => $row['category'],
                'tgl_input' => $row['tgl_input'],
                'user_input' => $row['user_input'],
                'status' => $status
            ]
        ];

        echo json_encode($response);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data barang tidak ditemukan.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan dalam eksekusi query: ' . mysqli_error($koneksi)]);
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
