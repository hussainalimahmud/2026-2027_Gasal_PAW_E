<?php
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
    $id = $_GET['id'];
    $nama = trim($_POST['nama']);
    $telp = trim($_POST['telp']);
    $alamat = trim($_POST['alamat']);

    $query = mysqli_query($koneksi, "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'");

    if ($query) {
        header("Location: index.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Supplier</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

<div class="container">

    <h2>Edit Data Master Supplier</h2>

    <form method="POST">

        <label>Nama</label>
        <input type="text" name="nama" placeholder="Nama" required>
        <br>

        <label>Telp</label>
        <input type="text" name="telp" placeholder="Telp" required>
        <br>

        <label>Alamat</label>
        <input type="text" name="alamat" placeholder="Alamat" required>
        <br>

        <div class="tombol-form">
            <button type="submit" name="simpan" class="btn-simpan">
                Simpan
            </button>

            <a href="index.php" class="btn-batal">Batal</a>
        </div>

    </form>


</div>

</body>
</html>