<?php
session_start();
if (!isset($_SESSION["login"])) {
  echo '<script>window.location="../form-login.php"</script>';
}
include '../funcition.php';
$id = $_GET['product_id'];
if ($id == '') {
  echo '<script>window.location="../form-login.php"</script>';
}
if (hapusProduk($id) > 0) {
  echo "<script>alert('Hapus data berhasil')</script>";
  echo "<script>window.location='data-produk.php'</script>";
} else {
  echo "<script>alert('Hapus data gagal')</script>";
  echo mysqli_error($conn);
}
