<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Barang</h3>
          </div>

          <div class="card-body">
            <div class="row mb-3">
              <div class="col-md-8">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-barang-modal">
                  Tambah Data
                </button>
                <div class="dropdown d-inline ml-2">
                  <button class="btn btn-success dropdown-toggle" type="button" id="import-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Import Data
                  </button>
                  <div class="dropdown-menu" aria-labelledby="import-dropdown">
                    <a class="dropdown-item" href="controller/data_barang/path/formatimport.php">Format Import Data</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#import-data-modal">Import Data</a>
                  </div>
                </div>
                <button type="button" class="btn btn-info" id="export-data-btn">
                  Export Data
                </button>
              </div>
              <div class="col-md-4">
                <div class="input-group">
                  <input type="text" id="search-input" class="form-control" placeholder="Cari produk">
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead class="table-info">
                  <tr>
                    <th style="width: 5%;">NO</th>
                    <th style="width: 10%;">PLU</th>
                    <th style="width: 10%;">Barcode</th>
                    <th style="width: 15%;">Descp</th>
                    <th style="width: 5%;">Tag</th>
                    <th style="width: 10%;">Conv</th>
                    <th style="width: 10%;">Planogram</th>
                    <th style="width: 10%;">Retur Day</th>
                    <th style="width: 10%;">Min Display</th>
                    <th style="width: 10%;">Sub Category</th>
                    <th style="width: 10%;">Category</th>
                    <th style="width: 5%;">Aksi</th>
                  </tr>
                </thead>
                <tbody id="products-list"></tbody>
              </table>
            </div>
            <nav>
              <ul class="pagination justify-content-center" id="pagination"></ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- /.container-fluid -->
<!-- Modal Tambah -->
<div class="modal fade" id="add-barang-modal" tabindex="-1" role="dialog" aria-labelledby="modalTambahDataLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahDataLabel">Tambah Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Add form fields for adding data here -->
        <form id="add_barang_form">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="plu-input">PLU</label>
                <input type="text" class="form-control" name="plu" id="plu" placeholder="Masukkan PLU" required>
              </div>
              <div class="form-group">
                <label for="barcode-input">Barcode</label>
                <input type="text" class="form-control" name="barcode" id="barcode" placeholder="Masukkan Barcode" required>
              </div>
              <div class="form-group">
                <label for="descp-input">Descp</label>
                <input type="text" class="form-control" name="descp" id="descp" placeholder="Masukkan Descp" required>
              </div>
              <div class="form-group">
                <label for="tag-input">Tag</label>
                <input type="text" class="form-control" name="tag" id="tag" placeholder="Masukkan Tag" required>
              </div>
              <div class="form-group">
                <label for="category-input">Category</label>
                <select class="form-control" name="category" id="category" required>
                  <option value="">Pilih Category</option>
                  <?php
                  // Koneksi ke database
                  include '../conf/config.php';

                  // Query untuk mengambil data kategori dari tabel "Category"
                  $sql = "SELECT id, category FROM tb_category";
                  $result = $koneksi->query($sql);

                  // Buat markup HTML untuk opsi pilihan kategori
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo '<option value="' . $row['id'] . '">' . $row['category'] . '</option>';
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="sub-category-input">Sub Category</label>
                <input type="text" class="form-control" name="sub_category" id="sub-category" placeholder="Masukkan Sub Category" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="conv1-input">Conv1</label>
                <input type="text" class="form-control" name="conv1" id="conv1" placeholder="Masukkan Conv1" required>
              </div>
              <div class="form-group">
                <label for="conv2-input">Conv2</label>
                <input type="text" class="form-control" name="conv2" id="conv2" placeholder="Masukkan Conv2" required>
              </div>
              <div class="form-group">
                <label for="planogram-input">Planogram</label>
                <input type="text" class="form-control" name="planogram" id="planogram" placeholder="Masukkan Planogram" required>
              </div>
              <div class="form-group">
                <label for="retur-day-input">Retur Day</label>
                <input type="text" class="form-control" name="retur_day" id="retur-day" placeholder="Masukkan Retur Day">
              </div>
              <div class="form-group">
                <label for="min-disp-input">Min Display</label>
                <input type="text" class="form-control" name="min_disp" id="min-disp" placeholder="Masukkan Min Display" required>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" form="add_barang_form" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Edit -->
