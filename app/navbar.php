<nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-top">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="text-left ml-3">
      <img src="dist/img/asset/logo.png" width="10%" alt="Alfamart" class="brand-image elevation-2">
    </li>
  </ul>

  <?php if ($_SESSION['level'] !== 'AC') : ?>
    <!-- Navbar sebelah Kanan level selain AC-->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" id="notificationCount" style="font-size: 18px;">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notificationsDropdown" style="width: 350px;">
          <span class="dropdown-item dropdown-header" id="notificationHeader" style="font-size: 20px;">0 Notifications</span>
          <div class="dropdown-divider"></div>
          <div id="approachingExpiredList"></div>
          <div id="expiredList"></div>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <?php $foto = $_SESSION['foto']; ?>
          <img src="dist/img/users/<?php echo $foto; ?>" class="user-image" alt="User Image" style="width: 30px; height: 30px; object-fit: cover; border-radius: 50%;">
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="index.php?page=user" class="dropdown-item"><i class="far fa-user-circle"></i> Profile</a>
          <div class="dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  <?php else : ?>
    <!-- Navbar sebelah kanan untuk level AC -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <?php $foto = $_SESSION['foto']; ?>
          <img src="dist/img/users/<?php echo $foto; ?>" class="user-image" alt="User Image" style="width: 30px; height: 30px; object-fit: cover; border-radius: 50%;">
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="index.php?page=user" class="dropdown-item"><i class="far fa-user-circle"></i> Profile</a>
          <div class="dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  <?php endif; ?>

</nav>




<script>
  // Fungsi untuk memuat pemberitahuan menggunakan AJAX
  function loadNotifications() {
    $.ajax({
      url: 'controller/navbar/notif.php',
      method: 'GET',
      success: function(response) {
        // Proses data pemberitahuan yang diperoleh dari backend
        var expiredCount = response.expiredCount; // Jumlah barang yang sudah expired
        var approachingCount = response.approachingCount; // Jumlah barang yang mendekati masa expired

        // Mengupdate jumlah notifikasi pada header dropdown
        var notificationsHeader = $('#notificationHeader');
        var notificationsCount = $('#notificationCount');

        // Kosongkan daftar notifikasi sebelumnya
        $('#approachingExpiredList').empty();
        $('#expiredList').empty();

        // Tampilkan pemberitahuan barang yang mendekati masa expired
        if (approachingCount > 0) {
          var approachingNotification = $('<a href="#" class="dropdown-item"></a>').html('<i class="fas fa-exclamation-triangle mr-2"></i>' + approachingCount + ' barang mendekati expired');
          approachingNotification.click(function() {
            // Aksi saat notifikasi mendekati expired di klik
            // Ganti dengan aksi sesuai kebutuhan
            window.location.href = "index.php?page=data_memasuki_expired";
          });
          $('#approachingExpiredList').append(approachingNotification);
        }

        // Tampilkan pemberitahuan barang yang sudah expired
        if (expiredCount > 0) {
          var expiredNotification = $('<a href="#" class="dropdown-item"></a>').html('<i class="fas fa-exclamation-circle mr-2"></i>' + expiredCount + ' barang expired');
          expiredNotification.click(function() {
            // Aksi saat notifikasi expired di klik
            window.location.href = "index.php?page=data_expired";
          });
          $('#expiredList').append(expiredNotification);
        }

        // Menghitung total notifikasi
        var totalNotifications = parseInt(approachingCount) + parseInt(expiredCount);


        // Mengupdate jumlah total notifikasi pada header dropdown
        notificationsHeader.text(totalNotifications + ' Notifications');
        notificationsCount.text(totalNotifications);
      },
      error: function() {
        alert('Terjadi kesalahan saat memuat pemberitahuan.');
      }
    });
  }

  // Panggil fungsi untuk memuat pemberitahuan saat halaman selesai dimuat
  $(document).ready(function() {
    loadNotifications();
    setInterval(loadNotifications, 5000);
  });
</script>