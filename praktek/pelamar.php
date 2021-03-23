<?php
require 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Data &rsaquo; Pelamar</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" type="text/css" href=" https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css  " />
    <style>
        #search-addon {
            margin-left: -40px;
            z-index: 3;
            background: transparent;
        }
    </style>

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
                        <h1>Data Pelamar</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                            <div class="breadcrumb-item">Data Pelamar</div>
                        </div>
                    </div>
                    <div class="section-body">
                        <a href="tambah.php" class="btn btn-success mb-3"><i class="fa fa-plus"></i> Tambah Pelamar</a>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="dataTables" class="table table-striped" id="table-2">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </th>
                                                        <th>No</th>
                                                        <th>Foto</th>
                                                        <th>Nama</th>
                                                        <th>Kelamin</th>
                                                        <th>Negara</th>
                                                        <th>Email</th>
                                                        <th>Skill</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1;
                                                    $sql = "SELECT id, foto, nama, kelamin, domisili, email, skill FROM orang";
                                                    $org = mysqli_query($konek, $sql);
                                                    while ($p = mysqli_fetch_assoc($org)) {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <div class="custom-checkbox custom-control">
                                                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                                                                    <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                                </div>
                                                            </td>
                                                            <td><?= $i ?></td>
                                                            <td><img class="rounded" style="width: 60px;height: 60px !important;object-fit: cover;" src="<?= $p['foto'] ?>" alt=""></td>
                                                            <td><?= $p['nama'] ?></td>
                                                            <td><?= $p['kelamin'] ?></td>
                                                            <td><?= $p['domisili'] ?></td>
                                                            <td><?= $p['email'] ?></td>
                                                            <td><?= $p['skill'] ?></td>
                                                            <td>
                                                                <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                                <a href="hapus.php?id=<?= $p['id'] ?>" class="btn btn-danger mr-1" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i></a>
                                                                <a href="detail.php?id=<?= $p['id'] ?>" class="btn btn-info">Detail</a>
                                                            </td>
                                                        </tr>

                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
    <script type="text/javascript" src="  https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js  "></script>
    <script type="text/javascript" src=" https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js  "></script>

    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>

    <!-- Custom JS -->
    <script>
        $(document).ready(function() {
            var table = $('#dataTables').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "columnDefs": [{
                    "sortable": false,
                    "targets": [0, 2, 8]
                }],

            })
            $('#searchdata').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>

    <!-- Page Specific JS File -->
    <script src="assets/js/page/modules-datatables.js"></script>
</body>

</html>