<?php


include '../config/koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM supplier WHERE id='$id'");

if ($query) {
    header("Location: index.php");
    exit;
}




?>