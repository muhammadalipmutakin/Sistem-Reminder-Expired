 <!-- Main content -->
 <section class="content">
   <div class="container-fluid">
     <div class="row">
       <div class="col-12">
         <div class="card">
           <div class="card-header">
             <h3 class="card-title">Data Users</h3>
           </div>

           <!-- /.card-header -->
           <div class="card-body">
             <div class="table-responsive">
               <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#add-user-modal">
                 Tambah User
               </button>
               <table class="table table-bordered table-hover">
                 <thead>
                   <tr>
                     <th class="text-center">NO</th>
                     <th class="text-center">NIK</th>
                     <th class="text-center">Nama</th>
                     <th class="text-center">Jenis Kelamin</th>
                     <th class="text-center">Email</th>
                     <th class="text-center">Alamat</th>
                     <th class="text-center">Level</th>
                     <th class="text-center">Tgl Buat</th>
                     <th class="text-center">Tgl Update</th>
                     <th class="text-center">Aksi</th>
                   </tr>
                 </thead>
                 <tbody id="barisData">
                   <!-- Data pengguna akan dimasukkan di sini -->
                 </tbody>
               </table>
             </div>
           </div>
           <!-- /.card-body -->
         </div>
         <!-- /.card -->
       </div>
       <!-- /.col -->
     </div>
     <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
 </section>


 <!-- Modal Tambah Users -->
 <div class="modal fade" id="add-user-modal" tabindex="-1" role="dialog" aria-labelledby="add-user-modal-label" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-md" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="add-user-modal-label">Tambah User</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="row">
           <div class="col-md-6">
             <form id="add-user-form" enctype="multipart/form-data">
               <div class="form-group">
                 <label for="nik" class="col-form-label">NIK:</label>
                 <input type="text" class="form-control" id="nik" name="nik" required>
               </div>
               <div class="form-group">
                 <label for="password" class="col-form-label">Password:</label>
                 <input type="text" class="form-control" id="password" name="password" value="12345" readonly>
               </div>
               <div class="form-group">
                 <label for="nama" class="col-form-label">Nama:</label>
                 <input type="text" class="form-control" id="nama" name="nama" required>
               </div>
               <div class="form-group">
                 <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin:</label>
                 <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                   <option value="">-- Pilih Jenis Kelamin --</option>
                   <option value="Laki-laki">Laki-laki</option>
                   <option value="Perempuan">Perempuan</option>
                 </select>
               </div>
               <div class="form-group">
                 <label for="email" class="col-form-label">Email:</label>
                 <input type="email" class="form-control" id="email" name="email" required>
               </div>
             </form>
           </div>
           <div class="col-md-6">
             <form id="add-user-form" enctype="multipart/form-data">
               <div class="form-group">
                 <label for="alamat" class="col-form-label">Alamat:</label>
                 <textarea class="form-control" id="alamat" name="alamat" required></textarea>
               </div>
               <div class="form-group">
                 <label for="level" class="col-form-label">Level:</label>
                 <select class="form-control" id="level" name="level" required>
                   <option value="">-- Pilih Level --</option>
                   <option value="AC">AC</option>
                   <option value="COS">COS</option>
                   <option value="ACOS">ACOS</option>
                   <option value="CREW">CREW</option>
                 </select>
               </div>
               <div class="form-group">
                 <label for="foto" class="col-form-label">Foto:</label>
                 <input type="file" class="form-control-file" id="foto" name="foto" accept="image/*" required>
               </div>
             </form>
           </div>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
         <button type="submit" form="add-user-form" class="btn btn-primary">Simpan</button>
       </div>
     </div>
   </div>
 </div>

 <!-- Modal Edit Users -->
 <div class="modal fade" id="edit-user-modal" tabindex="-1" role="dialog" aria-labelledby="edit-user-modal-label" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-md" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="edit-user-modal-label">Edit User</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="row">
           <div class="col-md-6">
             <form id="edit-user-form" enctype="multipart/form-data">
               <input type="hidden" name="id" id="edit-id">
               <div class="form-group">
                 <label for="edit-nik" class="col-form-label">NIK:</label>
                 <input type="text" class="form-control" id="edit-nik" name="edit-nik" required>
               </div>
               <div class="form-group">
                 <label for="edit-nama" class="col-form-label">Nama:</label>
                 <input type="text" class="form-control" id="edit-nama" name="edit-nama" required>
               </div>
               <div class="form-group">
                 <label for="edit-jenis_kelamin" class="col-form-label">Jenis Kelamin:</label>
                 <select class="form-control" id="edit-jenis_kelamin" name="edit-jenis_kelamin" required>
                   <option value="">-- Pilih Jenis Kelamin --</option>
                   <option value="Laki-laki">Laki-laki</option>
                   <option value="Perempuan">Perempuan</option>
                 </select>
               </div>
               <div class="form-group">
                 <label for="edit-email" class="col-form-label">Email:</label>
                 <input type="email" class="form-control" id="edit-email" name="edit-email" required>
               </div>
             </form>
           </div>
           <div class="col-md-6">
             <form id="edit-user-form" enctype="multipart/form-data">
               <div class="form-group">
                 <label for="edit-alamat" class="col-form-label">Alamat:</label>
                 <textarea class="form-control" id="edit-alamat" name="edit-alamat" required></textarea>
               </div>
               <div class="form-group">
                 <label for="edit-level" class="col-form-label">Level:</label>
                 <select class="form-control" id="edit-level" name="edit-level" required>
                   <option value="">-- Pilih Level --</option>
                   <option value="AC">AC</option>
                   <option value="COS">COS</option>
                   <option value="ACOS">ACOS</option>
                   <option value="CREW">CREW</option>
                 </select>
               </div>
             </form>
           </div>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
         <button type="submit" form="edit-user-form" class="btn btn-primary">Simpan</button>
       </div>
     </div>
   </div>
 </div>



 <script>
   $(document).ready(function() {
     // Fungsi Tampilkan Data User
     function showUser() {
       $.ajax({
         type: "GET",
         url: "controller/data_user/show_user.php",
         dataType: "html",
         success: function(data) {
           $('#barisData').html(data);
         }
       });
     }

     // Tampilkan Data User saat halaman pertama kali dimuat
     showUser();

     // Tambah User
     $('#add-user-form').submit(function(event) {
       event.preventDefault();
       var nama = $('#nama').val();
       var nik = $('#nik').val();
       var password = $('#password').val();
       var jenisKelamin = $('#jenis_kelamin').val();
       var email = $('#email').val();
       var alamat = $('#alamat').val();
       var level = $('#level').val();
       var foto = $('#foto')[0].files[0];

       var formData = new FormData();
       formData.append('nama', nama);
       formData.append('nik', nik);
       formData.append('password', password);
       formData.append('jenis_kelamin', jenisKelamin);
       formData.append('email', email);
       formData.append('alamat', alamat);
       formData.append('level', level);
       formData.append('foto', foto);

       $.ajax({
         type: 'POST',
         url: 'controller/data_user/tambah_user.php',
         data: formData,
         contentType: false,
         processData: false,
         success: function(response) {
           if (response === 'success') {
             // Jika berhasil tambahkan data ke dalam tabel
             showUser();
             $('#add-user-modal').modal('hide');
             $('#add-user-form')[0].reset();
             $('#alamat, #level, #foto').val('');
             Swal.fire('Sukses', 'User berhasil ditambahkan!', 'success');
           } else {
             $('#add-user-modal').modal('hide');
             $('#add-user-form')[0].reset();
             $('#alamat, #level, #foto').val('');
             Swal.fire('Sukses', 'User berhasil ditambahkan!', 'success');
             showUser();
           }
         },
         error: function() {
           Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
         }
       });
     });

     $('#add-user-modal').on('hidden.bs.modal', function() {
       $('#add-user-form')[0].reset();
       $('#alamat, #level, #foto').val('');
     });


     // Mengambil data pengguna untuk diedit
     $(document).on('click', '.edit-user-btn', function() {
       var id = $(this).data('id');

       // Mengosongkan form
       $('#edit-user-form')[0].reset();

       // Menampilkan modal
       $('#edit-user-modal').modal('show');

       // Mengirim permintaan AJAX untuk mendapatkan data pengguna
       $.ajax({
         url: 'controller/data_user/get_user.php',
         method: 'GET',
         data: {
           id: id
         },
         dataType: 'json',
         success: function(response) {
           if (response.status === 'success') {
             var user = response.data;

             // Mengisi nilai form dengan data pengguna yang akan diedit
             $('#edit-id').val(user.id);
             $('#edit-nik').val(user.nik);
             $('#edit-nama').val(user.nama);
             $('#edit-jenis_kelamin').val(user.jenis_kelamin);
             $('#edit-email').val(user.email);
             $('#edit-alamat').val(user.alamat);
             $('#edit-level').val(user.level);
           } else {
             Swal.fire('Error', 'Gagal mendapatkan data pengguna.', 'error');
           }
         },
         error: function() {
           Swal.fire('Error', 'Terjadi kesalahan pada server.', 'error');
         }
       });
     });

     $('#edit-user-modal form').submit(function(event) {
       event.preventDefault();
       var userId = $('#edit-user-modal input[name="id"]').val();
       var nik = $('#edit-user-modal input[name="edit-nik"]').val();
       var nama = $('#edit-user-modal input[name="edit-nama"]').val();
       var jenisKelamin = $('#edit-user-modal select[name="edit-jenis_kelamin"]').val();
       var email = $('#edit-user-modal input[name="edit-email"]').val();
       var alamat = $('#edit-user-modal textarea[name="edit-alamat"]').val();
       var level = $('#edit-user-modal select[name="edit-level"]').val();

       var formData = new FormData();
       formData.append('id', userId);
       formData.append('nik', nik);
       formData.append('nama', nama);
       formData.append('jenis_kelamin', jenisKelamin);
       formData.append('email', email);
       formData.append('alamat', alamat);
       formData.append('level', level);

       $.ajax({
         type: 'POST',
         url: 'controller/data_user/edit_user.php',
         data: formData,
         processData: false,
         contentType: false,
         success: function(response) {
           if (response === 'success') {
             Swal.fire('Sukses', 'Data pengguna berhasil diperbarui.', 'success');
             $('#edit-user-modal').modal('hide');
             showUser();
           } else {
             Swal.fire('Error', 'Gagal memperbarui data pengguna.', 'error');
           }
         },
         error: function() {
           Swal.fire('Error', 'Terjadi kesalahan pada server.', 'error');
         }
       });
     });


     $(document).on('click', '.delete-user-btn', function() {
       var id = $(this).data('id');
       Swal.fire({
         title: 'Konfirmasi Hapus',
         text: 'Anda yakin ingin menghapus user ini?',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonText: 'Ya, Hapus',
         cancelButtonText: 'Batal'
       }).then((result) => {
         if (result.isConfirmed) {
           $.ajax({
             type: 'POST',
             url: 'controller/data_user/hapus_user.php',
             data: {
               id: id
             },
             success: function(response) {
               if (response === 'success') {
                 // Jika berhasil hapus data dari tabel
                 showUser();
                 Swal.fire('Sukses', 'Data user berhasil dihapus!', 'success');
               } else {
                 Swal.fire('Error', 'Terjadi kesalahan saat menghapus data user', 'error');
               }
             }
           });
         }
       });
     });

   });
 </script>