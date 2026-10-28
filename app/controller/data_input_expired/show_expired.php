<?php
include '../conf/config.php';

$limit = 5;
$page = isset($_POST['page']) ? $_POST['page'] : 1;
$start = ($page - 1) * $limit;

$search_query = isset($_POST['search_query']) ? $_POST['search_query'] : '';
$where = '';
if (!empty($search_query)) {
    $where = "WHERE tb_inputexpired.plu LIKE '%$search_query%' OR tb_produk.barcode LIKE '%$search_query%' OR tb_produk.descp LIKE '%$search_query%'";
}

$currentDate = date('Y-m-d'); // Tanggal saat ini

$query = "SELECT COUNT(*) as total 
          FROM tb_inputexpired 
          INNER JOIN tb_produk ON tb_inputexpired.plu = tb_produk.plu 
          WHERE tb_inputexpired.tgl_expired <= '$currentDate' 
          $where";
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
$total = $row['total'];
$total_pages = ceil($total / $limit);

$query = "SELECT tb_inputexpired.*, tb_produk.barcode, tb_produk.descp, tb_produk.retur_day
          FROM tb_inputexpired 
          INNER JOIN tb_produk ON tb_inputexpired.plu = tb_produk.plu 
          WHERE tb_inputexpired.tgl_expired <= '$currentDate' 
          $where 
          ORDER BY tb_inputexpired.id DESC 
          LIMIT $start, $limit";
$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    $output = "";
    $no = $start + 1;
    while ($row = $result->fetch_assoc()) {
        $output .= "<tr>
                        <td>{$no}</td>
                        <td>{$row['plu']}</td>
                        <td>{$row['barcode']}</td>
                        <td>{$row['descp']}</td>
                        <td>{$row['tgl_expired']}</td>
                        <td>{$row['retur_day']}</td>
                        <td>{$row['tgl_tarik']}</td>
                        <td>
                          <div class='btn-group'>
                            <button type='button' class='btn btn-primary btn-sm edit-barang-btn' data-id='{$row['id']}'>Detail</button>
                        </td>
                        <td>
                        </div>
                        <div class='btn-group'>
                          <button type='button' class='btn btn-success btn-sm confirm-barang-btn' data-id='{$row['id']}'>Confirm</button>
                        </div>
                        </td>
                    </tr>";
        $no++;
    }
    $response = array(
        'data' => $output,
        'total_pages' => $total_pages
    );
    echo json_encode($response);
} else {
    $response = array(
        'data' => "<tr><td colspan='9'>Tidak ada produk yang ditemukan</td></tr>",
        'total_pages' => 0
    );
    echo json_encode($response);
}
$koneksi->close();
