<?php
include('controller/conf/config.php');

if (isset($_SESSION['level'])) {
  $level = $_SESSION['level'];
} else {
  // Set level default jika tidak ada level sesi yang ditentukan
  $level = 'Guest';
}

function shouldShowElement($elementLevel, $currentLevel)
{
  // Daftar level yang harus ditampilkan oleh level sesi tertentu
  $showLevels = [
    "AC" => ["total_produk", "total_category", "total_users", "total_confirm"],
    "CREW" => ["input_expired", "barang_mendekati_expired", "barang_memasuki_expired"]
  ];

  return isset($showLevels[$currentLevel]) ? in_array($elementLevel, $showLevels[$currentLevel]) : true;
}

// Fungsi untuk mengambil jumlah total produk
function getTotalProduk($koneksi)
{
  $query = "SELECT COUNT(*) AS total_produk FROM tb_produk";
  $result = mysqli_query($koneksi, $query);
  $data = mysqli_fetch_assoc($result);
  return $data['total_produk'];
}

// Fungsi untuk mengambil jumlah total category
function getTotalCategory($koneksi)
{
  $query = "SELECT COUNT(*) AS total_category FROM tb_category";
  $result = mysqli_query($koneksi, $query);
  $data = mysqli_fetch_assoc($result);
  return $data['total_category'];
}

// Fungsi untuk mengambil jumlah total users
function getTotalUsers($koneksi)
{
  $query = "SELECT COUNT(*) AS total_users FROM tb_users";
  $result = mysqli_query($koneksi, $query);
  $data = mysqli_fetch_assoc($result);
  return $data['total_users'];
}

// Fungsi untuk mengambil jumlah input expired
function getInputExpired($koneksi)
{
  $currentDate = date("Y-m-d");
  $query = "SELECT COUNT(*) AS input_expired FROM tb_inputexpired";
  $result = mysqli_query($koneksi, $query);
  $data = mysqli_fetch_assoc($result);
  return $data['input_expired'];
}

// Fungsi untuk mengambil persentase barang mendekati expired
function getBarangMendekatiExpired($koneksi)
{
  $currentDate = date("Y-m-d");
  $query = "SELECT COUNT(*) AS barang_mendekati_expired FROM tb_inputexpired WHERE tgl_tarik <= '$currentDate' AND tgl_expired >= '$currentDate'";
  $result = mysqli_query($koneksi, $query);
  $data = mysqli_fetch_assoc($result);
  return $data['barang_mendekati_expired'];
}

// Fungsi untuk mengambil jumlah barang memasuki expired
function getBarangMemasukiExpired($koneksi)
{
  $currentDate = date("Y-m-d");
  $query = "SELECT COUNT(*) AS barang_memasuki_expired FROM tb_inputexpired WHERE tgl_expired <= '$currentDate'";
  $result = mysqli_query($koneksi, $query);
  $data = mysqli_fetch_assoc($result);
  return $data['barang_memasuki_expired'];
}

// Fungsi untuk mengambil jumlah total confirm
function getTotalConfirm($koneksi)
{
  $query = "SELECT COUNT(*) AS total_confirm FROM tb_laporan";
  $result = mysqli_query($koneksi, $query);
  $data = mysqli_fetch_assoc($result);
  return $data['total_confirm'];
}

// Fungsi untuk mengambil data frekuensi total tanggal expired dari bulan ke bulan
function getExpiredFrequency($koneksi)
{
  $query = "SELECT MONTH(tgl_expired) AS bulan, COUNT(*) AS frekuensi FROM tb_laporan GROUP BY MONTH(tgl_expired)";
  $result = mysqli_query($koneksi, $query);
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['bulan']] = $row['frekuensi'];
  }
  return $data;
}

?>

