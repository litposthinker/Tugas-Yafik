<?php
include 'header.php';
include 'koneksi.php';
?>

<div id="main">
    <h2>Data Produk</h2>
    <br>
    <button class="navbar-toggler" type="button">
        <span class="icon-bars" onclick="openNav()"></span>
    </button>

</div>

<div class="text-center">
    <button type="button" style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-primary col-md-2">[+] Tambah baru</button>
</div>

<div id="main" class="container-sm">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th></th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Opsi</th>
            </tr>
        </thead>

        <?php
        $sql = "SELECT * FROM produk";
        $query = mysqli_query($connect, $sql);
        $no = 1;
        while ($pel = mysqli_fetch_array($query)) {
        ?>

            <tbody>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $pel['nama_produk'] ?></td>
                    <td><img class="img-thumbnail" width="100" height="100" src="<?php echo $pel['gambar'] ?>" alt=""></td>
                    <td>Rp.<?php echo number_format($pel['harga']) ?>,-</td>
                    <td><?php echo $pel['stok'] ?></td>

                    <td>
                        <a href="det_barang.php?id=<?php echo $pel['id_produk']; ?>" class="btn btn-info">Detail</a>
                        <a href="edit.php?id=<?php echo $pel['id_produk']; ?>" class="btn btn-warning">Edit</a>
                        <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus.php?id=<?php echo $pel['id_produk']; ?>' }" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>

            </tbody>
        <?php
        }
        ?>
</div>
</table>

<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title">Tambah Produk Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="simpan.php" method="POST" class="form=group">
                    <div class="form-group">
                        <label>Nama Produk: </label>
                        <input type="text" class="form-control" name="nama">
                    </div>

                    <div class="form-group">
                        <label>Link Gambar: </label>
                        <input type="text" class="form-control" name="gambar">
                    </div>

                    <div class="form-group">
                        <label>Jenis: </label>
                        <input type="text" class="form-control" name="jenis">
                    </div>

                    <div class="form-group">
                        <label>Supplier: </label>
                        <input type="text" class="form-control" name="supplier">
                    </div>

                    <div class="form-group">
                        <label>Harga: </label>
                        <input type="number" class="form-control" name="harga">
                    </div>

                    <div class="form-group">
                        <label>Stok: </label>
                        <input type="number" class="form-control" name="stok">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-info" name="simpan" value="Simpan">
            </div>
            </form>
        </div>
    </div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>