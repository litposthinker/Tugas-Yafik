<?php

include 'koneksi.php';
$tgl = $_POST['tgl'];
$nama = $_POST['nama'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];

$dt = mysqli_query("select * from barang where nama='$nama'");
$data = mysqli_fetch_array($dt);
$sisa = $data['jumlah'] - $jumlah;
mysqli_query("update barang set jumlah='$sisa' where nama='$nama'");

$modal = $data['modal'];
$laba = $harga - $modal;
$labaa = $laba * $jumlah;
$total_harga = $harga * $jumlah;
mysqli_query("insert into barang_laku values('','$tgl','$nama','$jumlah','$harga','$total_harga','$labaa')") or die(mysql_error());
header("location:barang_laku.php");
