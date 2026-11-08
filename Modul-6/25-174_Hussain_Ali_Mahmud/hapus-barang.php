
<?php
include "koneksi/koneksi.php";

$id = (int) ($_GET['id'] ?? 0);

$cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE barang_id = $id");

if (mysqli_num_rows($cek) > 0) {

    header("Location: barang.php?pesan=gagal");

} else {

    mysqli_query($koneksi, "DELETE FROM barang WHERE id = $id");

    header("Location: barang.php?pesan=berhasil");

}

exit;
?>
