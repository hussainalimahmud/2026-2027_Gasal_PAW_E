USE penjualann;

INSERT INTO supplier (id, nama, telp, alamat) VALUES
(1, 'PT Sumber Makmur', '081234567801', 'Bandung'),
(2, 'CV Berkah Jaya', '081234567802', 'Surayabaya'),
(3, 'PT Mitra Sejahtera', '081234567803', 'Gresik'),
(4, 'CV Cahaya Abadi', '081234567804', 'Magelang'),
(5, 'PT Indo Supply', '081234567805', 'Lamongan');

INSERT INTO barang (id, kode_barang, nama_barang, harga, stok, supplier_id) VALUES
(1, 'BRG001', 'Buku Tulis', 5000, 100, 1),
(2, 'BRG002', 'Pulpen', 3000, 150, 2),
(3, 'BRG003', 'Pensil', 2000, 200, 3),
(4, 'BRG004', 'Penghapus', 1500, 100, 4),
(5, 'BRG005', 'Penggaris', 4000, 80, 5),
(6, 'BRG006', 'Spidol', 7000, 90, 1),
(7, 'BRG007', 'Buku Gambar', 10000, 60, 2),
(8, 'BRG008', 'Tas Sekolah', 150000, 30, 3);

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001', 'Andi Saputra', 'L', '081234567811', 'Surabaya'),
('PLG002', 'Rohman Bambang', 'L', '081234567812', 'Sidoarjo'),
('PLG003', 'Budi Santoso', 'L', '081234567813', 'Gresik'),
('PLG004', 'Dewi Lestari', 'P', '081234567814', 'Malang'),
('PLG005', 'Rizky Pratama', 'L', '081234567815', 'Mojokerto'),
('PLG006', 'Rina Amelia', 'P', '081234567816', 'Pasuruan'),
('PLG007', 'Fajar Andika', 'L', '081234567817', 'Lamongan'),
('PLG008', 'Rusdi Rahwana', 'L', '081234567818', 'Ngawi');

INSERT INTO transaksi (id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES
(1,  '2026-11-01', 'Pembelian tas sekolah', 150000, 'PLG001'),
(2,  '2026-11-02', 'Pembelian alat tulis', 35000,  'PLG002'),
(3,  '2026-11-03', 'Pembelian buku gambar dan spidol', 27000, 'PLG003'),
(4,  '2026-11-04', 'Pembelian pulpen & pensil', 25000, 'PLG004'),
(5,  '2026-11-05', 'Pembelian buku tulis & penggaris', 18000, 'PLG005'),
(6,  '2026-11-05', 'Pembelian tas + alat tulis', 185000, 'PLG006'),
(7,  '2026-11-06', 'Pembelian penghapus', 1500, 'PLG007'),
(8,  '2026-11-07', 'Pembelian spidol & buku gambar', 27000, 'PLG008'),
(9,  '2026-11-07', 'Pembelian pulpen tambahan', 12000, 'PLG001'),
(10, '2026-11-08', 'Pembelian semua item mini', 50000, 'PLG002'),
(11, '2026-11-05', 'Pembelian pensil tambahan', 10000, 'PLG007');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 8, 150000, 1),
(2, 1, 5000, 5),
(2, 2, 3000, 2),
(3, 7, 10000, 2),
(3, 6, 7000, 1),
(4, 2, 3000, 5),
(4, 3, 2000, 5),
(5, 1, 5000, 2),
(5, 5, 4000, 2),
(6, 8, 150000, 1),
(6, 6, 7000, 5),
(7, 4, 1500, 1),
(8, 7, 10000, 2),
(8, 6, 7000, 1),
(9, 2, 3000, 4),
(10, 1, 5000, 2),
(10, 2, 3000, 2),
(10, 4, 1500, 5),
(11, 3, 2000, 5);

INSERT INTO pembayaran (id, waktu_bayar, total, metode, transaksi_id) VALUES
(1,  '2026-11-01 09:15:00', 150000, 'TUNAI', 1),
(2,  '2026-11-02 10:30:00', 35000,  'TUNAI', 2),
(3,  '2026-11-03 11:00:00', 27000,  'TUNAI', 3),
(4,  '2026-11-04 12:45:00', 25000,  'TRANSFER', 4),
(5,  '2026-11-05 13:20:00', 18000,  'TRANSFER', 5),
(6,  '2026-11-05 14:10:00', 185000, 'TUNAI', 6),
(7,  '2026-11-06 15:05:00', 1500,   'TUNAI', 7),
(8,  '2026-11-07 16:00:00', 27000,  'TRANSFER', 8),
(9,  '2026-11-07 16:30:00', 12000,  'TUNAI', 9),
(10, '2026-11-08 10:00:00', 50000,  'TRANSFER',10),
(11, '2026-11-05 15:00:00', 10000,  'TUNAI', 11);
