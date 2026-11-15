
<?php
include "koneksi.php";

$data_transaksi = [];
$data_grafik = [];
$rekap_harian = [];
$labels = [];
$values = [];
$jumlah_pelanggan = 0;
$total_pendapatan = 0;
$pesan = "";
$tanggal_mulai = "";
$tanggal_selesai = "";

if (isset($_POST['tampilkan'])) {

    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];

    if (empty($tanggal_mulai) || empty($tanggal_selesai)) {
        $pesan = "Tanggal mulai dan tanggal selesai harus diisi.";

    } elseif ($tanggal_mulai > $tanggal_selesai) {
        $pesan = "Tanggal mulai tidak boleh melebihi tanggal selesai.";

    } else {

        $query = "SELECT * FROM transaksi
                  WHERE waktu_transaksi BETWEEN ? AND ?
                  ORDER BY waktu_transaksi ASC";

        $stmt = mysqli_prepare($koneksi, $query);

        mysqli_stmt_bind_param(
            $stmt,
            "ss",
            $tanggal_mulai,
            $tanggal_selesai
        );

        mysqli_stmt_execute($stmt);
        $hasil = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($hasil)) {
            $data_transaksi[] = $row;
        }

        mysqli_stmt_close($stmt);

        if (count($data_transaksi) == 0) {
            $pesan = "Tidak ada transaksi pada rentang tanggal tersebut.";
        }

        foreach ($data_transaksi as $data) {

            $tanggal = $data['waktu_transaksi'];

            if (!isset($data_grafik[$tanggal])) {
                $data_grafik[$tanggal] = 0;
            }

            $data_grafik[$tanggal] += $data['total'];
            $total_pendapatan += $data['total'];
        }

        $labels = array_keys($data_grafik);
        $values = array_values($data_grafik);

        $rekap_harian = $data_grafik;

        $query_pelanggan = "SELECT COUNT(DISTINCT pelanggan_id) AS jumlah
                            FROM transaksi
                            WHERE waktu_transaksi BETWEEN ? AND ?";

        $stmt_pelanggan = mysqli_prepare($koneksi, $query_pelanggan);

        mysqli_stmt_bind_param(
            $stmt_pelanggan,
            "ss",
            $tanggal_mulai,
            $tanggal_selesai
        );

        mysqli_stmt_execute($stmt_pelanggan);

        $hasil_pelanggan = mysqli_stmt_get_result($stmt_pelanggan);
        $row_pelanggan = mysqli_fetch_assoc($hasil_pelanggan);
        $jumlah_pelanggan = $row_pelanggan['jumlah'];

        mysqli_stmt_close($stmt_pelanggan);
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="container">

    <h2>Laporan Penjualan</h2>
    <form method="POST">

        <label>Tanggal Mulai:</label>
        <input type="date" name="tanggal_mulai" value="<?php echo htmlspecialchars($tanggal_mulai); ?>" required>

        <label>Tanggal Selesai:</label>
        <input type="date" name="tanggal_selesai" value="<?php echo htmlspecialchars($tanggal_selesai); ?>" required>

        <button type="submit" name="tampilkan">Tampilkan</button>

    </form>


    <?php if (isset($_POST['tampilkan']) && count($data_transaksi) > 0) { ?>
        <div class="no-print">

            <button type="button" onclick="window.print()">Cetak</button>
            <form method="POST" action="export_excel.php">

                <input type="hidden" name="tanggal_mulai" value="<?php echo htmlspecialchars($tanggal_mulai); ?>">

                <input type="hidden" name="tanggal_selesai" value="<?php echo htmlspecialchars($tanggal_selesai); ?>">

                <button type="submit">Ekspor Excel</button>

            </form>
        </div>
    <?php } ?>


    <?php if ($pesan != "") { ?>

        <p class="pesan">
        <?php echo htmlspecialchars($pesan); ?>
        </p>

    <?php } ?>


    <?php if (isset($_POST['tampilkan']) && count($data_transaksi) > 0) { ?>

    
        <h3>Grafik Penjualan Harian</h3>
        <canvas id="grafikPenjualan"></canvas>

        <script>

            const labels = <?php echo json_encode($labels); ?>;
            const values = <?php echo json_encode($values); ?>;
            const ctx = document.getElementById('grafikPenjualan');

            new Chart(ctx, {
                type: 'bar',

                data: {
                    labels: labels,

                    datasets: [{
                        label: 'Total Pendapatan',
                        data: values,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgb(54, 162, 235)',
                        borderWidth: 1
                    }]
                },

                options: {
                    responsive: true,

                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Total Pendapatan (Rp)'
                            }
                        },

                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal Transaksi'
                            }
                        }
                    }
                }
            });

        </script>

        <h3>Rekapitulasi Penjualan Harian</h3>
        <table>
            <tr>
                <th>No</th>
                <th>Total Pendapatan</th>
                <th>Tanggal Transaksi</th>
            </tr>

            <?php
            $no = 1;
            foreach ($rekap_harian as $tanggal => $total) {
            ?>

            <tr>
                <td><?php echo $no++; ?></td>
                <td>
                    Rp <?php echo number_format($total, 0, ',', '.'); ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($tanggal); ?>
                </td>
            </tr>
            <?php } ?>
        </table>


        <h3>Ringkasan Penjualan</h3>
        <div class="card-container">

            <div class="card">
                <h4>Jumlah Pelanggan Unik</h4>
                <p>
                <?php echo $jumlah_pelanggan; ?> Pelanggan
                </p>
            </div>

            <div class="card">
            <h4>Total Pendapatan Keseluruhan</h4>
            <p>
                Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?>
            </p>
            </div>

        </div>


        <div class="no-print">
        <h3>Data Transaksi Penjualan</h3>

        <p>
            Periode:
        <?php echo htmlspecialchars($tanggal_mulai); ?>
            sampai
        <?php echo htmlspecialchars($tanggal_selesai); ?>
        </p>

        <table>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>ID Pelanggan</th>
            </tr>

            <?php
            $no = 1;
            foreach ($data_transaksi as $data) {
            ?>

            <tr>
                <td><?php echo $no++; ?></td>
                <td>
                    <?php echo htmlspecialchars($data['id']); ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($data['waktu_transaksi']); ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($data['keterangan']); ?>
                </td>
                <td>
                    Rp <?php echo number_format($data['total'], 0, ',', '.'); ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($data['pelanggan_id']); ?>
                </td>
            </tr>

            <?php } ?>
        </table>
        </div>

    <?php } ?>

</div>

</body>
</html>
