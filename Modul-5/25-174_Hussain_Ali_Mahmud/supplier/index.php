
<?php


include '../config/koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM supplier");


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Master Supplier</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

<div class="container">

    <h2>Data Master Supplier</h2>

    <div class="tombol-atas">
        <a href="tambah.php" class="btn-tambah">Tambah Data</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Tindakan</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $no = 1;
            while ($data = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($data['nama']); ?></td>
                <td><?= htmlspecialchars($data['telp']); ?></td>
                <td><?= htmlspecialchars($data['alamat']); ?></td>
                <td>
                    <a href="edit.php?id=<?= $data['id']; ?>" class="btn-edit">Edit</a>
                    <a href="hapus.php?id=<?= $data['id']; ?>"class="btn-hapus"onclick="return confirm('Anda yakin akan menghapus supplier ini?')">
                    Hapus
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

</body>
</html>
