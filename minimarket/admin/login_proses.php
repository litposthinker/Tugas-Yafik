<?php
$username   = $_POST['username'];
$pass       = md5($_POST['password']);

include 'koneksi.php';

$user = mysqli_query($connect,"select * from users where username='$username' and password='$pass'");
$chek = mysqli_num_rows($user);
if($chek>1)
{
    header("location:tampil.php");
}else
{
    header("location:login.php");
}
?>