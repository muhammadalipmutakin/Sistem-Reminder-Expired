<?php
include '../conf/config.php';

$limit = 10;
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$start = ($page - 1) * $limit;

$query = "SELECT COUNT(*) as total FROM tb_category";
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
$total = $row['total'];
$total_pages = ceil($total / $limit);

$query = "SELECT * FROM tb_category ORDER BY id DESC LIMIT $start, $limit";
$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    $output = "";
    $no = $start + 1;
    while ($row = $result->fetch_assoc()) {
            $output .= "<tr>
            <td>{$no}</td>
            <td>{$row['sub_category']}</td>
            <td>{$row['category']}</td>
            <td>
                <button class='btn btn-primary btn-sm edit-category' data-id='{$row['id']}' onclick='openEditModal(this)' data-id='{$row['id']}'>Edit</button>
                <button class='btn btn-danger btn-sm delete-category' data-id='{$row['id']}' onclick='openDeleteModal(this)' data-id='{$row['id']}'>Delete</button>
            </td>
        </tr>";
    $no++;

    }
    echo $output;
} else {
    echo "<tr><td colspan='4'>No categories found</td></tr>";
}

// Tampilkan tombol Next hanya jika halaman saat ini belum mencapai halaman terakhir
if ($page < $total_pages) {
    echo "<li class='page-item' id='next'><a class='page-link' href='#'>Next</a></li>";
}

$koneksi->close();
?>
