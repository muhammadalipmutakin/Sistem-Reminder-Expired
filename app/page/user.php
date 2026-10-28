<?php
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['id'])) {
  header('Location: index.php');
  exit();
}

// Mendapatkan ID pengguna dari session
$userId = $_SESSION['id'];

// Query untuk mendapatkan data pengguna berdasarkan ID pengguna
$query = "SELECT * FROM tb_users WHERE id = $userId";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
  $user = mysqli_fetch_assoc($result);
} else {
  // Jika pengguna tidak ditemukan, redirect ke halaman lain
  header('Location: index.php');
  exit();
}
?>

<section class="content">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <div class="user-profile">
              <div class="user-photo-wrapper">
                <div class="user-photo">
                  <?php
                  // Periksa apakah foto pengguna tersedia
                  if (!empty($user['foto'])) {
                    $fotoPath = 'dist/img/users/' . $user['foto'];
                    echo '<img src="' . $fotoPath . '" alt="Foto Pengguna" class="user-photo-img">';
                  }
                  ?>
                  <!-- Tambahkan atribut data-toggle dan data-target pada tombol "Edit Foto" -->
                  <a href="#" class="btn-edit-photo" data-toggle="modal" data-target="#uploadPhotoModal"><i class="fas fa-camera"></i> Edit Foto</a>
                </div>
              </div>
              <div class="user-details">
                <h3 class="user-details-title text-center">Detail Pengguna</h3>
                <div class="user-details-item">
                  <span class="user-details-label">Nama:</span>
                  <span class="user-details-value"><?php echo $user['nama']; ?></span>
                </div>
                <div class="user-details-item">
                  <span class="user-details-label">NIK:</span>
                  <span class="user-details-value"><?php echo $user['nik']; ?></span>
                </div>
                <div class="user-details-item">
                  <span class="user-details-label">Jenis Kelamin:</span>
                  <span class="user-details-value"><?php echo $user['jk']; ?></span>
                </div>
                <div class="user-details-item">
                  <span class="user-details-label">Email:</span>
                  <span class="user-details-value"><?php echo $user['email']; ?></span>
                </div>
                <div class="user-details-item">
                  <span class="user-details-label">Alamat:</span>
                  <span class="user-details-value"><?php echo $user['alamat']; ?></span>
                </div>
                <div class="user-details-item">
                  <span class="user-details-label">Level:</span>
                  <span class="user-details-value"><?php echo $user['level']; ?></span>
                </div>
              </div>
            </div>
            <div class="user-actions">
              <a href="#" class="btn btn-primary btn-action" data-toggle="modal" data-target="#editProfileModal">Perbarui Data</a>
              <a href="#" class="btn btn-secondary btn-action" data-toggle="modal" data-target="#changePasswordModal">Ubah Password</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Upload Foto -->
  <div class="modal fade" id="uploadPhotoModal" tabindex="-1" aria-labelledby="uploadPhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="uploadPhotoModalLabel">Upload Foto Pengguna</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editPhotoForm" enctype="multipart/form-data">
            <input type="file" name="photo" id="photoInput" accept="image/*">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" id="savePhotoBtn">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Perbarui Data -->
  <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileModalLabel">Perbarui Data Pengguna</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editProfileForm">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="hidden" name="id" id="edit-id" value="<?php echo $user['id']; ?>">
                  <label for="editNama">Nama:</label>
                  <input type="text" class="form-control" id="editNama" name="nama" value="<?php echo $user['nama']; ?>">
                </div>
                <div class="form-group">
                  <label for="editNik">NIK:</label>
                  <input type="text" class="form-control" id="editNik" name="nik" value="<?php echo $user['nik']; ?>">
                </div>
                <div class="form-group">
                  <label for="editJk">Jenis Kelamin:</label>
                  <select class="form-control" id="editJk" name="jk">
                    <option value="Laki-laki" <?php if ($user['jk'] === 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if ($user['jk'] === 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="editEmail">Email:</label>
                  <input type="email" class="form-control" id="editEmail" name="email" value="<?php echo $user['email']; ?>">
                </div>
                <div class="form-group">
                  <label for="editAlamat">Alamat:</label>
                  <textarea class="form-control" id="editAlamat" name="alamat"><?php echo $user['alamat']; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="editLevel">Level:</label>
                  <input class="form-control" id="editLevel" name="level" value="<?php echo $user['level']; ?>" readonly>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" id="saveProfileBtn">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Ubah Password -->
  <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordModalLabel">Ubah Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Form ubah password -->
          <form id="changePasswordForm" method="post">
            <div class="form-group">
              <input type="hidden" name="id" id="edit-id" value="<?php echo $user['id']; ?>">
              <label for="currentPassword">Password Saat Ini</label>
              <div class="input-group">
                <input type="password" name="currentPassword" id="currentPassword" class="form-control">
                <div class="input-group-append">
                  <span class="input-group-text password-toggle" id="toggleCurrentPassword">
                    <i class="fas fa-eye"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="newPassword">Password Baru</label>
              <div class="input-group">
                <input type="password" name="newPassword" id="newPassword" class="form-control">
                <div class="input-group-append">
                  <span class="input-group-text password-toggle" id="toggleNewPassword">
                    <i class="fas fa-eye"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="confirmPassword">Konfirmasi Password Baru</label>
              <div class="input-group">
                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">
                <div class="input-group-append">
                  <span class="input-group-text password-toggle" id="toggleConfirmPassword">
                    <i class="fas fa-eye"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Ubah Password</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


</section>

<script>
  // Ambil elemen ikon mata dan input password
  const passwordToggles = document.querySelectorAll('.password-toggle');
  const passwordInputs = document.querySelectorAll('input[type="password"]');

  // Tambahkan event listener untuk toggle ikon mata dan tipe input
  passwordToggles.forEach(function(toggle, index) {
    toggle.addEventListener('click', function() {
      togglePasswordVisibility(index);
    });
  });

  // Fungsi untuk mengubah tipe input password
  function togglePasswordVisibility(index) {
    const input = passwordInputs[index];
    const toggle = passwordToggles[index];

    if (input.type === 'password') {
      input.type = 'text';
      toggle.querySelector('i').classList.remove('fa-eye');
      toggle.querySelector('i').classList.add('fa-eye-slash');
    } else {
      input.type = 'password';
      toggle.querySelector('i').classList.remove('fa-eye-slash');
      toggle.querySelector('i').classList.add('fa-eye');
    }
  }

  $(document).ready(function() {
    $('#savePhotoBtn').click(function() {
      var photoInput = $('#photoInput')[0];
      if (photoInput.files.length === 0) {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Pilih foto terlebih dahulu.'
        });
        return;
      }

      var formData = new FormData();
      formData.append('photo', photoInput.files[0]);
      formData.append('userId', '<?php echo $userId; ?>');

      $.ajax({
        type: 'POST',
        url: 'controller/data_user/edit_foto.php',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          // Jika permintaan sukses, tampilkan pratinjau foto yang baru disimpan
          const photoPath = 'dist/img/users/' + response;
          $('.user-photo-img').attr('src', photoPath);
          $('#uploadPhotoModal').modal('hide');

          // Kosongkan kembali form modal
          $('#photoInput').val('');

          // Tampilkan Sweet Alert sukses
          Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Foto pengguna berhasil diperbarui.'
          }).then(function() {
            // Lakukan tindakan tambahan setelah menutup Sweet Alert (jika diperlukan)
          });
        },
        error: function(xhr, status, error) {
          // Jika terjadi kesalahan, tampilkan pesan error
          console.error(xhr.responseText);

          // Tampilkan Sweet Alert error
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal memperbarui foto pengguna.'
          });
        }
      });
    });

    $('#saveProfileBtn').click(function() {
      var formData = $('#editProfileForm').serialize();

      $.ajax({
        type: 'POST',
        url: 'controller/data_user/edit_profile.php',
        data: formData,
        success: function(response) {
          // Jika permintaan sukses, tampilkan pesan sukses
          Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Data pengguna berhasil diperbarui.'
          }).then(function() {
            // Refresh halaman setelah menutup Sweet Alert
            location.reload();
          });
        },
        error: function(xhr, status, error) {
          // Jika terjadi kesalahan, tampilkan pesan error
          console.error(xhr.responseText);

          // Tampilkan Sweet Alert error
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal memperbarui data pengguna.'
          });
        }
      });
    });

    // Mengubah password menggunakan Ajax
    $('#changePasswordForm').submit(function(e) {
      e.preventDefault(); // Mencegah submit form

      var id = $('#edit-id').val();
      var currentPassword = $('#currentPassword').val();
      var newPassword = $('#newPassword').val();
      var confirmPassword = $('#confirmPassword').val();

      // Periksa apakah password baru dan konfirmasi password sama
      if (newPassword !== confirmPassword) {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Konfirmasi password tidak sesuai. Silakan coba lagi.'
        });
        return;
      }

      // Data yang akan dikirimkan dalam permintaan Ajax
      var data = {
        id: id,
        currentPassword: currentPassword,
        newPassword: newPassword,
        confirmPassword: confirmPassword
      };

      // Kirim permintaan Ajax
      $.ajax({
        type: 'POST',
        url: 'controller/data_user/ubah_password.php',
        data: data,
        success: function(response) {
          // Tanggapan sukses dari server
          // Proses tanggapan sesuai kebutuhan Anda
          console.log(response);
          if (response === 'Password berhasil diubah.') {
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: 'Password berhasil diubah.'
            }).then(function() {
              // Setelah menutup Sweet Alert, lakukan tindakan tambahan (jika diperlukan)
              $('#changePasswordModal').modal('hide');
              $('#currentPassword').val('');
              $('#newPassword').val('');
              $('#confirmPassword').val('');
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: response
            });
          }
        },
        error: function(xhr, status, error) {
          // Tanggapan error dari server
          // Proses tanggapan sesuai kebutuhan Anda
          console.error(error);
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan. Password gagal diubah.'
          });
        }
      });
    });

    // Mengatur ulang nilai input ketika modal ditutup
    $('#changePasswordModal').on('hidden.bs.modal', function() {
      $('#currentPassword').val('');
      $('#newPassword').val('');
      $('#confirmPassword').val('');
    });
  });
</script>