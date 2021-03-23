<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "praktek";
$konek = mysqli_connect($host, $user, $password, $database) or die("Gagal menghubungkan");
mysqli_select_db($konek, $database) or die("Database tidak bisa dibuka");
