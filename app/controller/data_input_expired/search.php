<?php
if (isset($_GET['search'])) {
  // Koneksi ke database
  include '../conf/config.php';

  // Menangani karakter khusus dalam input pengguna
  $search = $koneksi->real_escape_string($_GET['search']);

  // Membuat query pencarian
  $sql = "SELECT barcode, descp FROM tb_produk WHERE descp LIKE '%$search%'";
  $result = $koneksi->query($sql);

  $products = array();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $product = array(
        'barcode' => $row['barcode'],
        'descp' => $row['descp']
      );
      $products[] = $product;
    }
  }

  echo json_encode($products);

  $koneksi->close();
}
?>
