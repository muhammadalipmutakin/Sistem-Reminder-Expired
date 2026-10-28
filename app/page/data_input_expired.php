<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h2 class="fs-1">Data Input Expired</h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-8 mb-3">
                  <button type="button" class="btn btn-primary mb-4" onclick="addData()">
                    Input Expired
                  </button>
                </div>
                <div class="col-md-4 mb-3">
                  <div class="input-group">
                    <input type="text" id="search-input" class="form-control" placeholder="Cari produk">
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead class="table table-info">
                    <tr>
                      <th>NO</th>
                      <th>PLU</th>
                      <th>Barcode</th>
                      <th>Descp</th>
                      <th>Tgl Expired</th>
                      <th>Retur Hari</th>
                      <th>Tgl Tarik</th>
                      <th>Jumlah Expired</th>
                      <th>Tempat Display</th>
                      <th>Tgl Input</th>
                      <th>User</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="products-list">

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
  </div>

  <!-- Modal Edit Produk -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editForm" class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="hidden" name="id" id="id">
                <label for="editPLU">PLU</label>
                <input type="text" class="form-control" id="editPLU" name="plu" readonly>
              </div>
              <div class="form-group">
                <label for="editBarcode">Barcode</label>
                <input type="text" class="form-control" id="editBarcode" name="barcode" readonly>
              </div>
              <div class="form-group">
                <label for="editDescp">Descp</label>
                <input type="text" class="form-control" id="editDescp" name="descp" readonly>
              </div>
              <div class="form-group">
                <label for="editReturHari">Retur Hari</label>
                <input type="text" class="form-control" id="editReturHari" name="retur_day" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="editExpiredDate">Tgl Expired</label>
                <input type="date" class="form-control" id="editExpiredDate" name="tglxpired">
              </div>
              <div class="form-group">
                <label for="editTglTarik">Tgl Tarik</label>
                <input type="text" class="form-control" id="editTglTarik" name="tgl_tarik" readonly>
              </div>
              <div class="form-group">
                <label for="editJumlahExpired">Jumlah Expired</label>
                <input type="text" class="form-control" id="editJumlahExpired" name="jml_expired">
              </div>
              <div class="form-group">
                <label for="editTempatDisplay">Tempat Display</label>
                <input type="text" class="form-control" id="editTempatDisplay" name="planogram">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" form="editForm" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </div>
    </div>
  </div>

