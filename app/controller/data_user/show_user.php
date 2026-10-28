<?php
//koneksi ke database
include '../conf/config.php';

//query untuk menampilkan data users
$query = "SELECT * FROM tb_users";
$result = mysqli_query($koneksi, $query);

//tampilkan data dalam tabel
if(mysqli_num_rows($result) > 0) {
  $no=1;
  while($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>'. $no++ .'</td>';
    echo '<td>'.$row['nik'].'</td>';
    echo '<td>'.$row['nama'].'</td>';
    echo '<td>'.$row['jk'].'</td>';
    echo '<td>'.$row['email'].'</td>';
    echo '<td>'.$row['alamat'].'</td>';
    echo '<td>'.$row['level'].'</td>';
    echo '<td>'.$row['tgl_buat'].'</td>';
    echo '<td>'.$row['tgl_update'].'</td>';
    
    
    echo '<td>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-sm btn-primary edit-user-btn" data-id="'.$row['id'].'">Edit</button>
              <button type="button" class="btn btn-sm btn-danger delete-user-btn" data-id="'.$row['id'].'">Hapus</button>
            </div>
          </td>';
    echo '</tr>';
  }
} else {
  echo '<tr><td colspan="10">Tidak ada data user</td></tr>';
}
?>
