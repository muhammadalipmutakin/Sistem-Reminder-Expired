<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php
session_start();
if (!$_SESSION['nama']) {
  header('Location: ../index.php?session_expired');
}
include('header.php');
include('controller/conf/config.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <?php
    include('preloader.php');
    ?>

    <!-- Navbar -->
    <?php
    include('navbar.php');
    ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <?php
      include('logo.php');
      ?>

      <!-- Sidebar -->
      <?php
      include('sidebar.php');
      ?>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <?php
      include('content_header.php');
      ?>
      <!-- /.content-header -->

      <!-- Main content -->
      <?php
      if (isset($_GET['page'])) {
        if ($_GET['page'] == 'dashboard') {
          include('page/dashboard.php');
        } else if ($_GET['page'] == 'data_barang') {
          include('page/data_barang.php');
        } else if ($_GET['page'] == 'data_category') {
          include('page/data_category.php');
        } else if ($_GET['page'] == 'data_input_expired') {
          include('page/data_input_expired.php');
        } else if ($_GET['page'] == 'input_expired') {
          include('page/input_expired.php');
        } else if ($_GET['page'] == 'data_memasuki_expired') {
          include('page/memasuki_expired.php');
        } else if ($_GET['page'] == 'data_expired') {
          include('page/expired.php');
        } else if ($_GET['page'] == 'data_users') {
          include('page/data_users.php');
        } else if ($_GET['page'] == 'user') {
          include('page/user.php');
        } else if ($_GET['page'] == 'laporan') {
          include('page/laporan.php');
        } else if ($_GET['page'] == 'reminder') {
          include('page/reminder.php');
        } else {
          include('not_found.php');
        }
      } else {
        include('page/dashboard.php');
      }
      ?>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- footer -->
    <?php
    include('footer.php');
    ?>
    <!-- /footer -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- Add custom CSS for active menu highlighting -->
  <style>
    .sidebar-dark-primary .nav-sidebar .nav-item.active>.nav-link {
      background-color: #ffffff;
      color: #000000;
    }
  </style>

</body>

</html>