<div class="modal fade" id="edit-barang-modal" tabindex="-1" role="dialog" aria-labelledby="modalEditDataLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditDataLabel">Edit Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Edit form fields for updating data here -->
        <form id="edit_barang_form">
          <input type="hidden" name="id" id="edit-id">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit-plu-input">PLU</label>
                <input type="text" class="form-control" name="plu" id="edit-plu" placeholder="Masukkan PLU" required>
              </div>
              <div class="form-group">
                <label for="edit-barcode-input">Barcode</label>
                <input type="text" class="form-control" name="barcode" id="edit-barcode" placeholder="Masukkan Barcode" required>
              </div>
              <div class="form-group">
                <label for="edit-descp-input">Descp</label>
                <input type="text" class="form-control" name="descp" id="edit-descp" placeholder="Masukkan Descp" required>
              </div>
              <div class="form-group">
                <label for="edit-tag-input">Tag</label>
                <input type="text" class="form-control" name="tag" id="edit-tag" placeholder="Masukkan Tag" required>
              </div>
              <div class="form-group">
                <label for="edit-category-input">Category</label>
                <select class="form-control" name="category" id="edit-category" required>
                  <option value="">Pilih Category</option>
                  <!-- Populate category options here -->
                  <?php
                  // Koneksi ke database
                  include '../conf/config.php';

                  // Query untuk mengambil data kategori dari tabel "Category"
                  $sql = "SELECT id, category FROM tb_category";
                  $result = $koneksi->query($sql);

                  // Loop untuk menghasilkan opsi kategori
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $selected = ($row['id'] == $category_id) ? 'selected' : ''; // Memeriksa apakah kategori saat ini adalah kategori yang sedang diedit
                      echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['category'] . '</option>';
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="edit-sub-category-input">Sub Category</label>
                <input type="text" class="form-control" name="sub_category" id="edit-sub-category" placeholder="Masukkan Sub Category" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit-conv1-input">Conv1</label>
                <input type="text" class="form-control" name="conv1" id="edit-conv1" placeholder="Masukkan Conv1" required>
              </div>
              <div class="form-group">
                <label for="edit-conv2-input">Conv2</label>
                <input type="text" class="form-control" name="conv2" id="edit-conv2" placeholder="Masukkan Conv2" required>
              </div>
              <div class="form-group">
                <label for="edit-planogram-input">Planogram</label>
                <input type="text" class="form-control" name="planogram" id="edit-planogram" placeholder="Masukkan Planogram" required>
              </div>
              <div class="form-group">
                <label for="edit-retur-day-input">Retur Day</label>
                <input type="text" class="form-control" name="retur_day" id="edit-retur-day" placeholder="Masukkan Retur Day" required>
              </div>
              <div class="form-group">
                <label for="edit-min-disp-input">Min Display</label>
                <input type="text" class="form-control" name="min_disp" id="edit-min-disp" placeholder="Masukkan Min Display" required>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" form="edit_barang_form" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal Import -->
<div class="modal fade" id="import-data-modal" tabindex="-1" role="dialog" aria-labelledby="importDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importDataModalLabel">Impor Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="import-data-form" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="import-file">Pilih File</label>
            <input type="file" class="form-control-file" id="import-file" name="import-file" accept=".csv, .xlsx, .xls" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Export Modal -->
<div class="modal fade" id="export-data-modal" tabindex="-1" role="dialog" aria-labelledby="exportDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exportDataModalLabel">Export Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="export-data-form">
        <div class="modal-body">
          <div class="form-group">
            <label for="export-file-name">File Name</label>
            <input type="text" class="form-control" id="export-file-name" name="export-file-name" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Export</button>
        </div>
      </form>
    </div>
  </div>
</div>
</section>



