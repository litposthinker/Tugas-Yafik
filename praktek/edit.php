<?php
require 'koneksi.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM orang WHERE id='$id'";
    $query = mysqli_query($konek, $sql);
    $p = mysqli_fetch_assoc($query);

    if (mysqli_num_rows($query) < 1) {
        die("data tidak ditemukan");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Edit Pelamar &rsaquo; litUI</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->



    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, Yakikufukika</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="features-profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="features-settings.html" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">LIT.UI</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">LUI</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="nav-item dropdown">
                            <a href="index.php" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                        </li>
                        <li class="menu-header">Data</li>
                        <li class="nav-item dropdown active">
                            <a href="pelamar.php" class="nav-link" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Pelamar</span></a>
                        </li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Edit Data Pelamar</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item"><a href="index.php">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="pelamar.php">Data Pelamar</a></div>
                            <div class="breadcrumb-item active">Edit Data Pelamar</div>
                        </div>
                    </div>
                    <div class="section-body">
                        <a href="pelamar.php" class="btn btn-light mb-3"><i class="fa fa-caret-left"></i> Kembali</a>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="sedit.php" method="POST">
                                            <input type="hidden" class="form-control" name="id" placeholder="Nama" value="<?= $p['id'] ?>">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Nama</label>
                                                    <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?= $p['nama'] ?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Tempat, Tgl Lahir</label>
                                                    <input type="text" class="form-control" name="tempat_tgl" placeholder="Tempat dan Tanggal Lahir" value="<?= $p['tempat_tgl'] ?>">
                                                </div>
                                            </div>
                                            <div class=" form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputAddress">Agama</label>
                                                    <input type="text" class="form-control" name="agama" placeholder="Agama" value="<?= $p['agama'] ?>">
                                                </div>
                                                <div class=" form-group col-md-2">
                                                    <label for="inputState">Jenis Kelamin</label>
                                                    <select class="form-control" name="kelamin">
                                                        <option value="<?= $p['kelamin'] ?>"><?= $p['kelamin'] ?></option>
                                                        <option value="Laki -laki">Laki -laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputCity">Domisili</label>
                                                    <input type="text" class="form-control" name="domisili" placeholder="Domisili" value="<?= $p['domisili'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-2">
                                                    <label for="inputZip">E-mail</label>
                                                    <input type="text" class="form-control" name="email" placeholder="Email" value="<?= $p['email'] ?>">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputZip">Telepon</label>
                                                    <input type="text" class="form-control" name="telepon" placeholder="No. Telepon" value="<?= $p['telepon'] ?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Skill</label>
                                                    <input type="text" class="form-control" name="skill" value="<?= $p['skill'] ?>"></input>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputZip">URL Foto Profile</label>
                                                <input type="text" name="foto" class="form-control" placeholder="Link URL Gambar" value="<?= $p['foto'] ?>">
                                            </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end">
                                        <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2021 <div class="bullet"></div> Design By <a href="#">Yafik Ramadhan</a>
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>

    <!-- Custom JS -->

    <!-- Page Specific JS File -->
</body>

</html>