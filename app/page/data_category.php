<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Barang</h3>
          </div>

          <!-- /.card-header -->
          <div class="card-body">
            <div class="row mb-3">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-category-modal">
                Tambah Data
              </button>
              <div class="col-md-4 ml-auto">
                <div class="input-group">
                  <input type="text" id="search-input" class="form-control" placeholder="Cari produk">
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="table-info">
                <tr>
                  <th>NO</th>
                  <th>Sub Category</th>
                  <th>Category</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="category-list">

              </tbody>
            </table>
          </div>
          <nav>
            <ul class="pagination justify-content-center" id="pagination">

            </ul>
          </nav>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  </div>
</section>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="add-category-modal" tabindex="-1" role="dialog" aria-labelledby="add-category-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add-category-modal-label">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-category-form">
          <div class="form-group">
            <label for="sub-category-input">Sub Category</label>
            <input type="text" class="form-control" id="sub_category" name="sub_category" required>
          </div>
          <div class="form-group">
            <label for="category-input">Category</label>
            <input type="text" class="form-control" id="category" name="category" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" form="add-category-form" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Kategori -->
<div class="modal fade" id="edit-category-modal" tabindex="-1" role="dialog" aria-labelledby="edit-category-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-category-modal-label">Edit Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-category-form">
          <div class="form-group">
            <input type="hidden" name="id" id="edit-id">
            <label for="edit-sub-category-input">Sub Category</label>
            <input type="text" class="form-control" id="edit_sub_category" name="sub_category" required>
          </div>
          <div class="form-group">
            <label for="edit-category-input">Category</label>
            <input type="text" class="form-control" id="edit_category" name="category" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" form="edit-category-form" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
    var currentPage = 1; // Halaman saat ini

    // Memuat data kategori awal
    loadCategoryData(currentPage);

    // Function untuk memuat data kategori melalui Ajax
    function loadCategoryData(page) {
      $.ajax({
        url: 'controller/data_barang/show_category.php', // Path ke skrip PHP untuk mengambil data kategori
        type: 'POST',
        data: {
          page: page
        },
        dataType: 'html',
        success: function(response) {
          $('#category-list').html(response);
          updatePagination();
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Terjadi kesalahan saat melakukan permintaan AJAX'
          });
        }
      });
    }

    // Function untuk memperbarui tampilan paginasi
    function updatePagination() {
      var pagination = $('#pagination');
      pagination.empty();

      // Menampilkan tombol Previous jika halaman saat ini bukan halaman pertama
      if (currentPage > 1) {
        var prevPage = currentPage - 1;
        pagination.append('<li class="page-item"><a class="page-link" href="#" data-page="' + prevPage + '">Previous</a></li>');
      } else {
        pagination.append('<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>');
      }

      // Menampilkan halaman saat ini
      pagination.append('<li class="page-item active"><a class="page-link" href="#" data-page="' + currentPage + '">' + currentPage + '</a></li>');

      // Menampilkan halaman-halaman lainnya
      for (var i = 1; i <= 3; i++) {
        var nextPage = currentPage + i;
        pagination.append('<li class="page-item"><a class="page-link" href="#" data-page="' + nextPage + '">' + nextPage + '</a></li>');
      }

      // Menampilkan tombol Next
      var nextPage = currentPage + 1;
      pagination.append('<li class="page-item"><a class="page-link" href="#" data-page="' + nextPage + '">Next</a></li>');
    }

    // Menangani klik paginasi
    $(document).on('click', '.page-link', function(e) {
      e.preventDefault();
      var page = $(this).data('page');
      if (page !== currentPage) {
        currentPage = page;
        loadCategoryData(currentPage);
      }
    });

    // Fungsi untuk memuat data kategori berdasarkan pencarian
    function searchCategoryData(page, keyword) {
      $.ajax({
        url: 'controller/data_barang/search_category.php', // Path ke skrip PHP untuk pencarian data kategori
        type: 'POST',
        data: {
          page: page,
          keyword: keyword
        },
        dataType: 'html',
        success: function(response) {
          $('#category-list').html(response);
          updatePagination();
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Terjadi kesalahan saat melakukan permintaan AJAX'
          });
        }
      });
    }

    // Menangani perubahan input pencarian
    $('#search-input').on('input', function() {
      var keyword = $(this).val();
      searchCategoryData(currentPage, keyword);
    });

    // Memperbarui tampilan paginasi saat memuat halaman pertama
    updatePagination();

    // Menangani submit form tambah kategori
    $(document).on('submit', '#add-category-form', function(event) {
      event.preventDefault();
      var sub_category = $('#sub_category').val();
      var category = $('#category').val();

      $.ajax({
        type: 'POST',
        url: 'controller/data_barang/tambah_category.php',
        data: {
          sub_category: sub_category,
          category: category
        },
        success: function(response) {
          if (response === 'success') {
            loadCategoryData(currentPage);
            $('#add-category-modal').modal('hide');
            $('#add-category-form')[0].reset();
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: 'Barang berhasil ditambahkan!'
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Kesalahan',
              text: 'Terjadi kesalahan saat menambahkan barang'
            });
          }
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Terjadi kesalahan saat melakukan permintaan AJAX'
          });
        }
      });
    });

    // Menangani klik edit kategori
    $(document).on('click', '.edit-category', function() {
      var categoryId = $(this).data('id');

      $.ajax({
        type: 'GET',
        url: 'controller/data_barang/get_category.php',
        data: {
          category_id: categoryId
        },
        success: function(response) {
          if (response !== 'false') {
            var categoryData = response.split(',');

            // Mengisi nilai input pada modal edit
            $('#edit-category-modal input[name="id"]').val(categoryId);
            $('#edit-category-modal input[name="sub_category"]').val(categoryData[0]);
            $('#edit-category-modal input[name="category"]').val(categoryData[1]);
            $('#edit-category-modal').modal('show');
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Kesalahan',
              text: 'Gagal mendapatkan data kategori. Silakan coba lagi.'
            });
          }
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Terjadi kesalahan saat memproses permintaan Anda.'
          });
        }
      });
    });

    // Menangani submit form edit kategori
    $('#edit-category-modal form').submit(function(event) {
      event.preventDefault();
      var categoryId = $('#edit-category-modal input[name="id"]').val();
      var subCategory = $('#edit-category-modal input[name="sub_category"]').val();
      var category = $('#edit-category-modal input[name="category"]').val();

      var formData = new FormData();
      formData.append('category_id', categoryId);
      formData.append('sub_category', subCategory);
      formData.append('category', category);

      $.ajax({
        type: 'POST',
        url: 'controller/data_barang/edit_category.php',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if (response === 'success') {
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: 'Data Kategori berhasil diubah!'
            });
            $('#edit-category-modal').modal('hide');
            $('#edit-category-modal form')[0].reset();
            loadCategoryData(currentPage); // load ulang data
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Kesalahan',
              text: 'Terjadi kesalahan saat mengubah kategori.'
            });
          }
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Terjadi kesalahan saat memproses permintaan Anda.'
          });
        }
      });
    });

    // Menangani klik hapus kategori
    // Menangani klik hapus kategori
    $(document).on('click', '.delete-category', function() {
      var categoryId = $(this).data('id');

      Swal.fire({
        icon: 'warning',
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menghapus kategori ini?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: 'POST',
            url: 'controller/data_barang/hapus_category.php',
            data: {
              category_id: categoryId
            },
            success: function(response) {
              if (response === 'success') {
                Swal.fire({
                  icon: 'success',
                  title: 'Sukses',
                  text: 'Data Kategori berhasil dihapus!'
                });
                loadCategoryData(currentPage); // load ulang data
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Kesalahan',
                  text: 'Terjadi kesalahan saat menghapus kategori.'
                });
              }
            },
            error: function() {
              Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: 'Terjadi kesalahan saat memproses permintaan Anda.'
              });
            }
          });
        }
      });
    });


    // Memperbarui tampilan paginasi saat memuat halaman pertama
    updatePagination();
  });
</script>