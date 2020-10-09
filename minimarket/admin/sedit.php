<?php
include 'koneksi.php';
if (isset($_POST['simpan'])) {
    $id_pro = $_POST['id_produk'];
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $satuan = $_POST['satuan'];
    $stok = $_POST['stok'];
    
    $sql = "UPDATE produk SET nama_produk ='$nama', harga='$harga', satuan='$satuan', stok='$stok' WHERE id_produk ='$id_pro'";
    
    $query = mysqli_query($connect, $sql);
    if($query){
        header('Location: tampil.php');
    }else{
        header('Location: sedit.php?status=gagal');
    }
}
?>