    <?php
    include 'koneksi.php';
    if (isset($_POST['simpan'])) {
        $nama = $_POST['nama'];
        $gambar = $_POST['gambar'];
        $jenis = $_POST['jenis'];
        $harga = $_POST['harga'];
        $supply = $_POST['supplier'];
        $stok = $_POST['stok'];

        $sql = "INSERT INTO produk (nama_produk, gambar, jenis, harga, supplier, stok) VALUES ('$nama','$gambar', '$jenis', '$harga', '$supply', '$stok')";
        $query = mysqli_query($connect, $sql);

        if ($query) {
            header('Location: tampil.php');
        } else {
            header('Location: simpan.php?status=gagal');
        }
    }
    ?>