<?php
require 'header.php';
?>

<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container">
        <a class="navbar-brand mb-0 h1 mx-5 text-white fs-4 fw-bold" href="tampil.php">Starbhak<span class="text-warning">POS</span></a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto me-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item fw-bold" href="../index.php"><i class="fas fa-user-tag text-info"></i> Julia <span class="fw-normal">User</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row header mt-4 d-flex justify-content-between">
                <div class="col-md-2 text-center">
                    <h3>Data Produk</h3>
                </div>
                <div class="col-auto d-flex flex-row">
                    <div class="input-group flex-nowrap search me-3">
                        <input type="text" class="form-control h-100 filter" placeholder="Cari Produk" id="filter" data-id="3" aria-label="Recipient's username" aria-describedby="button-addon2" autocomplete="off">
                    </div>
                    <div class="col-auto">
                        <a href="tambah.php" type="button" class="btn btn-warning  text-decoration-none text-center fw-bold"><i class="fas fa-plus-circle"></i> Tambah Barang</a>
                    </div>
                </div>
            </div>
            <div class="container-fluid  mb-5  mt-2">
                <div class="row">
                    <table id="table_id" class="table table-hover table-borderless">
                        <thead class="text-center table-dark">
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Barang</th>
                                <th>Stock</th>
                                <th>Terjual</th>
                                <th>Harga</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php foreach ($barang as $key => $brg) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><img src="<?= $brg['gambar'] ?>" style="width:100px" alt=""></td>
                                    <td><?= $brg['nama'] ?></td>
                                    <td><?= $brg['stockbarang'] ?></td>
                                    <td>
                                        <?php if ($brg['belistock'] > 1) { ?>
                                            <?= $brg['belistock'] ?>
                                        <?php } else { ?>
                                            0
                                        <?php } ?>
                                    </td>
                                    <td><?= rupiah($brg['harga']) ?></td>
                                    <td>
                                        <a href="update.php?id=<?= $brg['id'] ?>" type="button" onclick="hapusAlert()" class="btn btn-warning btn-md"><i class="far fa-edit"></i></i></a>
                                        <button onclick="confirmDelet(<?= $brg['id'] ?>)" class="btn btn-danger hapus btn-md"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Optional JavaScript; choose one of the two! -->
<script script src=" https://cdn.jsdelivr.net/npm/sweetalert2@10 "></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
<script src="/js/js.js"></script>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        var table = $('#table_id').DataTable({
            "dom": 't<"bottom"<"row"<"col-6"i><"col-6"p>>>',
        });

        $('#filter').keyup(function() {
            table
                .column(2)
                .search(this.value)
                .draw();
        })
        $('.dataTables_empty').html('Barang masih kosong');
    });

    function confirmDelet(id) {
        Swal.fire({
            title: 'Apa anda yakin ingin menghapus?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                window.location = "hapus.php?id=" + id;
                Swal.fire(
                    'Success',
                    'Data anda berhasil di hapus.',
                    'success'
                )
            } else if (result.dismiss === Swal.DismissReason.cancel) {}
        })
    }
</script>
</body>

</html>