
<?php
include "koneksi/koneksi.php";

$barang = mysqli_query($koneksi, "SELECT * FROM barang");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

<div class="container">

    <h2>Data Barang</h2>

    <a href="index.php" class="btn btn-green">Kembali</a>

    <br><br>

    <?php if (isset($_GET['pesan'])) { ?>

        <?php if ($_GET['pesan'] == 'gagal') { ?>
            <p class="pesan gagal">
                Barang tidak bisa dihapus karena masih digunakan pada transaksi!
            </p>
        <?php } ?>

        <?php if ($_GET['pesan'] == 'berhasil') { ?>
            <p class="pesan berhasil">
                Barang berhasil dihapus!
            </p>
        <?php } ?>

    <?php } ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php while ($b = mysqli_fetch_assoc($barang)) { ?>
        <tr>
            <td><?= $b['id']; ?></td>
            <td><?= htmlspecialchars($b['kode_barang']); ?></td>
            <td><?= htmlspecialchars($b['nama_barang']); ?></td>
            <td>Rp <?= number_format($b['harga'], 0, ',', '.'); ?></td>
            <td><?= $b['stok']; ?></td>
            <td>
                <a href="hapus-barang.php?id=<?= $b['id']; ?>"
                   class="btn btn-red"
                   onclick="return confirm('Yakin ingin menghapus barang ini?')">
                    Hapus
                </a>
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>
