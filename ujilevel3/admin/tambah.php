<?php
session_start();
require '../koneksi.php';

if (isset($_POST['submit'])) {
    if (tambahAdmin($_POST) > 0) {
        header('Location: tampil.php');
    }
}
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


    <!-- custom css -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">

    <title>StarbhakPOS | Admin</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container">
            <a class="navbar-brand mb-0 h1 mx-5 text-white fs-4 fw-bold" href="tampil.php">Starbhak<span class="text-warning">POS</span></a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto me-5">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item fw-bold" href="../index.php"><i class="fas fa-user-tag text-info"></i> Julia <span class="fw-normal">User</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <!-- tampilan kanan -->
            <div class="col-md-12">
                <!-- header -->
                <div class="row header m-0 p-0">
                    <div class="col-md-10 warnaBorder mt-2">
                        <div class="mt-3 mb-3 ">
                            <h3>Admin | Tambah Barang</h3>
                        </div>
                        <a href="tampil.php" class="btn btn-light mb-3 me-3"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
                    </div>
                </div>
                <!-- end header -->
            </div>
            <div class="col-md-6 p-3 bayangan tambahTable mt-2 ms-3">
                <form action="" method="POST">
                    <div class="row">
                        <div class="row input-group mt-4 mb-2">
                            <label for="" class="form-label col-md-3">Link gambar:</label>
                            <input class="form-control" type="text" name="gambar" class="col-md-9" autocomplete="off" placeholder="Masukkan URL Gambar">
                        </div>
                        <div class="row  input-group mt-2 mb-2">
                            <label for="" class="form-label col-md-3">Nama Produk:</label>
                            <input class="form-control" type="text" name="nama" class="col-md-9" autocomplete="off" placeholder="Masukkan Nama Produk">
                        </div>
                        <div class="row input-group mt-2 mb-2">
                            <label for="" class="form-label col-md-3">Stock:</label>
                            <input class="form-control" type="number" value="1" min="1" name="stock" class="col-md-9" autocomplete="off" placeholder="Masukkan Stok">
                        </div>
                        <div class="row input-group mt-2 mb-4">
                            <label for="" class="form-label col-md-3">Harga:</label>
                            <input class="form-control" type="text" name="harga" class="col-md-9" id="hargaproduk" autocomplete="off" placeholder="Masukkan Harga Produk">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-warning mb-2 me-3" type="submit" name="submit"><i class="fas fa-plus-circle"></i> Tambah</button>
                    </div>
                </form>
            </div>
            <!--  -->
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script>
        var rupiah = document.getElementById("hargaproduk");
        rupiah.addEventListener("keyup", function(e) {
            rupiah.value = formatDollar(this.value, "Rp ");
        });

        /* Fungsi formatRupiah */
        function formatDollar(angka, prefix = "Rp ") {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                if (sisa) {
                    separator = "."
                } else {
                    separator = ""
                }
                rupiah += separator + ribuan.join(".");
            }

            if (split[1] != undefined) {
                rupiah = rupiah + "," + split[1]
            }

            if (prefix == undefined) {
                prefix = rupiah
            } else if (rupiah) {
                prefix = "Rp. " + rupiah
            } else {
                prefix = ""
            }
            return prefix
        }
    </script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>