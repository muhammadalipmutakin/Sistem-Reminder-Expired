<?php

// export.php

// Fungsi untuk mengambil data dari database
function getDataFromDatabase()
{
  // Sesuaikan dengan informasi koneksi database Anda
  $host = "localhost";
  $username = "root";
  $password = "";
  $database = "db_skripsi";

  // Buat koneksi ke database
  $koneksi = mysqli_connect($host, $username, $password, $database);

  // Periksa koneksi database
  if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
  }

  // Query untuk mendapatkan semua data dari tabel tb_produk
  $query = "SELECT * FROM tb_produk";

  // Eksekusi query
  $result = mysqli_query($koneksi, $query);

  // Inisialisasi array untuk menyimpan data
  $data = array();

  // Ambil data dan masukkan ke array
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }

  // Tutup koneksi database
  mysqli_close($koneksi);

  // Kembalikan data
  return $data;
}

// Mengambil data dari database
$data = getDataFromDatabase();

// Mengirim file CSV ke klien
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data_barang.csv"');

// Membuka file CSV untuk menulis
$file = fopen('php://output', 'w');

// Mengatur pemisah kolom menjadi titik koma
$delimiter = ';';

// Menulis header kolom dengan pemisah yang benar
$header = array_keys($data[0]);
fputcsv($file, $header, $delimiter);

// Menulis data dengan pemisah yang benar
foreach ($data as $row) {
  fputcsv($file, $row, $delimiter);
}

// Tutup file
fclose($file);

exit;
