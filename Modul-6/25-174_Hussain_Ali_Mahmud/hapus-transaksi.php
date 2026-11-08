
<?php
include "koneksi/koneksi.php";

$id = (int) ($_GET['id'] ?? 0);

mysqli_query($koneksi, "DELETE FROM transaksi_detail WHERE transaksi_id = $id");

mysqli_query($koneksi, "DELETE FROM transaksi WHERE id = $id");

header("Location: index.php");
exit;
?>
