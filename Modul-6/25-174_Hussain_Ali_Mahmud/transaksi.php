
<?php
include "koneksi/koneksi.php";

$id = $_GET['id'] ?? '';

if (isset($_POST['lanjut'])) {

    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $pelanggan = $_POST['pelanggan'];

    if ($id == '') {

        mysqli_query($koneksi, "INSERT INTO transaksi
                (waktu_transaksi, keterangan, total, pelanggan_id)
            VALUES ('$tanggal', '$keterangan', 0, '$pelanggan')");

        $id = mysqli_insert_id($koneksi);

    } else {

        mysqli_query($koneksi, "UPDATE transaksi SET
            waktu_transaksi = '$tanggal',
            keterangan = '$keterangan',
            pelanggan_id = '$pelanggan'
            WHERE id = '$id'
        ");

    }

    header("Location: transaksi-detail.php?id=$id");
    exit;
}

$data = [
    'waktu_transaksi' => date('Y-m-d'),
    'keterangan' => '',
    'pelanggan_id' => ''
];

if ($id != '') {
    $hasil = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id='$id'");
    $data = mysqli_fetch_assoc($hasil);

    if (!$data) {
        die("Transaksi tidak ditemukan");
    }
}

$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Transaksi</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

<div class="container">

    <h2>Input Transaksi</h2>

    <form method="POST">

        <label>Pelanggan</label>
        <select name="pelanggan" required>
            <option value="">Pilih Pelanggan</option>

            <?php while ($p = mysqli_fetch_assoc($pelanggan)) { ?>
                <option value="<?= $p['id']; ?>"
                    <?= $data['pelanggan_id'] == $p['id'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($p['nama']); ?>
                </option>
            <?php } ?>

        </select>

        <label>Tanggal Transaksi</label>
        <input type="date" name="tanggal"
               value="<?= $data['waktu_transaksi']; ?>" required>

        <label>Keterangan</label>
        <textarea name="keterangan"><?= htmlspecialchars($data['keterangan'] ?? ''); ?></textarea>

        <br><br>

        <button type="submit" name="lanjut" class="btn">
            Lanjut
        </button>

        <a href="index.php" class="btn btn-red">Batal</a>

    </form>

</div>

</body>
</html>
