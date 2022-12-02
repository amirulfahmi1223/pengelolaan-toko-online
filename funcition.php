<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_olshop";
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
  echo "Gagal Connect" . mysqli_connect_error($conn);
}
function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}
function tambahKategori($data)
{
  global $conn;
  $kategori = ucwords(htmlspecialchars($data["kategori"]));
  //query insert data
  $query = "INSERT INTO tb_category
  VALUES 
  ('','$kategori')
  ";
  //panggil disini
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function tambahProduk($data)
{
  global $conn;
  $kategori = $data["kategori"];
  $nama = htmlspecialchars($data["nama"]);
  $harga = htmlspecialchars($data["harga"]);
  $stok = htmlspecialchars($data["stok"]);
  $status = htmlspecialchars($data["status"]);

  //upload gambar
  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  //query insert data
  $query = "INSERT INTO tb_product 
                 VALUES 
('','$kategori','$nama','$harga','$stok','$gambar','$status',null)
";
  //panggil disini
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function upload()
{
  $namafile = $_FILES['gambar']['name'];
  $ukuranfile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  //cek apakah tidak ada gambar yang diupload
  if ($error === 4) {
    echo "<script>
    alert('Pilih gambar terlebih dahulu');
    </script>";
    return false;
  }

  //cek apakah yang diupload adalah gambar
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'jfif'];
  $ekstensiGambar = explode('.', $namafile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>
    alert('Yang anda upload bukan gambar');
    </script>";
    return false;
  }
  //cek jika ukurannya terlalu besar
  if ($ukuranfile > 2000000) {
    echo "<script>
    alert('Ukuran gambar terlalu besar!');
    </script>";
    return false;
  }
  //lolos pengecekan, gambar siap diupload
  //generate nama gambar baru
  $namafileBaru = uniqid();
  $namafileBaru .= '.';
  $namafileBaru .= $ekstensiGambar;
  move_uploaded_file($tmpName, 'image/' . $namafileBaru);
  return $namafileBaru;
}

function hapusKategori($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = $id");
  return mysqli_affected_rows($conn);
}
function hapusProduk($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM tb_product WHERE product_id = $id");
  return mysqli_affected_rows($conn);
}
function hapusOfficer($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM tb_admin WHERE id_admin = $id");
  return mysqli_affected_rows($conn);
}
//ubah 

//ubah 
function ubahKategori($data)
{
  global $conn;
  $kategori = htmlspecialchars($data['kategori']);
  //query insert data
  $query = "UPDATE tb_category
  SET category_name = '$kategori'
  WHERE category_id = '$data[category_id]'";
  //panggil disini
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}


function ubahProduk($data)
{
  global $conn;
  $kategori = htmlspecialchars($data["kategori"]);
  $produk = htmlspecialchars($data["produk"]);
  $harga = htmlspecialchars($data["harga"]);
  $stok = htmlspecialchars($data["stok"]);
  $status = htmlspecialchars($data["status"]);
  $gambarLama = htmlspecialchars($data["gambarLama"]);

  //cek apakah user pilih gambar baru atau tidak
  if ($_FILES['gambar']['error'] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }
  $query = "UPDATE tb_product 
                 SET 
                 category_id = '$kategori',
                 product_name = '$produk',
                 product_price = '$harga',
                 product_pcs = '$stok',
                 product_image = '$gambar',
                 product_status = '$status'
                 WHERE product_id = '$data[product_id]'";
  //panggil disini
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
//ubah
function ubahOfficer($data)
{
  global $conn;
  $nama = htmlspecialchars($data["nama"]);
  $email = htmlspecialchars($data["email"]);
  $pass = htmlspecialchars($data["pass"]);
  //query insert data
  $query = "UPDATE tb_admin
    SET 
    admin_name = '$nama',
    email = '$email',
   password = '$pass'
    WHERE id_admin = '$data[id]'";
  //panggil disini
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function cari($keyword)
{
  $query = "SELECT * FROM tb_siswa
  WHERE
  nama LIKE '%$keyword%' OR
  kelas LIKE '%$keyword%' OR
  jurusan LIKE '%$keyword%' OR
  alamat LIKE '%$keyword%'
  ";
  return query($query); //query diambil dari atas/pertama
  //yaitu funcition query($query) jadi tidak dari variabel query cari
}

//register admin
function register($data)
{
  global $conn;
  $nama = htmlspecialchars($data["nama"]);
  $email = htmlspecialchars($data["email"]);
  $password = htmlspecialchars($data["pass"]);
  $level = $data['level'];
  $avatar = $data['avatar'];
  //cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT email FROM tb_admin WHERE email = '$email'");
  if (mysqli_fetch_assoc($result)) {
    echo "<script>alert('Email sudah terdaftar');</script>";
    return false; //dihentikan funcitionya
    //supaya insert nya gagal dan yang bawah tidak dijalankan
  }

  //query insert data
  $insert = "INSERT INTO tb_admin
    VALUES 
    ('','$nama','$email','$password','$level','$avatar')
    ";
  //panggil disini
  mysqli_query($conn, $insert);
  return mysqli_affected_rows($conn);
}
