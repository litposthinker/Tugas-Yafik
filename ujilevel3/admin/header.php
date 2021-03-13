<?php
session_start();
require '../koneksi.php';
$barang = query(
    'SELECT stockbarang.id,stockbarang.nama,stockbarang.stock AS stockbarang, 
stockbarang.harga, stockbarang.gambar, SUM(orderbarang.stock) AS belistock
FROM stockbarang LEFT JOIN orderbarang ON stockbarang.id = orderbarang.barang_id
WHERE NOT IsDeleted = 1
GROUP BY stockbarang.id ORDER BY stockbarang.id DESC 
'
);
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


    <!-- font awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">

    <!-- csotom css -->
    <link rel="stylesheet" href="../css/style.css">

    <title>StarbhakPOS | Admin</title>
</head>

<body>