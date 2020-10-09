<?php
include 'koneksi.php';
?>

<!doctype html>
<html lang="en">

<head>
  <title>mini.Market</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="icomoon/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <style>
    body {
      background-color: black;
    }

    .admin {}

    .navbar {
      display: flex;
      justify-content: center;
    }

    .jumbotron {
      background-color: transparent;
      height: 17cm;
      align-items: center;
    }

    .image {
      opacity: 1;
      display: block;
      width: 100%;
      height: 100%;
      transition: .5s ease;
      backface-visibility: hidden;
    }

    .middle {
      transition: .5s ease;
      opacity: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%)
    }

    .produk {
      flex: 0 0 30%;
      margin: 5px;
      margin-bottom: 20px;
    }

    .flex-row {
      display: flex;
      flex-wrap: wrap;
    }

    .produk:hover .image {
      opacity: 0.3;
    }

    .produk:hover .middle {
      opacity: 1;
    }

    .text {
      color: white;
      font-size: 16px;
    }

    .card {
      background-color: transparent;
    }

    .shop-item-image {
      opacity: 1;
      display: block;
      width: 100%;
      height: 100%;
      transition: .5s ease;
      backface-visibility: hidden;
    }

    footer {
      margin: 100px;
    }
  </style>

</head>

<body>
  <div class="admin d-flex justify-content-end">
    <a type="button" class="btn btn-light " href="admin/tampil.php" class="navbar-brand">Admin</a>
  </div>
  <nav class="navbar navbar-dark bg-inverse">
    <a href="index.php" class=" navbar-brand">mini.Market</a>
    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#cart"><span class="
      icon-shopping-cart"></span><span id="jumlah-keranjang"> Keranjang</span></button>

  </nav>
  <hr>

  <div class="jumbotron text-light text-center d-flex">
    <div class="row justify-content-center">
      <div class="col-sm-5">
        <h1 class="font-weight-bold display-4">mini.Market</h1>
        <br>
        <p class="text-center">Convenience stores usually charge significantly higher prices than conventional grocery stores or supermarkets, as these stores order smaller quantities of inventory at higher per-unit prices from wholesalers. However, convenience stores make up for this loss by having longer open hours, serving more locations, and having shorter cashier lines.</p>
      </div>
    </div>
  </div>


  <div class="container d-flex flex-row">

    <?php
    $sql = "SELECT * FROM produk";
    $brg = mysqli_query($konek, $sql);
    while ($b = mysqli_fetch_array($brg)) {

    ?>
      <div class="col-4 produk flex-column">
        <img class=" shop-item-image image rounded" src=" <?php echo $b['gambar'] ?>" alt="">
        <div class="middle">
          <div class="form-group text">
            <h3 id="nama_item1" class="shop-item-title"><?php echo $b['nama_produk'] ?></h3>
            <p>Stok: <?php echo $b['stok'] ?></p>
            <div class="input-group mt-2 mb-2 ">
              <input type="number" class="form-control text-center" value="1" autocomplete="off" id="count">
            </div>
            <p id="harga_item1" class="shop-item-price">Rp.<?php echo number_format($b['harga']) ?>,-</p>
          </div>
          <button type="button" class="btn btn-success shop-item-button" name="simpan"><span class="icon-cart-plus"></span> Tambah
            ke
            Keranjang </button>
        </div>
      </div>
    <?php
    }
    ?>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg justify-content-center" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Keranjang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-flex justify-content-center">
          <div class="container content-section">
            <div class="cart-items">
              <table class="table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th></th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM produk_beli";
                $query = mysqli_query($konek, $sql);
                $no = 1;
                while ($pel = mysqli_fetch_array($query)) {
                ?>

                  <tbody>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $pel['nama_produk'] ?></td>
                      <td><img class="img-thumbnail" width="100" height="100" src="<?php echo $pel['gambar'] ?>" alt=""></td>
                      <td>Rp.<?php echo number_format($pel['harga']) ?>,-</td>
                      <td><?php echo $pel['stok'] ?></td>

                      <td>
                        <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus.php?id=<?php echo $pel['id_produk']; ?>' }" class="btn btn-danger">Hapus</a>
                      </td>
                    </tr>

                  </tbody>
                <?php
                }
                ?>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="kodevocer" placeholder="Masukkan kode voucher" aria-label="Masukkan kode voucher">
            <div class="input-group-append">
              <button class="btn btn-info" type="button" id="kodevc" onclick="submitkode()">Submit</button>
            </div>
          </div>

          <div class="cart-total">
            <strong id="cart-diskon"></strong>
            <strong class="cart-total-title">Total</strong>
            <span class="cart-total-price"></span>
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-target="#modalbayar" data-toggle="modal" onclick="bayar()">Bayar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal bayar -->
  <div class="modal fade" id="modalbayar" tabindex="-1" aria-labelledby="modalbayar" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalbayar">Rincian Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container content-section">
            <div class="cart-items">
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="page-footer font-small blue text-light">
    <div class="footer-copyright text-center">© 2020 Copyright:
      <p>Yafik</p>
    </div>
  </footer>
  <!-- Footer -->

  <!-- Optional JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
  </script>

</body>

</html>