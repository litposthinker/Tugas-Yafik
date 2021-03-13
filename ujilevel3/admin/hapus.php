<?php
require '../koneksi.php';
if (isset($_GET['id'])) {
    if (hapusAdmin($_GET['id']) > 0) {
        header('Location: tampil.php');
    } else {
        header('Location: hapus.php?error');
    }
}
