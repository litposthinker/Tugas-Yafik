<?php
$server       = "localhost";
$user         = "root";
$password     = "";
$database     = "uji_level";
$koneksi      = mysqli_connect($server, $user, $password, $database);

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $box = [];
    while ($barang = mysqli_fetch_assoc($result)) {
        $box[] = $barang;
    }
    return $box;
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function tambah($val)
{
    global $koneksi;
    // var_dump($_SESSION);
    foreach ($_SESSION as $key => $value) {
        $id = explode('.', $key)[1];
        $tanggal = date("y/m/d H:i:s", strtotime('+ 6 hours'));
        $getData = query("SELECT * FROM stockbarang WHERE id = $id");
        foreach ($getData as $keranjang) {
            (isset($total)) ? $total = $keranjang['harga'] * $value + $total : $total = $keranjang['harga'] * $value;
        }
    }
    $ppn = $total * 0.01;
    $discount = $total * 0.10;
    ($total > 10000000) ? $total = $total + $discount - $ppn : $total = $total - $ppn;

    $JumlahBarang = array_sum($_SESSION);
    $query = "INSERT INTO belibarang VALUES(''," . (int)$JumlahBarang . "," . (int)$total . ",'$tanggal')";
    $a = mysqli_query($koneksi, $query);

    // input order barang
    $beli_id = mysqli_insert_id($koneksi); // mendapat id baru
    foreach ($_SESSION as $key => $value) {
        $id_barang = explode('.', $key)[1];
        $order = "INSERT INTO orderbarang VALUES(''," . (int)$id_barang . "," . (int)$beli_id . "," . (int)$value . ", '$tanggal')";
        mysqli_query($koneksi, $order);
    }
    return mysqli_affected_rows($koneksi);
}

// function tambah($val)
// {
//     global $koneksi;
//     foreach ($_SESSION as $key => $value) {
//         $id = explode('.', $key)[1];
//         $tanggal = date("y/m/d H:i:s");
//         $query = "INSERT INTO belibarang VALUES(''," . (int)$id . "," . (int)$value . ",'$tanggal')";
//         var_dump(mysqli_query($koneksi, $query));
//     }
//     return mysqli_affected_rows($koneksi);
// }

// admin
function hapusAdmin($id)
{
    global $koneksi;
    $query = "UPDATE stockbarang SET IsDeleted = 1 WHERE id = '$id'";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function tambahAdmin($POST)
{
    global $koneksi;
    $nama = htmlspecialchars($POST['nama']);
    $harga = (int) explode(' ', join('', explode('.', htmlspecialchars($_POST['harga']))))[1];
    $stock = htmlspecialchars($POST['stock']);
    $gambar = htmlspecialchars($POST['gambar']);
    $query = "INSERT INTO stockbarang
                   VALUES
                  ('', '$nama', " . (int)$harga . ", '$stock', '$gambar', 0)
                  ";
    // $query = "INSERT INTO stockbarang VALUES('','$nama'," . (int)$harga . "," . (int)$stock . ",'$gambar'), 0";
    var_dump($query);
    var_dump(mysqli_query($koneksi, $query));
    return mysqli_affected_rows($koneksi);
}

function updateAdmin($POST)
{
    global $koneksi;
    $id = htmlspecialchars($POST['id']);
    $gambar = htmlspecialchars($POST['gambar']);
    $nama = htmlspecialchars($POST['nama']);
    $stock = htmlspecialchars($POST['stock']);
    $harga = (int) explode(' ', join('', explode('.', htmlspecialchars($_POST['harga']))))[1];
    $query = "UPDATE stockbarang 
                SET nama='$nama',stock='$stock',gambar='$gambar',harga='$harga'
                WHERE id = $id";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}
