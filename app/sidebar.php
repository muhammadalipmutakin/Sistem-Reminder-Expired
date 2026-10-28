<div class="sidebar">
  <div class="user">
    <div class="image text-center mt-2">
      <?php if (isset($_SESSION['foto']) && $_SESSION['foto'] !== '') : ?>
        <img src="dist/img/users/<?php echo $_SESSION['foto']; ?>" width="80%" class="img-circle elevation-2 bg-light" alt="User Image">
      <?php else : ?>
        <img src="dist/img/asset/user.png" width="80%" class="img-circle elevation-2 bg-light" alt="User Image">
      <?php endif; ?>
    </div>
  </div>
  <div class="user-panel panel text-center mt-3 mb-4">
    <a href="index.php?page=user" class="d-block"><?php echo $_SESSION['nama'] . ' | | ' . $_SESSION['level']; ?> </a>
  </div>

  <!-- Sidebar Menu -->
  <?php
  if ($_SESSION['level'] == 'AC') {
    include('menu/ac.php');
  } elseif ($_SESSION['level'] == 'COS') {
    include('menu/cos.php');
  } elseif ($_SESSION['level'] == 'ACOS') {
    include('menu/acos.php');
  } else {
    include('menu/crew.php');
  }
  ?>
  <!-- /.sidebar-menu -->
</div>