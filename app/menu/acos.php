<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->

    <!-- Dashboard -->
    <li class="nav-item">
      <a href="index.php?page=dashboard" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>

    <!-- Barang -->
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-box"></i>
        <p>
          Barang
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="index.php?page=data_barang" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data barang</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=data_category" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Category Barang</p>
          </a>
        </li>
      </ul>
    </li>

    <!-- Expired -->
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-hourglass-end"></i>
        <p>
          Reminder Expired
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="index.php?page=data_input_expired" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data expired</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=data_memasuki_expired" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Barang Memasuki Masa Expired</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=data_expired" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Barang Expired</p>
          </a>
        </li>
      </ul>
    </li>

    <!-- User -->
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Users
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="index.php?page=data_users" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Data User</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=user" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>User</p>
          </a>
        </li>
      </ul>
    </li>

    <!-- Laporan -->
    <li class="nav-item">
      <a href="index.php?page=laporan" class="nav-link">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>
          Laporan
        </p>
      </a>
    </li>

    <!-- Logout -->
    <li class="nav-item">
      <a href="#" class="nav-link text-red" onclick="confirmLogout()">
        <i class="nav-icon fas fa-power-off"></i>
        <p>
          Logout
        </p>
      </a>
</li>

</nav>

<script>
// Mendapatkan URL halaman saat ini
var currentUrl = window.location.href;

// Mendapatkan semua elemen menu
var menuItems = document.querySelectorAll('.nav-item');

// Menandai menu "Dashboard" sebagai aktif secara default
var defaultActiveMenu = document.querySelector('.nav-link[href="index.php?page=dashboard"]').closest('.nav-item');
defaultActiveMenu.classList.add('active');

// Mengecek apakah URL saat ini ada pada menu
var isUrlInMenu = false;

// Iterasi melalui setiap elemen menu
menuItems.forEach(function(menuItem) {
  // Memeriksa apakah menu ini memiliki submenu
  var submenu = menuItem.querySelector('.nav-treeview');

  // Memeriksa apakah submenu ditemukan
  if (submenu) {
    // Memeriksa apakah URL saat ini mengarah ke submenu ini
    var submenuLinks = submenu.querySelectorAll('a');

    submenuLinks.forEach(function(link) {
      if (link.href === currentUrl) {
        menuItem.classList.add('menu-open');
        submenu.style.display = 'block';
        link.classList.add('active');

        // Hapus tanda menu "Dashboard" sebagai aktif jika submenu aktif ditemukan
        defaultActiveMenu.classList.remove('active');
        isUrlInMenu = true;
      }
    });
  } else {
    // Memeriksa apakah URL saat ini mengarah ke menu ini
    var menuLink = menuItem.querySelector('a.nav-link');

    if (menuLink.href === currentUrl) {
      menuLink.classList.add('active');

      // Hapus tanda menu "Dashboard" sebagai aktif jika menu aktif ditemukan
      defaultActiveMenu.classList.remove('active');
      isUrlInMenu = true;
    }
  }
});

// Fungsi untuk menampilkan SweetAlert konfirmasi logout
function confirmLogout() {
  Swal.fire({
    title: 'Konfirmasi Logout',
    text: 'Anda akan logout dari akun. Lanjutkan?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Logout',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      // Jika pengguna menekan tombol "Ya, Logout"
      window.location.href = 'logout.php'; // Ganti dengan URL logout yang sesuai
    }
  });
}

// Cek jika tidak ada sesi, redirect ke halaman keluar
if (!checkSession()) {
  window.location.href = 'logout.php';
}

// Fungsi untuk memeriksa sesi
function checkSession() {
  // Ganti dengan logika sesi Anda
  var session = <?php echo isset($_SESSION['nama']) ? true : false; ?>;
  return session;
}

</script>

<style>
  /* Tambahkan gaya untuk submenu yang tidak aktif */
  .nav-item .nav-treeview .nav-item .nav-link {
    padding-left: 2.5rem;
    transition: background-color 0.3s, color 0.3s;
  }
</style>

