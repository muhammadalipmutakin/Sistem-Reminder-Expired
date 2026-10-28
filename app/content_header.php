<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">
          <span class="animated-text">Sistem Reminder Expired</span>
        </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<style>
  .content-header {
    position: relative;
  }

  .animated-text {
    white-space: nowrap;
    overflow: hidden;
    display: inline-block;
    position: relative;
    animation: marquee linear;
    animation-fill-mode: forwards;
    animation-duration: 10s;
  }

  @keyframes marquee {
    0% {
      transform: translateX(-100%);
    }

    100% {
      transform: translateX(calc((80vw - 100%) / 2));
    }
  }
</style>