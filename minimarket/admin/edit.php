<?php
include 'koneksi.php';
// include 'tampil.php';
$id_pro = $_GET['id'];
$sql = "SELECT * FROM produk WHERE id_produk='$id_pro'";
$query = mysqli_query($connect, $sql);
$pel = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) < 1) {
    die("data tidak ditemukan");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <h3 class="text-center">Form Edit Produk</h3>
    <form action="sedit.php" class="form-group text-center" method="post">
        <input type="hidden" name="id_produk" value="<?php echo $pel['id_produk'] ?>">
        <p>
            <label>Nama Produk : <input type="text" class="form-control" name="nama_produk" value="<?php echo $pel['nama_produk'] ?>"></label>
        </p>
        <p>
            <label>Harga : <input type="text" class="form-control" name="harga" value="<?php echo $pel['harga'] ?>"></label>
        </p>
        <p>

        </p>
        <p>
            <label>Stok : <input type="text" class="form-control" name="stok" value="<?php echo $pel['stok'] ?>"></label>
        </p>
        <input type="submit" class="btn btn-success" name="simpan" value="Simpan">
    </form>
</body>

</html>