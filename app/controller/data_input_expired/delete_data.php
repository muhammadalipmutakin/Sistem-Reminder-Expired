<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Cek apakah ID data dikirim melalui permintaan POST
  if (isset($_POST["id"])) {
    $id = $_POST["id"];

    // Lakukan proses penghapusan data di sini, sesuai dengan kebutuhan Anda
    // Contoh penghapusan data menggunakan koneksi ke database:
    // Connect to the database
    include '../conf/config.php';

    // Escape the ID to prevent SQL injection
    $id = $koneksi->real_escape_string($id);

    // Create a query to delete the data from the table
    $sql = "DELETE FROM tb_inputexpired WHERE id = '$id'";

    if ($koneksi->query($sql) === TRUE) {
      // Data deleted successfully
      echo "Data berhasil dihapus.";
    } else {
      // An error occurred while deleting the data
      echo "Terjadi kesalahan: " . $koneksi->error;
    }

    $koneksi->close();
  }
}
?>
