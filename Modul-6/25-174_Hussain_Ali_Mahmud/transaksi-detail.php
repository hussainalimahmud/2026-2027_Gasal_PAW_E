
<?php
include "koneksi/koneksi.php";

$id = (int) ($_GET['id'] ?? 0);

$transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id = $id");

if (mysqli_num_rows($transaksi) == 0) {
    die("Transaksi tidak ditemukan");
}

if (isset($_POST['tambah'])) {

    $barang = (int) $_POST['barang'];
    $qty = (int) $_POST['qty'];

    if ($qty > 0) {

        $cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail
            WHERE transaksi_id = $id
            AND barang_id = $barang");

        if (mysqli_num_rows($cek) > 0) {

            echo "<script>alert('Barang sudah dimasukkan!');</script>";

        } else {

            $b = mysqli_query($koneksi, "SELECT harga FROM barang WHERE id = $barang");

            $data_barang = mysqli_fetch_assoc($b);

            if ($data_barang) {

                $harga = (int) $data_barang['harga'];

                mysqli_query($koneksi, "INSERT INTO transaksi_detail
                        (transaksi_id, barang_id, harga, qty)
                    VALUES ($id, $barang, $harga, $qty)");

                mysqli_query($koneksi, "UPDATE transaksi SET total = 
                        (SELECT COALESCE(SUM(harga * qty), 0)FROM transaksi_detail WHERE transaksi_id = $id)
                    WHERE id = $id");

                header("Location: transaksi-detail.php?id=$id");
                exit;
            }
        }

    } else {
        echo "<script>alert('Qty harus lebih dari 0!');</script>";
    }
}

$barang = mysqli_query($koneksi, "SELECT * FROM barang WHERE id NOT IN 
    (SELECT barang_id FROM transaksi_detail WHERE transaksi_id = $id)");

$detail = mysqli_query($koneksi, "SELECT transaksi_detail.*, barang.nama_barang FROM transaksi_detail 
    JOIN barang ON transaksi_detail.barang_id = barang.id 
    WHERE transaksi_id = $id");

$total = mysqli_query($koneksi, "SELECT total FROM transaksi WHERE id = $id");

$data_total = mysqli_fetch_assoc($total);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

<div class="container">

    <h2>Detail Transaksi #<?= $id; ?></h2>

    <h3>Tambah Barang</h3>

    <form method="POST">

        <label>Pilih Barang</label>

        <select name="barang" required>
            <option value="">Pilih Barang</option>

            <?php while ($b = mysqli_fetch_assoc($barang)) { ?>
                <option value="<?= $b['id']; ?>">
                    <?= htmlspecialchars($b['nama_barang']); ?>
                    - Rp <?= number_format($b['harga'], 0, ',', '.'); ?>
                </option>
            <?php } ?>

        </select>

        <label>Jumlah (Qty)</label>
        <input type="number" name="qty" min="1" required>

        <br><br>

        <button type="submit" name="tambah" class="btn">
            Tambah Barang
        </button>

    </form>

    <h3>Daftar Detail Barang</h3>

    <table>
        <tr>
            <th>Barang</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>

        <?php while ($d = mysqli_fetch_assoc($detail)) { ?>
        <tr>
            <td><?= htmlspecialchars($d['nama_barang']); ?></td>
            <td>Rp <?= number_format($d['harga'], 0, ',', '.'); ?></td>
            <td><?= $d['qty']; ?></td>
            <td>Rp <?= number_format($d['harga'] * $d['qty'], 0, ',', '.'); ?></td>
        </tr>
        <?php } ?>

    </table>

    <h3>
        Total Transaksi:
        Rp <?= number_format($data_total['total'], 0, ',', '.'); ?>
    </h3>

    <div class="menu">
        <a href="transaksi.php?id=<?= $id; ?>" class="btn btn-green">
            Kembali
        </a>

        <a href="index.php" class="btn">
            Selesai
        </a>
    </div>

</div>

</body>
</html>