<script>
  $(document).ready(function() {
    // Ketika pilihan pada kolom "Category" berubah
    $('#category').change(function() {
      var categoryId = $(this).val();

      // Mengambil data sub category berdasarkan pilihan kategori dari database
      $.ajax({
        url: 'controller/data_barang/get_subcategory.php',
        type: 'POST',
        data: {
          category_id: categoryId
        },
        dataType: 'text', // Menggunakan tipe data 'text'
        success: function(response) {
          // Mengisi kolom "Sub Category" dengan data sub category yang didapat
          $('#sub-category').val(response);
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText); // Menampilkan pesan kesalahan pada konsol
          alert('Terjadi kesalahan saat mengambil data sub category');
        }
      });
    });
  });
  $('#edit-barang-modal select[name="category"]').on('change', function() {
    var categoryId = $(this).val();

    // Mengirim permintaan Ajax untuk mendapatkan sub_category berdasarkan categoryId
    $.ajax({
      url: 'controller/data_barang/get_subcategory.php',
      method: 'POST',
      data: {
        category_id: categoryId
      },
      success: function(response) {
        // Mengisi nilai sub_category dengan hasil yang diterima dari server
        $('#edit-sub-category').val(response);
      }
    });
  });


  document.getElementById('import-file').addEventListener('change', handleImportFile);

  function handleImportFile(event) {
    const file = event.target.files[0];
    const formData = new FormData();
    formData.append('import-file', file);

    // Tampilkan SweetAlert konfirmasi sebelum mengirim permintaan AJAX
    Swal.fire({
      icon: 'question',
      title: 'Import Data',
      text: 'Anda yakin ingin mengimport data?',
      showCancelButton: true,
      confirmButtonText: 'Import',
      cancelButtonText: 'Batal',
      allowOutsideClick: false,
      allowEscapeKey: false
    }).then(function(result) {
      if (result.isConfirmed) {
        $.ajax({
          url: 'controller/data_barang/path/import.php', // Update the URL with the correct path to import.php
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            // Handle the response from the server
            console.log(response);
            if (response === 'success') {
              // Show SweetAlert success message
              Swal.fire({
                icon: 'success',
                title: 'Import Success',
                text: 'Data berhasil diimpor'
              }).then(function() {
                // Reload the page
                location.reload();
              });
            } else {
              // Show SweetAlert error message
              Swal.fire({
                icon: 'error',
                title: 'Import Failed',
                text: 'Gagal menyimpan data ke database'
              });
            }
          },
          error: function(xhr, status, error) {
            // Handle errors
            console.error(error);
          }
        });
      } else {
        // Pengguna membatalkan import, reset input file
        document.getElementById('import-file').value = '';
      }
    });
  }



  document.getElementById("export-data-btn").addEventListener("click", function() {
    // Kirim permintaan AJAX ke server untuk mengakses skrip ekspor data
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "controller/data_barang/path/export.php", true);
    xhr.responseType = "blob"; // Mengharapkan respon dalam bentuk file blob
    xhr.onload = function(event) {
      if (xhr.status === 200) {
        // Dapatkan respon blob
        var blob = xhr.response;
        // Buat tautan untuk men-download file
        var downloadLink = document.createElement("a");
        downloadLink.href = URL.createObjectURL(blob);
        downloadLink.download = "data_barang.csv"; // Nama file untuk diunduh
        downloadLink.click();
      }
    };
    xhr.send();
  });


  // Load data function
  function load_data(page, search_query) {
    $.ajax({
      url: 'controller/data_barang/show_barang.php',
      method: 'POST',
      data: {
        page: page,
        search_query: search_query
      },
      success: function(response) {
        products_list.html(response);
      },
      error: function() {
        alert('Terjadi kesalahan saat memuat data barang');
      }
    });
  }

  // Rest of the code...
  $(document).ready(function() {
    var current_page = 1;
    var products_list = $('#products-list');
    var start_button = $('#start');
    var end_button = $('#end');
    var search_input = $('#search-input');
    var add_barang_modal = $('#add-barang-modal');
    var add_barang_form = add_barang_modal.find('form');
    var totalItems = 0;
    var itemsPerPage = 10;
    var totalPages = 0;
    var displayPages = 4; // Jumlah halaman yang akan ditampilkan
    var pagination = $('#pagination');

    // Function to load data with pagination
    function load_data(page, search_query) {
      $.ajax({
        url: 'controller/data_barang/show_barang.php',
        method: 'POST',
        data: {
          page: page,
          search_query: search_query
        },
        success: function(response) {
          var data = JSON.parse(response);
          products_list.html(data.html);

          // Update totalItems from the server response
          totalItems = parseInt(data.total_items);

          // Update pagination links
          updatePaginationLinks(page);
        },
        error: function() {
          alert('Terjadi kesalahan saat memuat data barang');
        }
      });
    }

    // Function to update pagination links
    function updatePaginationLinks(page) {
      // Calculate total number of pages
      totalPages = calculateTotalPages(totalItems, itemsPerPage);

      // Calculate start and end page based on current page and displayPages
      var start_page = Math.max(page - Math.floor(displayPages / 2), 1);
      var end_page = Math.min(start_page + displayPages - 1, totalPages);
      start_page = Math.max(end_page - displayPages + 1, 1);

      var links = '';

      // Create start and end page links
      links += '<li class="page-item ' + (page === 1 ? 'disabled' : '') + '"><a class="page-link" href="#" id="start">Start</a></li>';

      // Create dynamic page links
      for (var i = start_page; i <= end_page; i++) {
        links += '<li class="page-item ' + (i === page ? 'active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
      }

      links += '<li class="page-item ' + (page === totalPages ? 'disabled' : '') + '"><a class="page-link" href="#" id="end">End</a></li>';

      pagination.html(links);

      var start_link = pagination.find('#start');
      var end_link = pagination.find('#end');
      var page_links = pagination.find('.page-link');

      start_link.off('click');
      end_link.off('click');
      page_links.off('click');

      start_link.on('click', function(e) {
        e.preventDefault();
        if (!start_link.parent().hasClass('disabled')) {
          current_page = 1;
          load_data(current_page, search_input.val());
        }
      });

      end_link.on('click', function(e) {
        e.preventDefault();
        if (!end_link.parent().hasClass('disabled')) {
          current_page = totalPages;
          load_data(current_page, search_input.val());
        }
      });

      page_links.on('click', function(e) {
        e.preventDefault();
        var clicked_page = parseInt($(this).data('page'));
        if (current_page !== clicked_page) {
          current_page = clicked_page;
          load_data(current_page, search_input.val());
        }
      });

      // Disable/enable start and end buttons based on current page
      start_link.parent().toggleClass('disabled', current_page === 1);
      end_link.parent().toggleClass('disabled', current_page === totalPages);
    }

    // Function to calculate the total number of pages
    function calculateTotalPages(totalItems, itemsPerPage) {
      return Math.ceil(totalItems / itemsPerPage);
    }

    // Search input event handler
    search_input.on('keyup', function() {
      current_page = 1; // Reset current page to 1
      load_data(current_page, search_input.val());
    });

    // Load data for the initial page
    load_data(current_page, '');



    // Menambahkan Barang
    add_barang_form.submit(function(event) {
      event.preventDefault();
      var plu = add_barang_form.find('input[name="plu"]').val();
      var barcode = add_barang_form.find('input[name="barcode"]').val();
      var descp = add_barang_form.find('input[name="descp"]').val();
      var tag = add_barang_form.find('input[name="tag"]').val();
      var conv1 = add_barang_form.find('input[name="conv1"]').val();
      var conv2 = add_barang_form.find('input[name="conv2"]').val();
      var planogram = add_barang_form.find('input[name="planogram"]').val();
      var retur_day = add_barang_form.find('input[name="retur_day"]').val();
      var min_disp = add_barang_form.find('input[name="min_disp"]').val();
      var sub_category = add_barang_form.find('input[name="sub_category"]').val();
      var category = add_barang_form.find('select[name="category"] option:selected').text();

      var formData = {
        plu: plu,
        barcode: barcode,
        descp: descp,
        tag: tag,
        conv1: conv1,
        conv2: conv2,
        planogram: planogram,
        retur_day: retur_day,
        min_disp: min_disp,
        sub_category: sub_category,
        category: category
      };

      $.ajax({
        type: 'POST',
        url: 'controller/data_barang/tambah_barang.php',
        data: formData,
        success: function(response) {
          if (response === 'error') {
            Swal.fire({
              icon: 'error',
              title: 'Kesalahan',
              text: 'Terjadi kesalahan saat menambahkan barang',
            });
          } else {
            load_data(current_page);
            $('#add-barang-modal').modal('hide');
            add_barang_form[0].reset();
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: 'Barang berhasil ditambahkan!',
            });
          }
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Terjadi kesalahan saat melakukan permintaan AJAX',
          });
        },
      });
    });

    $('#add-barang-modal').on('hidden.bs.modal', function() {
      $(this).find('form')[0].reset();
    });

    // Tampilkan Modal Edit Barang
    $(document).on('click', '.edit-barang-btn', function() {
      var id = $(this).data('id');

      $.ajax({
        type: 'GET',
        url: 'controller/data_barang/get_barang.php',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          $('#edit-barang-modal input[name="id"]').val(response.id);
          $('#edit-barang-modal input[name="plu"]').val(response.plu);
          $('#edit-barang-modal input[name="barcode"]').val(response.barcode);
          $('#edit-barang-modal input[name="descp"]').val(response.descp);
          $('#edit-barang-modal input[name="tag"]').val(response.tag);
          $('#edit-barang-modal input[name="conv1"]').val(response.conv1);
          $('#edit-barang-modal input[name="conv2"]').val(response.conv2);
          $('#edit-barang-modal input[name="planogram"]').val(response.planogram);
          $('#edit-barang-modal input[name="retur_day"]').val(response.retur_day);
          $('#edit-barang-modal input[name="min_disp"]').val(response.min_disp);
          $('#edit-barang-modal input[name="sub_category"]').val(response.sub_category);
          $('#edit-barang-modal input[name="category"]').val(response.category);
          $('#edit-barang-modal').modal('show');
        }
      });
    });


    // Edit barang
    $('#edit-barang-modal form').submit(function(event) {
      event.preventDefault();
      var id = $('#edit-barang-modal input[name="id"]').val();
      var plu = $('#edit-barang-modal input[name="plu"]').val();
      var barcode = $('#edit-barang-modal input[name="barcode"]').val();
      var descp = $('#edit-barang-modal input[name="descp"]').val();
      var tag = $('#edit-barang-modal input[name="tag"]').val();
      var conv1 = $('#edit-barang-modal input[name="conv1"]').val();
      var conv2 = $('#edit-barang-modal input[name="conv2"]').val();
      var planogram = $('#edit-barang-modal input[name="planogram"]').val();
      var retur_day = $('#edit-barang-modal input[name="retur_day"]').val();
      var min_disp = $('#edit-barang-modal input[name="min_disp"]').val();
      var sub_category = $('#edit-barang-modal input[name="sub_category"]').val();
      var category = $('#edit-barang-modal select[name="category"] option:selected').text();

      var formData = {
        id: id,
        plu: plu,
        barcode: barcode,
        descp: descp,
        tag: tag,
        conv1: conv1,
        conv2: conv2,
        planogram: planogram,
        retur_day: retur_day,
        min_disp: min_disp,
        sub_category: sub_category,
        category: category
      };

      $.ajax({
        type: 'POST',
        url: 'controller/data_barang/edit_barang.php',
        data: formData,
        success: function(response) {
          if (response === 'success') {
            load_data(current_page);
            $('#edit-barang-modal').modal('hide');
            $('#edit-barang-modal form')[0].reset();
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: 'Data Barang berhasil diubah!',
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Kesalahan',
              text: 'Terjadi kesalahan saat mengubah barang',
            });
          }
        },
      });
    });
    // Hapus User
    $(document).on('click', '.delete-barang-btn', function() {
      var id = $(this).data('id');

      Swal.fire({
        icon: 'warning',
        title: 'Konfirmasi',
        text: 'Anda yakin ingin menghapus user ini?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: 'POST',
            url: 'controller/data_barang/hapus_barang.php',
            data: {
              id: id
            },
            success: function(response) {
              if (response === 'success') {
                load_data(current_page);
                Swal.fire({
                  icon: 'success',
                  title: 'Sukses',
                  text: 'Data barang berhasil dihapus!',
                });
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Kesalahan',
                  text: 'Terjadi kesalahan saat menghapus data barang',
                });
              }
            },
            error: function() {
              Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: 'Terjadi kesalahan saat menghapus data barang',
              });
            }
          });
        }
      });
    });
  });
</script>