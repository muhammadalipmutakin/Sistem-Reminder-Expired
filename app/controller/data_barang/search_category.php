<?php
include '../conf/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data halaman dan keyword dari AJAX request
    $page = $_POST['page'];
    $keyword = $_POST['keyword'];

    // Batasan jumlah data yang ditampilkan per halaman
    $limit = 10;

    // Hitung offset berdasarkan halaman saat ini
    $offset = ($page - 1) * $limit;

    // Query untuk mendapatkan data kategori berdasarkan keyword
    $query = "SELECT * FROM tb_category WHERE sub_category LIKE '%$keyword%' OR category LIKE '%$keyword%' LIMIT $offset, $limit";
    $result = mysqli_query($koneksi, $query);

    // Mengecek apakah terdapat data kategori
    if (mysqli_num_rows($result) > 0) {
        // Menampilkan data kategori
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['sub_category'] . '</td>';
            echo '<td>' . $row['category'] . '</td>';
            echo '<td>';
            echo '<a href="#" class="btn btn-sm btn-primary edit-category" data-id="' . $row['id'] . '">Edit</a>';
            echo ' ';
            echo '<a href="#" class="btn btn-sm btn-danger delete-category" data-id="' . $row['id'] . '">Hapus</a>';
            echo '</td>';
            echo '</tr>';
        }
    } else {
        // Tidak ada data kategori yang cocok dengan keyword
        echo '<tr><td colspan="4">Tidak ada data kategori yang cocok dengan keyword.</td></tr>';
    }

    mysqli_close($koneksi);
}
?>
