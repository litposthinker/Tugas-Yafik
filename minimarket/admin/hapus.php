<?php
include 'koneksi.php';
if (isset($_GET['id'])) {
    header('Location: tampil.php');
}
    $id_pro = $_GET['id'];
    
    $sql = "DELETE FROM produk WHERE id_produk ='$id_pro'";
    
    $query = mysqli_query($connect, $sql);
    
    if($query){
        header('Location: tampil.php');
    }else{
        header('Location: hapus.php?status=gagal');
    }
