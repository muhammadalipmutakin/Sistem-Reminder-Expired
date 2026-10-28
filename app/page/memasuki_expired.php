<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h2 class="fs-1">Barang Memasuki Masa Retur</h2>
          </div>
          <div class="card-body">
            <div class="input-group mb-3">
              <input type="text" id="search-input" class="form-control" placeholder="Cari produk">
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
                    <th>Detail</th>
                    <th>Confirm</th>
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
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->


<!-- Modal detail Produk -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Detail Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm" class="row">
          <div class="col-md-6">
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editPLU" class="col-sm-4 col-form-label">PLU</label>
              <div class="col-sm-8">
                <p id="editPLU" class="product-info"></p>
              </div>
            </div>
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editBarcode" class="col-sm-4 col-form-label">Barcode</label>
              <div class="col-sm-8">
                <p id="editBarcode" class="product-info"></p>
              </div>
            </div>
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editDescp" class="col-sm-4 col-form-label">Descp</label>
              <div class="col-sm-8">
                <p id="editDescp" class="product-info"></p>
              </div>
            </div>
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editReturHari" class="col-sm-4 col-form-label">Retur Hari</label>
              <div class="col-sm-8">
                <p id="editReturHari" class="product-info"></p>
              </div>
            </div>
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editExpiredDate" class="col-sm-4 col-form-label">Tgl Expired</label>
              <div class="col-sm-8">
                <p id="editExpiredDate" class="product-info"></p>
              </div>
            </div>
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editTglTarik" class="col-sm-4 col-form-label">Tgl Tarik</label>
              <div class="col-sm-8">
                <p id="editTglTarik" class="product-info"></p>
              </div>
            </div>
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editJumlahExpired" class="col-sm-4 col-form-label">Jumlah Expired</label>
              <div class="col-sm-8">
                <p id="editJumlahExpired" class="product-info"></p>
              </div>
            </div>
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editTempatDisplay" class="col-sm-4 col-form-label">Tempat Display</label>
              <div class="col-sm-8">
                <p id="editTempatDisplay" class="product-info"></p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editTag" class="col-sm-4 col-form-label">Tag</label>
              <div class="col-sm-8">
                <p id="editTag" class="product-info"></p>
              </div>
            </div>
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editConv1" class="col-sm-4 col-form-label">Conv1</label>
              <div class="col-sm-8">
                <p id="editConv1" class="product-info"></p>
              </div>
            </div>
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editConv2" class="col-sm-4 col-form-label">Conv2</label>
              <div class="col-sm-8">
                <p id="editConv2" class="product-info"></p>
              </div>
            </div>
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editMinDisp" class="col-sm-4 col-form-label">Min Disp</label>
              <div class="col-sm-8">
                <p id="editMinDisp" class="product-info"></p>
              </div>
            </div>
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editSubCategory" class="col-sm-4 col-form-label">Sub Category</label>
              <div class="col-sm-8">
                <p id="editSubCategory" class="product-info"></p>
              </div>
            </div>
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editCategory" class="col-sm-4 col-form-label">Category</label>
              <div class="col-sm-8">
                <p id="editCategory" class="product-info"></p>
              </div>
            </div>
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editTglInput" class="col-sm-4 col-form-label">Tgl Input</label>
              <div class="col-sm-8">
                <p id="editTglInput" class="product-info"></p>
              </div>
            </div>
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editUserInput" class="col-sm-4 col-form-label">User Input</label>
              <div class="col-sm-8">
                <p id="editUserInput" class="product-info"></p>
              </div>
            </div>
            <!-- Form Group -->
            <div class="form-group form-row">
              <label for="editStatus" class="col-sm-4 col-form-label">Status</label>
              <div class="col-sm-8">
                <p id="editStatus" class="product-info"></p>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Confirm -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="confirmForm">
          <div class="form-group">
            <input type="hidden" name="id" id="edit-id">
            <label for="rackDisplay">Apakah barang berada pada rak display?</label>
            <select class="form-control" id="rackDisplay" name="rackDisplay">
              <option value="">- Pilih -</option>
              <option value="ya">Ya</option>
              <option value="tidak">Tidak</option>
            </select>
            <div class="invalid-feedback">Silakan pilih opsi untuk rak display.</div>
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
            <div class="invalid-feedback">Silakan isi keterangan.</div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="confirmButton">Konfirmasi</button>
      </div>
    </div>
  </div>
