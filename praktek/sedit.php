<?php
include 'koneksi.php';
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $tempat_tgl = $_POST['tempat_tgl'];
    $agama = $_POST['agama'];
    $kelamin = $_POST['kelamin'];
    $domisili = $_POST['domisili'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $skill = $_POST['skill'];
    $foto = $_POST['foto'];

    $sql = "UPDATE orang SET foto='$foto', nama ='$nama', tempat_tgl='$tempat_tgl', agama='$agama', kelamin='$kelamin', domisili='$domisili', email='$email', telepon='$telepon', skill='$skill' WHERE id ='$id'";

    $query = mysqli_query($konek, $sql);
    if ($query) {
        header('Location: pelamar.php');
    } else {
        header('Location: sedit.php?status=gagal');
    }
}
