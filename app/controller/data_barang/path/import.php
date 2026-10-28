<?php

// import.php

// Fungsi untuk menyimpan data ke database
function saveToDatabase($plu, $barcode, $descp, $tag, $conv1, $conv2, $planogram, $retur_day, $min_disp, $sub_category)
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

  // Escape karakter khusus dalam nilai yang disimpan ke database
  $plu = mysqli_real_escape_string($koneksi, $plu);
  $barcode = mysqli_real_escape_string($koneksi, $barcode);
  $descp = mysqli_real_escape_string($koneksi, $descp);
  $tag = mysqli_real_escape_string($koneksi, $tag);
  $conv1 = mysqli_real_escape_string($koneksi, $conv1);
  $conv2 = mysqli_real_escape_string($koneksi, $conv2);
  $planogram = mysqli_real_escape_string($koneksi, $planogram);
  $retur_day = mysqli_real_escape_string($koneksi, $retur_day);
  $min_disp = mysqli_real_escape_string($koneksi, $min_disp);
  $sub_category = mysqli_real_escape_string($koneksi, $sub_category);

  // Query untuk menyimpan data ke tabel tb_produk
  $query = "INSERT INTO tb_produk (plu, barcode, descp, tag, conv1, conv2, planogram, retur_day, min_disp, sub_category) VALUES ('$plu', '$barcode', '$descp', '$tag', '$conv1', '$conv2', '$planogram', '$retur_day', '$min_disp', '$sub_category')";

  // Eksekusi query
  $result = mysqli_query($koneksi, $query);

  // Tutup koneksi database
  mysqli_close($koneksi);

  // Kembalikan hasil eksekusi query
  return $result;
}

// Proses file yang diimpor
if ($_FILES['import-file']['error'] == UPLOAD_ERR_OK) {
  $tmpFilePath = $_FILES['import-file']['tmp_name'];

  // Proses file berdasarkan jenisnya (CSV, Excel, dll.)
  // Tambahkan kode Anda di sini untuk menangani pemrosesan file
  // Anda dapat menggunakan library seperti PHPExcel, PhpSpreadsheet, atau fungsi fgetcsv() untuk mem-parsing file CSV atau Excel

  // Contoh kode untuk membaca file CSV
  if ($_FILES['import-file']['type'] == 'text/csv') {
    $csvData = file_get_contents($tmpFilePath);
    $rows = explode("\n", $csvData);

    // Hapus baris pertama (header)
    $header = array_shift($rows);

    $successCount = 0; // Jumlah data berhasil diimpor
    $errorCount = 0; // Jumlah data gagal diimpor

    foreach ($rows as $row) {
      $columns = str_getcsv($row, ';'); // Menggunakan pemisah kolom titik koma (;)

      // Lakukan validasi untuk memastikan bahwa baris tidak kosong
      if (!empty($columns[0])) {
        $plu = $columns[0];
        $barcode = $columns[1];
        $descp = $columns[2];
        $tag = $columns[3];
        $conv1 = $columns[4];
        $conv2 = $columns[5];
        $planogram = $columns[6];
        $retur_day = $columns[7];
        $min_disp = $columns[8];
        $sub_category = $columns[9];

        // Panggil fungsi saveToDatabase() untuk menyimpan data ke database
        $result = saveToDatabase($plu, $barcode, $descp, $tag, $conv1, $conv2, $planogram, $retur_day, $min_disp, $sub_category);

        // Cek hasil penyimpanan data ke database
        if (!$result) {
          $errorCount++;
        } else {
          $successCount++;
        }
      }
    }

    if ($errorCount > 0) {
      echo "Gagal menyimpan $errorCount data ke database.";
    } else {
      echo "success";
    }
  } else {
    echo "Jenis file yang diunggah harus berformat CSV.";
  }
} else {
  // Respon gagal jika gagal mengunggah file
  echo "Gagal mengunggah file.";
}
