<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- .card header -->
        <div class="card">
          <div class="card-header">
            <h1 class="fs-1">Input Expired</h1>
          </div>
          <!-- /.card-header -->
          <!-- .card body -->
          <div class="container mt-4">
            <h2>Input Barang Expired</h2>
            <form id="expiredForm" action="#" method="POST">
              <div class="form-group">
                <label for="search">Search Produk:</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="search" name="search" placeholder="Search Produk" readonly required>
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#searchModal">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <canvas id="barcode_canvas" style="display: none;"></canvas>
              </div>
              <div class="form-group">
                <label for="plu">PLU:</label>
                <input type="text" class="form-control" id="plu" name="plu" placeholder="plu" readonly>
              </div>
              <div class="form-group">
                <label for="descp">Deskripsi:</label>
                <input type="text" class="form-control" id="descp" name="descp" placeholder="Deskripsi Produk" readonly>
              </div>
              <div class="form-group">
                <label for="retur_hari">Retur Hari:</label>
                <input type="text" class="form-control" id="retur_day" name="retur_hari" placeholder="Retur Hari" readonly>
              </div>
              <div class="form-group">
                <label for="planogram">Planogram:</label>
                <input type="text" class="form-control" id="planogram" name="planogram" placeholder="Masukkan Planogram / Tempat Display" required>
              </div>
              <div class="form-group">
                <label for="tgl_expired">Tanggal Expired:</label>
                <input type="date" class="form-control" id="tgl_expired" name="tgl_expired" required>
              </div>
              <div class="form-group">
                <label for="jml_expired">Jumlah Barang Expired:</label>
                <input type="number" class="form-control" id="jml_expired" name="jml_expired" min="1" required>
              </div>
              <button type="submit" class="btn btn-primary">Simpan</button>
              <button type="reset" class="btn btn-secondary ml-2">Reset</button>
              <a href="index.php?page=data_input_expired" class="btn btn-success ml-2">Lihat Data Expired</a>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid-->

</section>
<!-- Modal pencarian -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="searchModalLabel">Pilih Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" id="search-modal-input" placeholder="Cari Produk">
        <div id="product-list-modal" class="product-list"></div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#search-modal-input').keyup(function() {
      var query = $(this).val();
      if (query != '') {
        $.ajax({
          url: 'controller/data_input_expired/search.php',
          method: 'GET',
          data: {
            search: query
          },
          success: function(data) {
            var productContainer = $('#product-list-modal');
            productContainer.empty();
            if (data !== '') {
              var results = JSON.parse(data);
              results.forEach(function(product) {
                var option = $('<div class="product-item"></div>')
                  .data('product', product.barcode)
                  .text(product.descp)
                  .hover(
                    function() {
                      $(this).addClass('product-item-hover');
                    },
                    function() {
                      $(this).removeClass('product-item-hover');
                    }
                  );
                productContainer.append(option);
              });
            } else {
              productContainer.html('<div class="no-results">Tidak ada hasil ditemukan</div>');
            }
          }
        });
      } else {
        $('#product-list-modal').empty();
      }
    });

    $('#product-list-modal').on('click', '.product-item', function() {
      var selectedProduct = $(this).data('product');
      $('#search').val(selectedProduct);
      $('#searchModal').modal('hide');

      $.ajax({
        url: 'controller/data_input_expired/get_produk.php',
        method: 'GET',
        data: {
          search: selectedProduct
        },
        success: function(data) {
          if (data !== '') {
            var productDetails = JSON.parse(data);
            $('#plu').val(productDetails.plu);
            $('#descp').val(productDetails.descp);
            $('#retur_day').val(productDetails.retur_day);
            $('#planogram').val(productDetails.planogram);
          }
        }
      });
    });

    $('#expiredForm').submit(function(e) {
      e.preventDefault(); // Prevent the form from submitting normally

      // Collect the form data
      var plu = $('#plu').val();
      var retur_day = $('#retur_day').val();
      var planogram = $('#planogram').val();
      var tgl_expired = $('#tgl_expired').val();
      var jml_expired = $('#jml_expired').val();

      // Create an object to store the data
      var formData = {
        plu: plu,
        retur_day: retur_day,
        planogram: planogram,
        tgl_expired: tgl_expired,
        jml_expired: jml_expired
      };

      // Perform an AJAX request to save the data
      $.ajax({
        url: 'controller/data_input_expired/save_produk.php',
        method: 'POST',
        data: formData,
        success: function(response) {
          console.log(response);

          Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Data berhasil disimpan.',
          }).then(() => {
            window.location.href = "index.php?page=data_input_expired";
          });
        },
        error: function(xhr, status, error) {
          console.error(error);
          Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Terjadi kesalahan saat menyimpan data.',
          });
        }
      });
    });
  });
</script>