<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="modalContent">
          <div class="card">
            <div class="card-header bg-warning">
              <h2 class="fs-4">Reminder Expired Barang</h2>
            </div>
            <div class="card-body">
              <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                <table class="table table-striped" id="table1">
                  <thead>
                    <tr>
                      <th class="text-center">Descp</th>
                      <th class="text-center">Tgl Expired</th>
                      <th class="text-center">Retur Hari</th>
                      <th class="text-center">Tgl Tarik</th>
                      <th class="text-center">Planogram</th>
                    </tr>
                  </thead>
                  <tbody id="products-list">
                    <!-- Data produk akan dimasukkan di sini -->
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <p class="text-center text-danger">Action : Segera Lakukan Pengecekan dan retur ke warehouse.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>




<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header mb-2">
        <h3 class="card-title">DASHBOARD</h3>
      </div>
      <div class="row">

        <?php if (shouldShowElement("total_produk", $level)) : ?>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo getTotalProduk($koneksi); ?></h3>
                <p>Total Produk</p>
              </div>
              <div class="icon">
                <i class="fas fa-box"></i>
              </div>
              <a href="index.php?page=data_barang" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php endif; ?>

        <?php if (shouldShowElement("total_category", $level)) : ?>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo getTotalCategory($koneksi); ?></h3>
                <p>Total Category</p>
              </div>
              <div class="icon">
                <i class="fas fa-tags"></i>
              </div>
              <a href="index.php?page=data_category" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php endif; ?>

        <?php if (shouldShowElement("total_users", $level)) : ?>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo getTotalUsers($koneksi); ?></h3>
                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="index.php?page=data_users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php endif; ?>

        <?php if (shouldShowElement("input_expired", $level)) : ?>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?php echo getInputExpired($koneksi); ?></h3>
                <p>Input Expired</p>
              </div>
              <div class="icon">
                <i class="fas fa-calendar-times"></i>
              </div>
              <a href="index.php?page=data_input_expired" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php endif; ?>

        <?php if (shouldShowElement("barang_mendekati_expired", $level)) : ?>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo getBarangMendekatiExpired($koneksi); ?></h3>
                <p>Barang Memasuki Expired</p>
              </div>
              <div class="icon">
                <i class="fas fa-hourglass-half"></i>
              </div>
              <a href="index.php?page=data_memasuki_expired" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php endif; ?>

        <?php if (shouldShowElement("barang_memasuki_expired", $level)) : ?>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo getBarangMemasukiExpired($koneksi); ?></h3>
                <p>Barang Expired</p>
              </div>
              <div class="icon">
                <i class="fas fa-exclamation"></i>
              </div>
              <a href="index.php?page=data_expired" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php endif; ?>

        <?php if (shouldShowElement("total_confirm", $level)) : ?>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-pink">
              <div class="inner">
                <h3><?php echo getTotalConfirm($koneksi); ?></h3>
                <p>Total Confirm</p>
              </div>
              <div class="icon">
                <i class="fas fa-check-circle"></i>
              </div>
              <a href="index.php?page=laporan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php
// Mendapatkan data tag terbanyak dari tabel tb_laporan dengan join tb_produk berdasarkan plu
$query = "SELECT p.tag, COUNT(*) AS total 
          FROM tb_laporan l 
          JOIN tb_produk p ON p.plu = l.plu
          GROUP BY p.tag 
          ORDER BY total DESC 
          LIMIT 6";
$result = mysqli_query($koneksi, $query);

// Menyimpan data tag dan total dalam array
$tagData = [];
while ($row = mysqli_fetch_assoc($result)) {
  $tagData[] = $row;
}

// Menghitung total laporan
$totalLaporan = array_sum(array_column($tagData, 'total'));

// Menghitung persentase untuk setiap tag
foreach ($tagData as &$row) {
  $row['persentase'] = round(($row['total'] / $totalLaporan) * 100, 2);
}

// Mengurutkan data berdasarkan total secara menurun
usort($tagData, function ($a, $b) {
  return $b['total'] - $a['total'];
});

// Mengambil label tag dan persentase untuk grafik
$tagLabels = array_column($tagData, 'tag');
$tagPersentase = array_column($tagData, 'persentase');


