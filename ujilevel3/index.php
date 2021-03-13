<?php
session_start();
require 'koneksi.php';
$barang = query('SELECT * FROM stockbarang');

$riwayat = query("SELECT 
GROUP_CONCAT(stockbarang.nama) AS nama, 
GROUP_CONCAT(orderbarang.stock) AS total_stock,
GROUP_CONCAT(stockbarang.harga) AS harga,
belibarang.total_harga AS total_harga,
orderbarang.created_at FROM orderbarang
INNER JOIN stockbarang ON orderbarang.barang_id = stockbarang.id
INNER JOIN belibarang ON orderbarang.belibarang_id = belibarang.id
GROUP BY created_at ORDER BY created_at DESC
");

if (isset($_POST['beli'])) {
    if (tambah($_POST) > 0) { // > 0 = berhasil
        header('Location: index.php');
        session_destroy();
    } else {
        '<script>
        console.log("barang gagal di tambahkan");
        </script>';
    }
}

date_default_timezone_set('Asia/Jakarta');
setlocale(LC_TIME, 'IND');
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.rawgit.com/mfd/09b70eb47474836f25a21660282ce0fd/raw/e06a670afcb2b861ed2ac4a1ef752d062ef6b46b/Gilroy.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="css/style.css">

    <!-- Data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.all.min.js"></script>

    <title>StarbhakPOS</title>
</head>

<body>
    <div class="container-fluid p-5 d-flex">
        <section id="keranjang">
            <div class="container m-0">
                <div class="hero">
                    <h3 class="fw-bold ">Starbhak<span class="text-warning">POS</span>
                    </h3>
                </div>
                <div class="row d-flex flex-column mt-5">
                    <h3>Cart</h3>
                    <div class="keranjang">
                        <?php
                        foreach ($_SESSION as $key => $val) {
                            $getID = explode(".", $key)[1];
                            $getData = query("SELECT * FROM stockbarang WHERE id = $getID");
                            foreach ($getData as $keranjang) {
                                if (isset($total)) {
                                    $total = $keranjang['harga'] * $val + $total;
                                } else {
                                    $total = $keranjang['harga'] * $val;
                                }
                        ?>
                                <div class="card border-light shadow-sm d-flex flex-row align-items-center mb-3" style="width: 300px; height:auto">
                                    <img style="width: 80px; height:80px;" src="<?= $keranjang['gambar'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"> <?= $keranjang['nama'] ?></h5>
                                        <p class="card-text"><?= rupiah($keranjang['harga']) ?></p>
                                        <div class="col input-group input-group-sm pe-5 mb-2" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="btn btn-light rounded" onclick="kurangBarang('<?= $key ?>')">-</button>
                                            <input class="form-control" value="<?= $val ?>"></input>
                                            <button type="button" class="btn btn-warning rounded" onclick="tambahBarang('<?= $key ?>')">+</button>
                                            <button type="button" class="btn btn-danger ms-3 rounded" onclick="hapusBarang('<?= $key ?>')"><i class="far fa-trash-alt"></i> </button>
                                        </div>
                                        <p class="card-text fw-bold"><?= rupiah($val * $keranjang['harga']) ?></p>
                                    </div>
                                </div>
                        <?php }
                        }
                        ?>
                    </div>
                    <div class="row-auto">
                        <table class="table table-borderless table-sm mt-2">
                            <tbody>
                                <tr>
                                    <td>Diskon:</td>
                                    <td id="diskon">
                                        <span style="float: right;">
                                            <?php if (isset($total) && $total > 10000000) {
                                                $discount = $total * 0.10; ?>
                                                <?= rupiah($discount) ?>
                                            <?php } else {
                                                $discount = 0; ?>
                                                Rp. 0
                                            <?php } ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PPN :</td>
                                    <td id="ppn">
                                        <span style="float: right;">
                                            <?php if (isset($total)) {
                                                $ppn = $total * 0.01; ?>
                                                <?= rupiah($ppn) ?>
                                            <?php } else { ?>
                                                Rp. 0
                                            <?php } ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total :</td>
                                    <td id="total" class="fw-bold">
                                        <span style="float: right;">
                                            <?php if (isset($total)) { ?>
                                                <?= rupiah($total - $discount + $ppn) ?>
                                            <?php } else { ?>
                                                Rp. 0
                                            <?php } ?>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light me-3 rounded" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="fas fa-history"></i> Riwayat Pembelian
                        </button>
                        <form action="" method="POST" id="bayar" onsubmit="bayarAlert()">
                            <button class="btn btn-warning rounded" name="beli" type="submit"><i class="fas fa-money-bill-wave"></i> Bayar</button>
                        </form>
                    </div>
                </div>

                <div class="akun p-3 mt-3 d-flex justify-content-center align-items-center flex-column">
                    <div>
                        <img width="50px" style="border-radius: 50%;" src="img/user.jpg" alt="">
                    </div>
                    <div class="justify-content-center">
                        <span class="fw-bold">Julia</span>
                        <p class="m-0">User</p>
                    </div>
                    <div class="col-2 btn-group dropend justify-content-center rounded">
                        <button type="button" class="btn btn-light dropdown-toggle fw-bold" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-users"></i> Ganti Akun
                        </button>
                        <ul class="dropdown-menu">
                            <a class="dropdown-item" href="admin/tampil.php">
                                <span class="fw-bold"><i class="fas fa-user-cog"></i> Yafik</span>
                                Admin</a>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="produk">
            <div class="d-flex justify-content-between">
                <h3>Products</h3>
                <div class="">
                    <input class="form-control me-2" type="text" id="search" placeholder="Cari Produk" aria-label="Search">
                </div>
            </div>
            <div class="row-auto mt-5 d-flex flex-wrap">
                <?php foreach ($barang as $brg) { ?>
                    <?php { ?>
                        <div class="col-sm-3 produk p-3 me-5 mb-5">
                            <img class="image" style="width: 200px;" src="<?= $brg['gambar'] ?>" alt="">
                            <div class="middle text-center">
                                <h4 class="fw-bold"><?= $brg['nama'] ?></h4>
                                <p class="fw-light <?= ($brg['stock'] < 1) ? 'text-danger fw-bold' : '' ?>">Tersisa: <?= $brg['stock'] ?></p>
                                <h5 class="text-warning "><?= rupiah($brg['harga']) ?></h5>
                                <button class="btn btn-warning mt-2" <?= ($brg['stock'] < 1) ? 'disabled' : '' ?> id="val.<?= $brg['id'] ?>" onclick="tambahBarang(this.id)"><i class="fas fa-cart-plus"></i> Beli</button>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Riwayat Pembelian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless table-hover">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Jumlah Harga</th>
                                    <th>Waktu Pembelian</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($riwayat as $key => $rwt) { ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $rwt['nama'] ?></td>
                                        <td><?= $rwt['total_stock'] ?></td>
                                        <td>
                                            <?php $ex = explode(',', $rwt['harga']);
                                            $rupiah = [];
                                            foreach ($ex as $key => $value) {
                                                $rupiah[] = rupiah((int)$value);
                                            }
                                            echo join(',', $rupiah);
                                            ?>
                                        </td>
                                        <td><?= rupiah($rwt['total_harga']) ?></td>
                                        <td><?= strftime('%e %B %G, %H:%M', strtotime($rwt['created_at'])) ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Optional JavaScript; choose one of the two! -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
        <script src="js/js.js"></script>

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>