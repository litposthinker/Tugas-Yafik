<?php
include 'koneksi.php';
if (isset($_GET['id'])) {
    header('Location: tampil_t.php');
}
$id = $_GET['id'];

$sql = "DELETE FROM produk_laku WHERE id ='$id'";

$query = mysqli_query($connect, $sql);

if ($query) {
    header('Location: tampil_t.php');
} else {
    header('Location: hapus.php?status=gagal');
}