</section>
<script>
  function addData() {
    // buka halaman input data.php saat tombol diklik
    window.location.href = "index.php?page=input_expired";
  }

  $(document).ready(function() {
    var current_page = 1;
    var products_list = $('#products-list');
    var pagination = $('#pagination');
    var total_pages = 0;

    function load_data(page, search_query) {
      $.ajax({
        url: 'controller/data_input_expired/show_input_expired.php',
        method: 'POST',
        data: {
          page: page,
          search_query: search_query
        },
        success: function(response) {
          var parsedResponse = JSON.parse(response);
          products_list.html(parsedResponse.data);
          total_pages = parsedResponse.total_pages;
          updatePagination(total_pages);
          checkPaginationButtons();
        },
        error: function() {
          alert('Terjadi kesalahan saat memuat data barang');
        }
      });
    }

    $(document).on('click', '.edit-barang-btn', function() {
      var id = $(this).data('id');

      // Mengosongkan form
      $('#editForm')[0].reset();

      // Menampilkan modal
      $('#editModal').modal('show');

      // Mengirim permintaan AJAX untuk mendapatkan data produk
      $.ajax({
        url: 'controller/data_input_expired/get_edit.php',
        method: 'POST',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          if (response.status === 'success') {
            var produk = response.data;

            // Mengisi nilai form dengan data produk yang akan diedit
            $('#id').val(produk.id);
            $('#editPLU').val(produk.plu);
            $('#editBarcode').val(produk.barcode);
            $('#editDescp').val(produk.descp);
            $('#editExpiredDate').val(produk.tgl_expired);
            $('#editReturHari').val(produk.retur_day);
            $('#editTglTarik').val(produk.tgl_tarik);
            $('#editJumlahExpired').val(produk.jml_expired);
            $('#editTempatDisplay').val(produk.planogram);
          } else {
            Swal.fire('Error', 'Gagal mendapatkan data produk.', 'error');
          }
        },
        error: function() {
          Swal.fire('Error', 'Terjadi kesalahan pada server.', 'error');
        }
      });
    });

    // Kirim formulir menggunakan AJAX
    $('#editForm').submit(function(event) {
      event.preventDefault(); // Mencegah pengiriman formulir secara default

      // Dapatkan data formulir
      var formData = $(this).serialize();

      // Dapatkan nilai tgl_expired
      var tglExpired = $('#editExpiredDate').val();
      var dateObject = new Date(tglExpired);
      var formattedDate = dateObject.toISOString().split('T')[0];

      // Tambahkan nilai tgl_expired yang telah diubah ke formData
      formData += '&tgl_expired=' + formattedDate;

      // Kirim permintaan AJAX
      $.ajax({
        url: 'controller/data_input_expired/save_edit.php', // Ganti dengan URL skrip sisi server Anda
        type: 'POST',
        data: formData,
        success: function(response) {
          // Tangani respons sukses
          console.log('Edit berhasil disimpan');
          // Tutup modal
          $('#editModal').modal('hide');
          // Tampilkan pesan alert menggunakan SweetAlert2
          Swal.fire({
            title: "Edit Berhasil",
            text: "Data edit berhasil disimpan.",
            icon: "success"
          }).then(function() {
            // Segarkan halaman secara AJAX
            var search_query = $('#search-input').val().trim();
            load_data(current_page, search_query);
          });
        },
        error: function(xhr, status, error) {
          // Tangani respons error
          console.error('Error saat menyimpan edit:', error);
          // Tampilkan pesan error atau ambil tindakan yang sesuai

          // Tampilkan pesan alert menggunakan SweetAlert2
          Swal.fire({
            title: "Error",
            text: "Terjadi kesalahan saat menyimpan edit.",
            icon: "error"
          });
        }
      });
    });




    function deleteData(id) {
      Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: 'controller/data_input_expired/delete_data.php',
            method: 'POST',
            data: {
              id: id
            },
            success: function(response) {
              console.log(response);
              Swal.fire({
                title: 'Data Berhasil Dihapus',
                text: 'Data berhasil dihapus.',
                icon: 'success'
              });

              // Muat ulang data secara AJAX setelah menghapus
              var search_query = $('#search-input').val().trim();
              load_data(current_page, search_query);
            },
            error: function(xhr, status, error) {
              console.error(error);
            }
          });
        }
      });
    }

    $('#search-input').on('input', function() {
      var search_query = $(this).val().trim();
      load_data(1, search_query);
      current_page = 1;
    });

    function updatePagination(total_pages) {
      pagination.empty();

      for (var i = 1; i <= total_pages; i++) {
        var page_link = $('<li class="page-item"><a class="page-link" href="#" id="' + i + '">' + i + '</a></li>');
        if (i === current_page) {
          page_link.addClass('active');
        }
        pagination.append(page_link);
      }
    }

    function checkPaginationButtons() {
      var prev_button = $('#prev');
      var next_button = $('#next');

      if (current_page === 1) {
        prev_button.addClass('disabled');
      } else {
        prev_button.removeClass('disabled');
      }

      if (current_page === total_pages) {
        next_button.addClass('disabled');
      } else {
        next_button.removeClass('disabled');
      }
    }

    function updateCurrentPage(page) {
      current_page = page;
      checkPaginationButtons();
    }

    function navigateToPage(page) {
      var search_query = $('#search-input').val();
      load_data(page, search_query);
      $('.page-item').removeClass('active');
      $('#' + page).parent().addClass('active');
      updateCurrentPage(page);
    }

    $(document).on('click', '.page-link', function(event) {
      event.preventDefault();
      var page = $(this).attr('id');
      navigateToPage(page);
    });

    $(document).on('click', '#prev', function(event) {
      event.preventDefault();
      if (current_page > 1) {
        navigateToPage(current_page - 1);
      }
    });

    $(document).on('click', '#next', function(event) {
      event.preventDefault();
      if (current_page < total_pages) {
        navigateToPage(current_page + 1);
      }
    });

    function updateDataAndPagination(response) {
      products_list.html(response.data);
      total_pages = response.total_pages;
      updatePagination(total_pages);
      checkPaginationButtons();
    }

    load_data(current_page, '');

    $(document).on('click', '.delete-barang-btn', function() {
      var id = $(this).data('id');
      deleteData(id);
    });
  });
</script>