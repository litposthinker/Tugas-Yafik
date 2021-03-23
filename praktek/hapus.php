<?php
require 'koneksi.php';
if (isset($_GET['id'])) {
    header('Location: pelamar.php');
}
$id = $_GET['id'];


$sql = "DELETE FROM orang WHERE id = '$id'";
$query = mysqli_query($konek, $sql);

if ($query) {
    header('Location: pelamar.php');
} else {
    header('Location: hapus.php?status=gagal');
}
