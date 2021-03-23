    <?php
    require 'koneksi.php';
    if (isset($_POST['simpan'])) {
        $nama = $_POST['nama'];
        $tempat_tgl = $_POST['tempat_tgl'];
        $agama = $_POST['agama'];
        $kelamin = $_POST['kelamin'];
        $domisili = $_POST['domisili'];
        $email = $_POST['email'];
        $telepon = $_POST['telepon'];
        $skill = $_POST['skill'];
        $foto = $_POST['foto'];

        $sql = "INSERT INTO orang (`foto`, `nama`, `tempat_tgl`, `agama`, `kelamin`, `domisili`, `email`, `telepon`, `skill`) VALUES ('$foto', '$nama', '$tempat_tgl', '$agama', '$kelamin', '$domisili', '$email', '$telepon', '$skill');";
        $query = mysqli_query($konek, $sql);

        if ($query) {
            header('Location: pelamar.php');
        } else {
            header('Location: simpan.php?status=gagal');
        }
    }
    ?>