</div>
</section>

<script>
  $(document).ready(function() {
    var current_page = 1;
    var products_list = $('#products-list');
    var pagination = $('#pagination');
    var total_pages = 0;
    var search_query = '';

    function load_data(page, search_query) {
      $.ajax({
        url: 'controller/data_input_expired/show_memasuki_expired.php',
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

    // detail produk
    $(document).on('click', '.edit-barang-btn', function() {
      var id = $(this).data('id');

      // Mengosongkan form
      $('#editForm')[0].reset();

      // Menampilkan modal
      $('#editModal').modal('show');

      // Mengirim permintaan AJAX untuk mendapatkan data produk
      $.ajax({
        url: 'controller/data_input_expired/get_detail.php',
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
            $('#editPLU').text(produk.plu);
            $('#editBarcode').text(produk.barcode);
            $('#editDescp').text(produk.descp);
            $('#editReturHari').text(produk.retur_day);
            $('#editExpiredDate').text(produk.tgl_expired);
            $('#editTglTarik').text(produk.tgl_tarik);
            $('#editJumlahExpired').text(produk.jml_expired);
            $('#editTempatDisplay').text(produk.planogram);
            $('#editTag').text(produk.tag);
            $('#editConv1').text(produk.conv1);
            $('#editConv2').text(produk.conv2);
            $('#editMinDisp').text(produk.min_disp);
            $('#editSubCategory').text(produk.sub_category);
            $('#editCategory').text(produk.category);
            $('#editTglInput').text(produk.tgl_input);
            $('#editUserInput').text(produk.user_input);
            $('#editStatus').text(produk.status);
          } else {
            Swal.fire('Error', 'Gagal mendapatkan data produk.', 'error');
          }
        },
        error: function() {
          Swal.fire('Error', 'Terjadi kesalahan pada server.', 'error');
        }
      });
    });


    // Confirm
    $(document).on('click', '.confirm-barang-btn', function() {
      var id = $(this).data('id');
      $('#edit-id').val(id);
      $('#confirmModal').modal('show');

      $('#confirmButton').click(function() {
        var checkDisplay = $('select[name="rackDisplay"]').val();
        var keterangan = $('#keterangan').val();

        if (checkDisplay === '') {
          $('#rackDisplay').addClass('is-invalid');
          return false;
        } else {
          $('#rackDisplay').removeClass('is-invalid');
        }

        if (keterangan === '') {
          $('#keterangan').addClass('is-invalid');
          return false;
        } else {
          $('#keterangan').removeClass('is-invalid');
        }

        // Mengirim permintaan AJAX untuk mengkonfirmasi barang
        $.ajax({
          url: 'controller/data_input_expired/confirm.php',
          method: 'POST',
          data: {
            id: id,
            checkDisplay: checkDisplay,
            keterangan: keterangan
          },
          dataType: 'json',
          success: function(response) {
            if (response.status === 'success') {
              // Menampilkan pesan sukses
              Swal.fire('Sukses', 'Barang dikonfirmasi.', 'success');
              // Menutup modal konfirmasi
              $('#confirmModal').modal('hide');
              // Reset nilai-nilai modal
              $('#confirmForm')[0].reset();
              // Memuat ulang tabel data produk
              load_data(current_page, search_query);
            } else {
              Swal.fire('Error', 'Gagal mengkonfirmasi barang.', 'error');
            }
          },
          error: function() {
            Swal.fire('Error', 'Terjadi kesalahan pada server.', 'error');
          }
        });
      });
    });



    $('#search-input').on('input', function() {
      search_query = $(this).val().trim();
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

    load_data(current_page, search_query);

  });
</script>