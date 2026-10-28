<?php
include '../conf/config.php';

$limit = 10;
$page = isset($_POST['page']) ? $_POST['page'] : 1;
$start = ($page - 1) * $limit;

$search_query = isset($_POST['search_query']) ? $_POST['search_query'] : '';
$where = '';
if (!empty($search_query)) {
    $where = "WHERE p.plu LIKE '%$search_query%' OR p.barcode LIKE '%$search_query%' OR p.descp LIKE '%$search_query%'";
}

$query = "SELECT COUNT(*) as total FROM tb_produk p
          LEFT JOIN tb_category c ON p.sub_category = c.sub_category
          $where";
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
$total = $row['total'];
$total_pages = ceil($total / $limit);

$query = "SELECT p.*, c.category FROM tb_produk p
          LEFT JOIN tb_category c ON p.sub_category = c.sub_category
          $where
          ORDER BY p.id DESC
          LIMIT $start, $limit";

$result = $koneksi->query($query);

$response = array();
$response['html'] = '';
$response['total_items'] = $total;

if ($result->num_rows > 0) {
    $no = $start + 1;
    while ($row = $result->fetch_assoc()) {
        $response['html'] .= "<tr>
                        <td>{$no}</td>
                        <td>{$row['plu']}</td>
                        <td>{$row['barcode']}</td>
                        <td>{$row['descp']}</td>
                        <td>{$row['tag']}</td>
                        <td>{$row['conv1']} / {$row['conv2']}</td>
                        <td>{$row['planogram']}</td>
                        <td>{$row['retur_day']}</td>
                        <td>{$row['min_disp']}</td>
                        <td>{$row['sub_category']}</td>
                        <td>{$row['category']}</td>
                        <td>
                          <div class='btn-group'>
                            <button type='button' class='btn btn-primary btn-sm edit-barang-btn' data-id='{$row['id']}'>Edit</button>
                            <button type='button' class='btn btn-danger btn-sm delete-barang-btn' data-id='{$row['id']}'>Hapus</button>
                          </div>
                        </td>
                    </tr>";
        $no++;
    }
} else {
    $response['html'] = "<tr><td colspan='12'>No products found</td></tr>";
}

if ($page < $total_pages) {
    $response['html'] .= "<li class='page-item' id='next'><a class='page-link' href='#'>Next</a></li>";
}

echo json_encode($response);

$koneksi->close();
?>