// Mendapatkan data kategori terbanyak dari tabel tb_laporan dengan join tb_produk dan tb_category berdasarkan plu dan sub_category
$query = "SELECT c.category, COUNT(*) AS total 
          FROM tb_laporan l 
          JOIN tb_produk p ON l.plu = p.plu 
          JOIN tb_category c ON p.sub_category = c.sub_category
          GROUP BY c.category 
          ORDER BY total DESC 
          LIMIT 6";
$result = mysqli_query($koneksi, $query);

// Menyimpan data kategori dan total dalam array
$kategoriData = [];
while ($row = mysqli_fetch_assoc($result)) {
  $kategoriData[] = $row;
}

// Menghitung total laporan
$totalLaporan = array_sum(array_column($kategoriData, 'total'));

// Menghitung persentase untuk setiap kategori
foreach ($kategoriData as &$row) {
  $row['persentase'] = round(($row['total'] / $totalLaporan) * 100, 2);
}

// Mengurutkan data berdasarkan total secara menurun
usort($kategoriData, function ($a, $b) {
  return $b['total'] - $a['total'];
});

// Mengambil label kategori dan persentase untuk grafik
$kategoriLabels = array_column($kategoriData, 'category');
$kategoriPersentase = array_column($kategoriData, 'persentase');
?>



<section class="content mt-3">
  <div class="card">
    <div class="container-fluid mt-2">
      <div class="row">
        <div class="col-lg-6">
          <h5>Calendar</h5>
          <div id="calendar"></div>
        </div>
        <div class="col-lg-6">
          <h5>Chart Total Barang Expired Selama 3 Bulan Terakhir</h5>
          <div id="chart"></div>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-lg-6">
          <h5>Diagram 6 "TAG" Penyumbang Expired Terbanyak dalam %</h5>
          <div id="pieChart"></div>
        </div>
        <div class="col-lg-6">
          <h5>Diagram 6 "Category" Penyumbang Expired Terbanyak dalam %</h5>
          <div id="pieChart2"></div>
        </div>
      </div>
    </div>
  </div>
</section>


