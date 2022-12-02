<?php
//untuk menyembunyikan error yang tidak penting
error_reporting(0);
include '../funcition.php';
$k = mysqli_query($conn, "SELECT * FROM tb_category");
//bagian pencarian
if ($_GET['search'] != '' || $_GET['kat'] != '') {
  $where = "AND product_name LIKE '%" . $_GET['search'] . "%' 
  AND category_id LIKE '%" . $_GET['kat'] . "%' ";
}
$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status =  1 $where ORDER BY product_id DESC");
?>







<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TOKO | AMFASHOP</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="fontawesome/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!-- bagian navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
    <div class="container">
      <h3> <i class="fa-brands fa-shopify text-success mr-2"></i></h3>
      <a class="navbar-brand font-weight-bold" href="../admin/index.php">AMFASHOP</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mr-4">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Beranda <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="produk.php">Produk<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../admin/index.php">Gudang Admin <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Hubungi Kami<span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <form class="d-none d-sm-inline-block form-inline ml-automy-2 my-lg-0  mw-100 navbar-search d-flex" action="produk.php">
          <div class="input-group">
            <input type="text" value="<?= $_GET['search']; ?>" name="search" placeholder="Search for..." class="form-control bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2">
            <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit" name="cari">
                <i class="fas fa-search fa-sm"></i>
              </button>
            </div>
          </div>
        </form>
        <!-- bagian icon pesan -->
        <div class="icon mt-2">
          <h5>
            <i class="fa-solid fa-cart-shopping ml-3 mr-3" data-placement="bottom" data-toggle="tooltip" title="Keranjang Belanja"></i>
            <i class=" fa-solid fa-envelope mr-3" data-toggle="tooltip" title="Surat Masuk"></i>
            <i class="fa-solid fa-bell mr-3" data-toggle="tooltip" title="Notifikasi"></i>
          </h5>
        </div>
      </div>
    </div>
  </nav>
  <!-- bagian header -->
  <div class="row mt-5 no-gutters">
    <!-- akhir navbar pinggir -->
    <!-- bagian gambar slider corousel -->
    <div class="col-md-12">

      <h4 class="text-center font-weight-bold m-4 mt-5" style="color:#888;">PRODUK KAMI</h4>
      <!-- bagian pembagian card -->
      <div class="row mx-auto justify-content-center">
        <!-- bagian card produk -->
        <?php
        if (mysqli_num_rows($produk) > 0) {
          while ($p = mysqli_fetch_array($produk)) {
        ?>
            <div class="card mr-2 ml-2 mb-3" style="width: 16rem;">
              <img src="../admin/image/<?= $p['product_image']; ?>" class="card-img-top" alt="...">
              <div class="card-body bg-light">
                <h5 class="card-title"><?= $p['product_name']; ?></h5>
                <!-- bagian bintang nilai -->
                <?php if ($p['product_pcs'] <= 38) : ?>
                  <!-- bagian bintang nilai -->
                  <i class="fas fa-star text-success"></i>
                  <i class="fas fa-star text-success"></i>
                  <i class="fas fa-star text-success"></i>
                  <i class="fas fa-star text-success"></i>
                  <i class="fas fa-star-half-alt text-success"></i>
                  <br>
                <?php endif; ?>
                <?php if ($p['product_pcs'] >= 40) : ?>
                  <!-- bagian bintang nilai -->
                  <i class="fas fa-star text-success"></i>
                  <i class="fas fa-star text-success"></i>
                  <i class="fas fa-star text-success"></i>
                  <i class="fas fa-star-half-alt text-success"></i>
                  <br>
                <?php endif; ?>
                <a href="#" class="btn btn-primary mt-2" data-target="#produk1<?= $p['product_id'] ?>" data-toggle="modal">Detail</a>
                <div href="#" class="btn btn-danger mt-2">Rp. <?= number_format($p['product_price']) ?></div>
              </div>
            </div>
          <?php } ?>

        <?php } else { ?>
          <div class="container p-3 mb-5" style="background-color:#F4F4F4;">
            <h4 class="text-center">Produk Tidak Ada</h4>
          </div>
        <?php } ?>
      </div>
      <!-- bagian modal -->
      <!-- Modal -->
      <?php
      foreach ($produk as $rows) :
      ?>
        <div class="modal fade" id="produk1<?= $rows['product_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <img src="../admin/image/<?= $rows['product_image']; ?>" alt="...">
                  </div>
                  <div class="col-md-6">
                    <table class="table table-borderless">
                      <tr>
                        <th>Nama Produk</th>
                        <td><?= $rows['product_name']; ?></td>
                      </tr>
                      <tr>
                        <th>Status</th>
                        <td><?php echo ($rows['product_status'] == 0) ? 'Tidak Aktif' : 'Aktif'; ?></td>
                      </tr>
                      <tr>
                        <th>Biaya Ongkir</th>
                        <td>Standard</td>
                      </tr>
                      <tr>
                        <th>Rating Produk</th>
                        <td>
                          <?php if ($rows['product_pcs'] < 38) : ?>
                            <!-- bagian bintang nilai -->
                            <i class="fas fa-star text-success"></i>
                            <i class="fas fa-star text-success"></i>
                            <i class="fas fa-star text-success"></i>
                            <i class="fas fa-star text-success"></i>
                            <i class="fas fa-star text-success"></i>
                          <?php endif; ?>
                          <?php if ($rows['product_pcs'] >= 40) : ?>
                            <!-- bagian bintang nilai -->
                            <i class="fas fa-star text-success"></i>
                            <i class="fas fa-star text-success"></i>
                            <i class="fas fa-star text-success"></i>
                            <i class="fas fa-star-half-alt text-success"></i>
                          <?php endif; ?>
                        </td>
                      </tr>
                      <tr>
                        <th>Stock Produks</th>
                        <td><?= $rows['product_pcs']; ?></td>
                      </tr>
                      <tr>
                        <th>Harga</th>
                        <td>Rp. <?= number_format($rows['product_price']) ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                <a href="https://api.whatsapp.com/send?phone=082338928025 &text=Hai, saya tertarik dan ingin memesan produk <?= $rows['product_name']; ?> dengan nomor produk <?= $rows['product_id']; ?>" target="_blank" class="btn btn-success" style="text-decoration:none;"><i class="fa-brands fa-whatsapp mr-1"></i>Hubungi via Whatsapps</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>

  <!-- akhir corousel -->
  <!-- bagian footer dibagi menjadi 4 menggunakan row-->
  <footer class="bg-dark text-white p-5">
    <div class="row">
      <div class="col-md-3">
        <h5>LAYANAN PELANGGAN</h5>
        <ul>
          <li>Pusat Bantuan</li>
          <li>Cara Pembelian</li>
          <li>Pengiriman</li>
          <li>Cara Pengembalian</li>
        </ul>
      </div>
      <div class="col-md-3">
        <h5>TENTANG KAMI</h5>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corrupti, rem at, exercitationem officia rerum
          provident minus repellendus nobis itaque autem architecto fuga deserunt? Quo aspernatur exercitationem omnis
          excepturi, asperiores dolorem iusto minima similique cumque deleniti dolore? Dolores quos dignissimos rerum?
        </p>
      </div>
      <div class="col-md-3">
        <h5>MITRA KERJASAMA</h5>
        <ul>
          <li>GOJEK</li>
          <li>GRAB</li>
          <li>JNE</li>
          <li>PT. POS INDONESIA</li>
          <li>NINJA EXPRES</li>
        </ul>
      </div>
      <div class="col-md-3">
        <h5>HUBUNGI KAMI</h5>
        <ul>
          <li>0823389328025</li>
          <li>amirulfahmi148@gmail.com</li>
        </ul>
      </div>
    </div>
  </footer>
  <div class="copyright text-center text-white font-weight-bold bg-warning p-3">
    <p>© 2022 - By Fahmi All Rights Reserved.</p>
  </div>
  <script src="main.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js">
  </script>
</body>

</html>