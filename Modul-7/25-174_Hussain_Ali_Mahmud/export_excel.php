
<?php
include "koneksi.php";

if (isset($_POST['tanggal_mulai']) && isset($_POST['tanggal_selesai'])) {

    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];

    if (empty($tanggal_mulai) || empty($tanggal_selesai)) {
        die("Tanggal mulai dan tanggal selesai tidak boleh kosong.");
    }

    if ($tanggal_mulai > $tanggal_selesai) {
        die("Tanggal mulai tidak boleh melebihi tanggal selesai.");
    }

    $query = "SELECT waktu_transaksi, SUM(total) AS total_pendapatan
              FROM transaksi
              WHERE waktu_transaksi BETWEEN ? AND ?
              GROUP BY waktu_transaksi
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

    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=rekap_penjualan.xls");

    echo "<table border='1'>";

    echo "<tr>";
    echo "<th>No</th>";
    echo "<th>Total Pendapatan</th>";
    echo "<th>Tanggal Transaksi</th>";
    echo "</tr>";

    $no = 1;

    while ($data = mysqli_fetch_assoc($hasil)) {

        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . htmlspecialchars($data['total_pendapatan']) . "</td>";
        echo "<td>" . htmlspecialchars($data['waktu_transaksi']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);

} else {
    echo "Tanggal mulai dan tanggal selesai tidak boleh kosong.";
}
?>
