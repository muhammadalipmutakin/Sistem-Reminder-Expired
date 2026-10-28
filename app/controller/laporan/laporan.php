<?php
include '../conf/config.php';

$limit = isset($_POST['show_by']) ? $_POST['show_by'] : 10;
$page = isset($_POST['page']) ? $_POST['page'] : 1;
$start = ($page - 1) * $limit;

$startDate = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$endDate = isset($_POST['end_date']) ? $_POST['end_date'] : '';

$where = '';
if (!empty($startDate) && !empty($endDate)) {
    $where = "WHERE laporan.tgl_confirm BETWEEN '$startDate' AND '$endDate'";
}

$sortBy = isset($_POST['sort_by']) ? $_POST['sort_by'] : 'tgl_confirm'; // Mengurutkan berdasarkan TanggalKonfirmasi jika tidak ada permintaan pengurutan
$sortOrder = isset($_POST['sort_order']) ? $_POST['sort_order'] : 'DESC'; // Urutan descending (menurun) jika tidak ada permintaan pengurutan

$query = "SELECT COUNT(*) as total FROM tb_laporan AS laporan LEFT JOIN tb_produk AS produk ON laporan.plu = produk.plu LEFT JOIN tb_category AS category ON produk.sub_category = category.sub_category $where";
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
$total = $row['total'];
$total_pages = ceil($total / $limit);

// Modifikasi query untuk mengurutkan data berdasarkan kolom yang diminta secara descending atau ascending
$query = "SELECT laporan.*, produk.barcode, produk.descp, produk.retur_day, produk.tag, produk.conv1, produk.conv2, produk.min_disp, produk.sub_category, category.category 
          FROM tb_laporan AS laporan 
          LEFT JOIN tb_produk AS produk ON laporan.plu = produk.plu 
          LEFT JOIN tb_category AS category ON produk.sub_category = category.sub_category 
          $where 
          ORDER BY $sortBy $sortOrder 
          LIMIT $start, $limit";
$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    $output = array();
    $no = $start + 1;
    while ($row = $result->fetch_assoc()) {
        $output[] = array(
            'no' => $no,
            'plu' => $row['plu'],
            'barcode' => $row['barcode'],
            'deskripsi' => $row['descp'],
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
            'tgl_confirm' => $row['tgl_confirm'],
            'user_confirm' => $row['user_confirm'],
            'status' => $row['status'],
            'status_disp' => $row['status_disp'],
            'keterangan' => $row['keterangan']
        );
        $no++;
    }
    $response = array(
        'success' => true,
        'data' => $output,
        'total_pages' => $total_pages
    );
    echo json_encode($response);
} else {
    $response = array(
        'success' => false,
        'message' => 'Tidak ada produk yang ditemukan'
    );
    echo json_encode($response);
}
?>
