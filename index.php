<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="app/dist/img/asset/user.png">
  <title>
    Login Page (Sistem Reminder Expired)
  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="app/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="app/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <style>
    body {
      background-image: url("app/dist/img/asset/bg.png");
      background-position: center top;
      background-repeat: no-repeat;
      background-size: 100%;
      background-attachment: fixed;
    }
  </style>

</head>

<body class="hold-transition login-page">
  <div>
    <h1 class="align-center font-weight text-white mb-5 fw-bold">Welcome!</h1>
  </div>
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <h3>Sistem Reminder Expired</h3>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Silahkan Login</p>

        <form action="app/controller/conf/auth.php" method="post">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-regular fa-user"></span>
              </div>
            </div>
            <input type="text" class="form-control" placeholder="Masukan NIK" name="nik">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <input type="password" class="form-control" placeholder="Password" name="password" id="passwordInput">
            <div class="input-group-append">
              <button type="button" class="btn btn-link toggle-password" style="background: none; border: none;">
                <span class="fas fa-eye"></span>
              </button>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- jQuery -->
  <script src="app/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="app/dist/js/adminlte.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="app/plugins/sweetalert2/sweetalert2.min.js"></script>

  <script>
    // Visibilitas tombol show password
    $(document).ready(function() {
      $('.toggle-password').click(function() {
        var input = $('#passwordInput');
        var icon = $(this).find('span');

        if (input.attr('type') === 'password') {
          input.attr('type', 'text');
          icon.removeClass('fas fa-eye');
          icon.addClass('fas fa-eye-slash');
        } else {
          input.attr('type', 'password');
          icon.removeClass('fas fa-eye-slash');
          icon.addClass('fas fa-eye');
        }
      });
    });

    // Mengatasi Pesan Error
    <?php
    if (isset($_GET['error'])) {
      $x = ($_GET['error']);
      if ($x == 1) {
        echo "
        var Toast = Swal.mixin({
          toast: true,
          position: 'top',
          showConfirmButton: false,
          timer: 3000
        });
        Toast.fire({
          icon: 'error',
          title: 'NIK / PASSWORD SALAH'
        });

        // Ubah URL kembali ke default
        var defaultURL = window.location.protocol + '//' + window.location.host + window.location.pathname;
        history.pushState('', document.title, defaultURL);
        ";
      } else if ($x == 2) {
        echo "
        var Toast = Swal.mixin({
          toast: true,
          position: 'top',
          showConfirmButton: false,
          timer: 3000
        });
        Toast.fire({
          icon: 'warning',
          title: 'Silahkan Input NIK dan Password'
        });

        // Ubah URL kembali ke default
        var defaultURL = window.location.protocol + '//' + window.location.host + window.location.pathname;
        history.pushState('', document.title, defaultURL);
        ";
      }
    }
    ?>
  </script>
</body>

</html>