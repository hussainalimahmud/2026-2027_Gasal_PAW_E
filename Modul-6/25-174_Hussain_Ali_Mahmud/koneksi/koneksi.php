
<?php
$host = "localhost";
$username = "root";
$password = "";
$nama_database = "toko";

$koneksi = mysqli_connect($host, $username, $password, $nama_database);

if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
