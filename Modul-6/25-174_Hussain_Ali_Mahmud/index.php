
<?php
include "koneksi/koneksi.php";

$query = mysqli_query($koneksi, "SELECT transaksi.*, pelanggan.nama FROM transaksi
    LEFT JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
    ORDER BY transaksi.id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

<div class="container">

    <h2>Data Transaksi</h2>

    <div class="menu">
        <a href="transaksi.php" class="btn">+ Tambah Transaksi</a>
        <a href="barang.php" class="btn btn-green">Cek Barang</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Keterangan</th>
            <th>Total</th>
            <th>Detail</th>
            <th>Aksi</th>
        </tr>

        <?php while ($data = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?= $data['id']; ?></td>
            <td><?= $data['waktu_transaksi']; ?></td>
            <td><?= htmlspecialchars($data['nama'] ?? '-'); ?></td>
            <td><?= htmlspecialchars($data['keterangan'] ?? '-'); ?></td>
            <td>Rp <?= number_format($data['total'], 0, ',', '.'); ?></td>
            <td>
                <a href="transaksi-detail.php?id=<?= $data['id']; ?>" class="btn">
                    Lihat
                </a>
            </td>
            <td>
                <a href="hapus-transaksi.php?id=<?= $data['id']; ?>"
                    class="btn btn-red"
                    onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                    Hapus
                </a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>
