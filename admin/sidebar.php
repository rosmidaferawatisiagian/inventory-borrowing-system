<!-- Left Panel -->
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Admin - Peminjaman Barang Inventarisasi Laboratorium D3 Teknologi Komputer</title>
  <meta name="description" content="Sufee Admin - HTML5 Admin Template" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="apple-touch-icon" href="apple-icon.png" />
  <link rel="shortcut icon" href="favicon.ico" />

  <link rel="stylesheet" href="assets/css/normalize.css" />
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
  <link rel="stylesheet" href="assets/css/themify-icons.css" />
  <link rel="stylesheet" href="assets/css/flag-icon.min.css" />
  <link rel="stylesheet" href="assets/css/cs-skin-elastic.css" />
  <link
    rel="stylesheet"
    href="assets/css/lib/datatable/dataTables.bootstrap.min.css"
  />
  <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
  <link rel="stylesheet" href="assets/scss/style.scss" />

  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800"
    rel="stylesheet"
    type="text/css"
  />

  <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<aside id="left-panel" class="left-panel">
  <nav class="navbar navbar-expand-sm navbar-default">
    <div class="navbar-header">
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#main-menu"
        aria-controls="main-menu"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
<button class="navbar-toggler" type="button">
  <i class="fa fa-bars"></i>
</button>
<a class="navbar-brand" href="./">
  <img src="assets/img/uploads/RASlogo.png" width="60px" height="auto" alt="Logo" />
  Inventory Lab Tekkom
</a>

    </div>

    <div id="main-menu" class="main-menu collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active">
          <a href="../login.php">
            <i class="menu-icon fa fa-dashboard"></i>Dashboard
          </a>
        </li>

        <li class="menu-item-has-children dropdown">
          <a
            href="#"
            class="dropdown-toggle"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <i class="menu-icon fa fa-shopping-cart"></i>Peminjaman</a>
          <ul class="sub-menu children dropdown-menu">
            <li>
              <i class="menu-icon fa fa-question"></i
              ><a href="permintaan.php">Permintaan Peminjaman</a>
            </li>
            <li>
              <i class="menu-icon fa fa-shopping-cart"></i
              ><a href="barang-dipinjam.php">Barang Dipinjam</a>
            </li>
            <li>
              <i class="menu-icon fa fa-check"></i
              ><a href="permintaan-kembali.php">Konfirmasi Barang Kembali?</a>
            </li>
            <li>
              <i class="menu-icon fa fa-handshake-o"></i
              ><a href="barang-kembali.php">Barang Kembali</a>
            </li>
          </ul>
        </li>

        <li class="menu-item-has-children dropdown">
          <a
            href="#"
            class="dropdown-toggle"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <i class="menu-icon fa fa-tasks"></i>Barang</a
          >
          <ul class="sub-menu children dropdown-menu">
            <li>
              <i class="menu-icon fa fa-archive"></i
              ><a href="data-barang.php">Data Barang</a>
            </li>
            <li>
              <i class="menu-icon fa fa-plus"></i
              ><a href="tambah-barang.php">Tambah Barang</a>
            </li>
          </ul>
        </li>

        <li class="menu-item-has-children dropdown">
          <a
            href="#"
            class="dropdown-toggle"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <i class="menu-icon fa fa-user"></i>User</a
          >
          <ul class="sub-menu children dropdown-menu">
            <li>
              <i class="menu-icon fa fa-users"></i
              ><a href="data-user.php">Data User</a>
            </li>
            <!--li><i class="menu-icon ti-themify-logo"></i><a href="font-themify.html">Tambah User</a></li-->
          </ul>
        </li>

        <li class="active">
          <a href="logout.php">
            <i class="menu-icon fa fa-sign-out"></i>Logout
          </a>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
    <!-- Right Panel -->

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script>
      (function ($) {
        "use strict";

        jQuery("#vmap").vectorMap({
          map: "world_en",
          backgroundColor: null,
          color: "#ffffff",
          hoverOpacity: 0.7,
          selectedColor: "#1de9b6",
          enableZoom: true,
          showTooltip: true,
          values: sample_data,
          scaleColors: ["#1de9b6", "#03a9f5"],
          normalizeFunction: "polynomial",
        });
      })(jQuery);
    </script>
  </nav>
</aside>
<!-- /#left-panel -->