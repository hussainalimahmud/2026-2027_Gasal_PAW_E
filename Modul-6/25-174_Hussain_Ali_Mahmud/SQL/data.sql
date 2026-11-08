USE toko;

INSERT INTO supplier (id, nama, telp, alamat) VALUES
(1, 'PT Sumber Pustaka Jaya', '0215551122', 'Jl. Industri Raya No. 12, Jakarta'),
(2, 'CV Alat Tulis Nusantara', '0227778899', 'Jl. Asia Afrika No. 45, Bandung');

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('P001', 'Budi', 'L', '081234567890', 'Jl. Raya Ngambon No. 10, Bojonegoro'),
('P002', 'Bagas', 'L', '082198765432', 'Jl. Sudirman No. 25, Bandung'),
('P003', 'Dinda', 'P', '085611223344', 'Jl. Diponegoro No. 5, Surabaya'),
('P004', 'Rusdi', 'L', '087855443322', 'Jl. Raya Padangan No. 12, Ngawi'),
('P005', 'Narji', 'L', '081399887766', 'Jl. Pahlawan No. 8, Semarang');

INSERT INTO barang (id, kode_barang, nama_barang, harga, stok, supplier_id) VALUES
(1, 'BRG001', 'Laptop KINGFINIX', 7000000, 30, 1),
(2, 'BRG002', 'Mouse Rantech', 85000, 50, 1),
(3, 'BRG003', 'Keyboard portek', 350000, 35, 1),
(4, 'BRG004', 'Monitor LPG', 15000000, 16, 1),
(5, 'BRG005', 'Flasdisk RNGWI', 20000, 50, 1);

INSERT INTO transaksi (id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES
(1, '2026-11-01', 'Pembelian laptop', 0, 'P001'),
(2, '2026-11-02', 'Pembelian mouse', 0, 'P002'),
(3, '2026-11-03', 'Pembelian keyboard', 0, 'P003'),
(4, '2026-11-04', 'Pembelian monitor', 0, 'P004'),
(5, '2026-11-05', 'Pembelian flashdisk', 0, 'P005'),
(6, '2026-11-06', 'Pembelian laptop dan mouse', 0, 'P001'),
(7, '2026-11-07', 'Pembelian keyboard dan flashdisk', 0, 'P002'),
(8, '2026-11-08', 'Pembelian monitor', 0, 'P003'),
(9, '2026-11-08', 'Pembelian mouse dan keyboard', 0, 'P004'),
(10, '2026-11-08', 'Pembelian laptop dan flashdisk', 0, 'P005');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 7000000, 1),
(2, 2, 85000, 2),
(3, 3, 350000, 1),
(4, 4, 15000000, 1),
(5, 5, 20000, 3),
(6, 1, 7000000, 1),
(6, 2, 85000, 1),
(7, 3, 350000, 2),
(7, 5, 20000, 2),
(8, 4, 15000000, 1),
(9, 2, 85000, 2),
(9, 3, 350000, 1),
(10, 1, 7000000, 1),
(10, 5, 20000, 5);

UPDATE transaksi SET total = (
    SELECT COALESCE(SUM(harga * qty), 0)
    FROM transaksi_detail
    WHERE transaksi_detail.transaksi_id = transaksi.id
);