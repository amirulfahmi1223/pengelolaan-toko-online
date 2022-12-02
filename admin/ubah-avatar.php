<?php
//bisa menggunakan include atau require
session_start();

include '../funcition.php';
//cek kalo gada session login maka blm login
//kembalikan ke login
//jika tidak ada session[login] maka tendang ke login.php
if (!isset($_SESSION["login"])) {
  echo '<script>window.location="../form-login.php"</script>';
}

//pendeklarasian untuk mengambil id
$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE id_admin = '" . $_SESSION['id_admin'] . "'");
$d = mysqli_fetch_object($query);
if (isset($_POST['ubah'])) {
  $avatar = htmlspecialchars($_POST['avatar']);

  $profil = mysqli_query($conn, "UPDATE tb_admin SET 
     avatar = '" . $avatar . "'
     WHERE id_admin = '" . $d->id_admin . "'");
  if ($profil) {
    echo '<script>alert("Ubah Avatar berhasil")</script>';
    echo '<script>window.location="ubah-avatar.php"</script>';
  } else {
    echo '<script>alert("Ubah Avatar Gagal");</script>' . mysqli_error($conn);
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DASHBOARD - AMFASHOP</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../fontawesome/css/all.min.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../user/index.php">
        <div class="sidebar-brand-icon rotate-n-10">
          <i class="fa-solid fa-shop"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?= $_SESSION['level']; ?> AMFASHOP</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">


      <!-- Nav Item - daftar siswa -->
      <li class="nav-item">
        <a class="nav-link" href="data-kategori.php">
          <i class="fa-solid fa-tag me-3"></i>
          <span>Data Kategori</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - daftar guru -->
      <li class="nav-item">
        <a class="nav-link" href="data-produk.php">
          <i class="fa-solid fa-cart-shopping me-3"></i>
          <span>Data Produk</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Divider -->
      <?php if ($_SESSION['level'] == 'Admin') : ?>
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - daftar pegawai -->
        <li class="nav-item">
          <a class="nav-link" href="officer.php">
            <i class="fa-solid fa-user-gear me-3"></i>
            <span>Officer</span></a>
        </li>
      <?php endif; ?>
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - daftar pegawai -->
      <li class="nav-item">
        <a class="nav-link" href="setting.php">
          <i class="fas fa-cogs fa-sm fa-fw me-3"></i>
          <span>Setting</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - keluar -->
      <li class="nav-item">
        <a class="nav-link" href="keluar.php" data-toggle="modal" data-target="#logoutModal">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span>Log Out</span></a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Buttons</a>
            <a class="collapse-item" href="cards.html">Cards</a>
          </div>
        </div>
      </li> -->

      <!-- Divider -->
      <hr class=" sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>


            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['nama']; ?></span>
                <?php if ($_SESSION['avatar'] == 1) : ?>
                  <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                <?php endif; ?>
                <?php if ($_SESSION['avatar'] == 2) : ?>
                  <img class="img-profile rounded-circle" src="img/avatar-svgrepo-com.svg">
                <?php endif; ?>
                <?php if ($_SESSION['avatar'] == 3) : ?>
                  <img class="img-profile rounded-circle" src="img/avatar.svg">
                <?php endif; ?>
                <?php if ($_SESSION['avatar'] == 4) : ?>
                  <img class="img-profile rounded-circle" src="img/avatar (1).svg">
                <?php endif; ?>
                <?php if ($_SESSION['avatar'] == 5) : ?>
                  <img class="img-profile rounded-circle" src="img/undraw_profile_3.svg">
                <?php endif; ?>
                <?php if ($_SESSION['avatar'] == 6) : ?>
                  <img class="img-profile rounded-circle" src="img/avatar (2).svg">
                <?php endif; ?>
                <?php if ($_SESSION['avatar'] == 7) : ?>
                  <img class="img-profile rounded-circle" src="img/avatar (3).svg">
                <?php endif; ?>
                <?php if ($_SESSION['avatar'] == 8) : ?>
                  <img class="img-profile rounded-circle" src="img/avatar4.svg">
                <?php endif; ?>
                <?php if ($_SESSION['avatar'] == 9) : ?>
                  <img class="img-profile rounded-circle" src="img/avatar5.svg">
                <?php endif; ?>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#ModalTambah">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="ubah-avatar.php">
                  <i class="fa-solid fa-face-smile fa-sm fa-fw mr-2 text-gray-400"></i>
                  Avatar
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="keluar.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-3 text-gray-800">Ubah Avatar</h1>
          <!--Bagian nama lengkap-->
          <div class="row">
            <div class="col-md-12 ">
              <div class="card shadow-lg mb-5">
                <div class="card-body">
                  <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="form-group mt-3 mb-2">
                      <select name="avatar" id="" class="form-control mt-2" required>
                        <option value="">-- Pilih Avatar --</option>
                        <?php for ($i = 1; $i <= 9; $i++) : ?>
                          <option value="<?= $i; ?>">Avatar <?= $i; ?></option>
                        <?php endfor; ?>
                      </select>
                      <span class="mt-2" style="color:#888; font-size:12px;">*Log Out kemudian login kembali setelah mengubah avatar</span>
                    </div>
                    <button type="submit" class="btn btn-info mt-1 mb-1 float-right text-white" name="ubah">Ubah</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; FahmiCode 2022</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apakah Anda Yakin Ingin Keluar?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="keluar.php">Logout</a>
        </div>
      </div>
    </div>
  </div><!-- bagian modal profil -->
  <div class="modal fade" id="ModalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Profil <?= $_SESSION['level']; ?></h1>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"></button>
          <span aria-hidden="true"><b>X</b></span>
        </div>
        <div class="modal-body">
          <form action="murid.php" method="POST">
            <div class="mb-3">
              <label class="form-label">Nama <?= $_SESSION['level']; ?></label>
              <input type="text" class="form-control" value="<?= $_SESSION['nama']; ?>" readonly>
            </div>
            <div class="mb-3">
              <label class="form-label">Email <?= $_SESSION['level']; ?></label>
              <input type="email" value="<?= $_SESSION['email']; ?>" class="form-control" readonly>
            </div>
            <div class="mb-3">
              <label class="form-label">Level <?= $_SESSION['level']; ?></label>
              <input type="text" class="form-control" value="<?= $_SESSION['level']; ?>" readonly>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" type="button" data-dismiss="modal">Oke</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
</body>

</html>