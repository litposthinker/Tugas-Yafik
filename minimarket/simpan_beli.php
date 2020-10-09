    <?php
    include 'koneksi.php';
    if (isset($_POST['simpan'])) {
        $id_pro = $_POST['id_pro'];
        $nama = $_POST['nama'];
        $jenis = $_POST['jenis'];
        $harga = $_POST['harga'];
        $img = $_POST['image'];
        $stok = $_POST['stok'];

        $sql = "INSERT INTO produk (id_produk, nama_produk, jenis, harga, stok, image) VALUES ('$id_pro','$nama', '$jenis', '$harga','$img','$stok')";
        $query = mysqli_query($connect, $sql);

        if ($query) {
            header('Location: index.php');
        } else {
            header('Location: index.php?status=gagal');
        }
    }
    ?>