<?php
//mengembalikan ke dashboard jika sudah login jika belum login
//$_SESSION adalah mekanisme penyimpanan informasi kedalam variabel agar
// $_SESSION['login'] = true;
//bisa digunakan lebih dari satu halaman
session_start();
include 'funcition.php';
// //cek cookei login
// if (isset($_COOKIE['login'])) {
//   //cek value
//   if ($_COOKIE['login'] == 'true') {
//     //set session true
//     $_SESSION['login'] = true;
//   }
// }
//kalo ada $_SESSION['login'] / kalo sudah login maka kembalikan ke index
//jika ada session[login]
if (isset($_SESSION["login"])) {
  echo '<script>window.location="admin/index.php"</script>';
}


if (isset($_POST["login"])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['pass']);
  //cek akun ada apa tidak
  $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE email = '" . $email . "' AND password = '" . $password . "'");
  //cek validasi login
  if (mysqli_num_rows($cek) > 0) {
    $a = mysqli_fetch_object($cek);
    $_SESSION['login'] = true;
    $_SESSION['id_admin'] = $a->id_admin;
    $_SESSION['nama'] = $a->admin_name;
    $_SESSION['email'] = $a->email;
    $_SESSION['avatar'] = $a->avatar;
    $_SESSION['level'] = $a->level;

    //cek remember me
    if (isset($_POST['remember'])) {
      //buat cookei
      setcookie('login', 'true', time() + 345600); //waktu 4 hari
    }
    //$_COOKEI sendiri untuk menyimpan data user untuk beberapa waktu
    //ada waktu kadarulasa

    echo '<script>alert("Login Berhasil")</script>';
    echo '<script>window.location="admin/index.php"</script>';
  } else {
    echo '<script>alert("Gagal, username atau password salah")</script>';
  }
}
//untuk password_verify,password_hash
// session_start();
// require 'funcition.php';
?>

<!DOCTYPE html>
<html>

<head>
  <title>Login Form Admin</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <img class="wave" src="img/wave-biru.png">
  <div class="container">
    <div class="img">
      <img src="img/Online shopping _Monochromatic.svg">
    </div>
    <div class="login-content">
      <form action="" method="POST">
        <img src="img/avatar.png">
        <h2 class="title">Welcome</h2>
        <div class="input-div one">
          <div class="i">
            <i class="fas fa-user"></i>
          </div>
          <div class="div">
            <h5>Email</h5>
            <input type="email" name="email" class="input">
          </div>
        </div>
        <div class="input-div pass">
          <div class="i">
            <i class="fas fa-lock"></i>
          </div>
          <div class="div">
            <h5>Password</h5>
            <input type="password" name="pass" class="input">
          </div>
        </div>
        <div class="remember" style="text-align:left;
        margin-left:26px;
        display:block;
        text-decoration: none;
        color: #999;
        font-size: 1rem;">
          <input type="checkbox" name="remember" id="remember">
          <label for="remember" style="color:#999;">Remember Me</label>
        </div>
        <input type="submit" class="btn" name="login" value="Login">
      </form>
    </div>
  </div>
  <script type="text/javascript" src="js/main.js"></script>
</body>

</html>