<script src="plugins/apexchart/apexcharts.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script> -->
<script>
  // Function generate calendar
  function generateCalendar() {
    var currentDate = new Date();
    var currentDay = currentDate.getDate();
    var daysInMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();
    var firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getDay();

    var calendarDates = [];
    for (var i = 1; i <= daysInMonth; i++) {
      calendarDates.push(i);
    }

    var calendarHTML = '<div class="calendar-container">';
    calendarHTML += '<table class="calendar">';
    calendarHTML += '<tr><th colspan="7">' + currentDate.toLocaleString('id-ID', {
      month: 'long',
      year: 'numeric'
    }) + '</th></tr>';
    calendarHTML += '<tr><th>Minggu</th><th>Senin</th><th>Selasa</th><th>Rabu</th><th>Kamis</th><th>Jumat</th><th>Sabtu</th></tr>';

    var dateCount = 1;
    var dayCount = 0;
    var weekCount = 1;

    for (var j = 1; j <= 6; j++) {
      calendarHTML += '<tr>';
      for (var k = 1; k <= 7; k++) {
        if (dayCount < firstDayOfMonth || dateCount > daysInMonth) {
          calendarHTML += '<td class="blank"></td>';
          if (dayCount < firstDayOfMonth) {
            dayCount++;
          }
        } else {
          var tdClass = (dateCount === currentDay) ? 'active' : '';
          var dayName = '';
          switch (k) {
            case 1:
              dayName = 'Minggu';
              break;
            case 2:
              dayName = 'Senin';
              break;
            case 3:
              dayName = 'Selasa';
              break;
            case 4:
              dayName = 'Rabu';
              break;
            case 5:
              dayName = 'Kamis';
              break;
            case 6:
              dayName = 'Jumat';
              break;
            case 7:
              dayName = 'Sabtu';
              break;
          }

          calendarHTML += '<td class="' + tdClass + ' ' + dayName + ' week-' + weekCount + '">' + dateCount + '</td>';
          dateCount++;
        }

        // Perbarui kelas minggu (week) setiap tanggal
        if (k === 7) {
          weekCount++;
        }
      }
      calendarHTML += '</tr>';
      if (dateCount > daysInMonth) {
        break;
      }
    }

    calendarHTML += '</table>';

    // Keterangan berada di sebelah kanan kalender
    calendarHTML += '<div class="legend">';
    calendarHTML += '<strong>Jadwal Cek Expired:</strong>';
    calendarHTML += '<div class="Minggu">Minggu = Lorong 1</div>';
    calendarHTML += '<div class="Senin">Senin = Lorong 2</div>';
    calendarHTML += '<div class="Selasa">Selasa = Lorong 3</div>';
    calendarHTML += '<div class="Rabu">Rabu = Lorong 4</div>';
    calendarHTML += '<div class="Kamis">Kamis = Chiller</div>';
    calendarHTML += '<div class="Jumat">Jumat = Ambalan dan Gondola</div>';
    calendarHTML += '<div class="Sabtu">Sabtu = Area Kasir</div>';
    calendarHTML += '</div>';

    calendarHTML += '</div>';

    document.getElementById('calendar').innerHTML = calendarHTML;
  }

  generateCalendar();




  // Function to generate the chart
  function generateChart() {
    // Get the data for the chart
    var data = <?php echo json_encode(getExpiredFrequency($koneksi)); ?>;

    // Get the keys of the data object
    var keys = Object.keys(data);

    // Get the last 3 keys (months)
    var last3Months = keys.slice(-3);

    // Prepare the data for the chart
    var chartData = [];
    for (var i = 0; i < last3Months.length; i++) {
      var month = last3Months[i];
      chartData.push({
        x: month,
        y: data[month]
      });
    }

    // Generate the chart options
    var options = {
      chart: {
        type: 'area',
        height: 350
      },
      dataLabels: {
        enabled: false
      },
      series: [{
        name: 'Total Expired',
        data: chartData
      }],
      xaxis: {
        type: 'numeric',
        categories: last3Months,
        labels: {
          formatter: function(value, timestamp) {
            var date = new Date(value);
            return date.toLocaleString('default', {
              month: 'long'
            });
          }
        }
      },
      yaxis: {
        title: {
          text: 'Total'
        }
      },
      tooltip: {
        x: {
          formatter: function(value, timestamp) {
            var date = new Date(value);
            return date.toLocaleString('default', {
              month: 'long'
            });
          }
        }
      }
    };

    // Generate the chart
    var chart = new ApexCharts(document.getElementById('chart'), options);
    chart.render();
  }

  // Generate the chart when the page loads
  generateChart();



  // Function to generate the pie chart
  function generatePieChart() {
    // Generate the chart options
    var options = {
      chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: true
        }
      },
      dataLabels: {
        enabled: false
      },
      series: [{
        name: 'Total',
        data: <?php echo json_encode($tagPersentase); ?>
      }],
      xaxis: {
        categories: <?php echo json_encode($tagLabels); ?>
      },
      yaxis: {
        title: {
          text: 'Tag'
        }
      }
    };

    // Generate the pie chart
    var chart = new ApexCharts(document.getElementById('pieChart'), options);
    chart.render();
  }

  // Generate the pie chart when the page loads
  generatePieChart();


  // Function to generate the second pie chart
  function generatePieChart2() {
    // Generate the chart options
    var options = {
      chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: true
        }
      },
      dataLabels: {
        enabled: false
      },
      series: [{
        name: 'Total',
        data: <?php echo json_encode($kategoriPersentase); ?>
      }],
      xaxis: {
        categories: <?php echo json_encode($kategoriLabels); ?>
      },
      yaxis: {
        title: {
          text: 'Category'
        }
      }
    };

    // Generate the second pie chart
    var chart = new ApexCharts(document.getElementById('pieChart2'), options);
    chart.render();
  }

  // Generate the second pie chart when the page loads
  generatePieChart2();

  // Variabel global untuk menyimpan status notifikasi yang ditampilkan
  var notificationShown = false;

  // Fungsi untuk menampilkan pemberitahuan pada dashboard menggunakan SweetAlert
  function showDashboardNotification(title, text, icon, tableId, page) { // Menambahkan parameter 'page'
    Swal.fire({
      title: title,
      text: text,
      icon: icon,
      showConfirmButton: true,
      allowOutsideClick: true,
      allowEscapeKey: true,
      confirmButtonText: 'Detail'
    }).then((result) => {
      if (result.isConfirmed) {
        var modal = $('#detailModal');
        modal.modal('show');

        var products_list = $('#products-list');

        $.ajax({
          url: 'controller/reminder/show_expired.php',
          method: 'POST',
          data: {
            page: page // Mengirimkan nilai 'page' ke server
          },
          success: function(response) {
            console.log("Response:", response);
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
    });
  }




  // Fungsi untuk memuat pemberitahuan pada dashboard menggunakan AJAX
  function loadDashboardNotifications() {
    $.ajax({
      url: 'controller/navbar/notif.php',
      method: 'GET',
      success: function(response) {
        var expiredCount = response.expiredCount;
        var approachingCount = response.approachingCount;
        var category = response.category;

        // Ambil level pengguna dari session storage
        var userLevel = "<?php echo $level; ?>";
        sessionStorage.setItem('level', userLevel);

        // Gabungkan notifikasi jika ada barang yang mendekati masa expired dan barang yang sudah expired pada dashboard
        if ((approachingCount > 0 || expiredCount > 0) && !notificationShown) {
          var notificationText = '';

          if (approachingCount > 0) {
            notificationText += 'Ada ' + approachingCount + ' barang yang mendekati masa expired ';
          }

          if (expiredCount > 0) {
            if (notificationText !== '') {
              notificationText += 'Dan ';
            }
            notificationText += 'Ada ' + expiredCount + ' barang yang sudah expired.'
          }

          // Menampilkan SweetAlert jika ada notifikasi mendekati expired atau expired pada dashboard
          // Hanya tampilkan jika level pengguna bukan "AC"
          if (userLevel !== "AC") {
            showDashboardNotification('Pemberitahuan Barang', notificationText, 'info');
            notificationShown = true;
          }
        }
      },
      error: function() {
        alert('Terjadi kesalahan saat memuat pemberitahuan pada dashboard');
      }
    });
  }

  // Panggil fungsi untuk memuat pemberitahuan pada dashboard saat halaman selesai dimuat
  $(document).ready(function() {
    loadDashboardNotifications();
  });
</script>

<style>
  .calendar-container {
    display: flex;
    flex-direction: row;
  }

  .calendar {
    margin-right: 10px;
  }

  .legend {
    margin-top: 10px;
    display: flex;
    flex-direction: column;
  }

  .legend div {
    margin-bottom: 5px;
  }

  .calendar td {
    position: relative;
  }

  .calendar td::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    opacity: 0.2;
  }

  .calendar td.Minggu::before {
    background-color: #FF0000;
  }

  .calendar td.Senin::before {
    background-color: #FF8C00;
  }

  .calendar td.Selasa::before {
    background-color: #FFFF00;
  }

  .calendar td.Rabu::before {
    background-color: #00FF00;
  }

  .calendar td.Kamis::before {
    background-color: #0000FF;
  }

  .calendar td.Jumat::before {
    background-color: #8A2BE2;
  }

  .calendar td.Sabtu::before {
    background-color: #808080;
  }

  .legend div.Minggu {
    color: #FF0000;
  }

  .legend div.Senin {
    color: #FF8C00;
  }

  .legend div.Selasa {
    color: #FFFF00;
  }

  .legend div.Rabu {
    color: #00FF00;
  }

  .legend div.Kamis {
    color: #0000FF;
  }

  .legend div.Jumat {
    color: #8A2BE2;
  }

  .legend div.Sabtu {
    color: #808080;
  }

  .calendar td.blank {
    background-color: #fff;
  }

  .calendar td.active {
    background-color: black;
  }
</style>