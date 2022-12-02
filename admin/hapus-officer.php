<?php
session_start();
if (!isset($_SESSION["login"])) {
  echo '<script>window.location="../form-login.php"</script>';
}

if ($_SESSION["level"] != 'Admin') {
  echo '<script>window.location="../form-login.php"</script>';
}
include '../funcition.php';
$id = $_GET['id_admin'];
if ($id == '') {
  echo '<script>window.location="../form-login.php"</script>';
}
if (hapusOfficer($id) > 0) {
  echo "<script>alert('Hapus data berhasil')</script>";
  echo "<script>window.location='officer.php'</script>";
} else {
  echo "<script>alert('Hapus data gagal')</script>";
  echo mysqli_error($conn);
}
