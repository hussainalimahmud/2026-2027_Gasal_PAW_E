USE penjualan;

INSERT INTO pelanggan VALUES
('P001','Aldi','L','081234567801','Surabaya'),
('P002','Dimas','L','081234567802','Sidoarjo'),
('P003','Budi','L','081234567803','Gresik'),
('P004','Dewi','P','081234567804','Malang'),
('P005','Rizky','L','081234567805','Mojokerto'),
('P006','Ririn','P','081234567806','Lamongan'),
('P007','Azizah','P','081234567807','Jombang'),
('P008','Amelia','P','081234567808','Madura'),
('P009','Rusdi','L','080034567809','Ngawi'),
('P010','Roni','L','081234567810','Nganjuk');


INSERT INTO supplier VALUES
(1,'PT Sumber Air','081111111111','Surabaya'),
(2,'PT Berkah Jaya','081111111112','Sidoarjo'),
(3,'PT Maju Bersatu','081111111113','Jakarta'),
(4,'PT Mitra Sukses','081111111114','Bojonegoro'),
(5,'PT Sentosa Selamanya','081111111115','Mojokerto'),
(6,'CV Cahaya Baru','081111111116','Lamongan'),
(7,'PT Sinar Terang','081111111117','Jombang'),
(8,'CV Mandiri Jaya','081111111118','Pasuruan'),
(9,'PT Kapal Karam','081111111119','Ngawi'),
(10,'PT Dunia Akhirat','081111111120','Madura');


INSERT INTO barang VALUES
(1,'BRG001','Laptop Infinix',7500000,20,1),
(2,'BRG002','Mouse Fantech',150000,50,2),
(3,'BRG003','Keyboard Fortex',450000,30,3),
(4,'BRG004','Monitor LG',2200000,15,4),
(5,'BRG005','Printer Epson',1800000,12,5),
(6,'BRG006','Flashdisk 32GB',75000,100,6),
(7,'BRG007','Harddisk 1TB',850000,25,7),
(8,'BRG008','Headset Gaming',350000,40,8),
(9,'BRG009','Webcam Logitech',550000,18,9),
(10,'BRG010','Speaker Bluetooth',275000,35,10);


INSERT INTO transaksi VALUES
(1,'2026-10-01','Pembelian Laptop',7500000,'P001'),
(2,'2026-10-02','Pembelian Mouse',150000,'P002'),
(3,'2026-10-03','Pembelian Keyboard',450000,'P003'),
(4,'2026-10-04','Pembelian Monitor',2200000,'P004'),
(5,'2026-10-05','Pembelian Printer',1800000,'P005'),
(6,'2026-10-06','Pembelian Flashdisk',75000,'P006'),
(7,'2026-10-07','Pembelian Harddisk',850000,'P007'),
(8,'2026-10-07','Pembelian Headset',350000,'P008'),
(9,'2026-10-08','Pembelian Webcam',550000,'P009'),
(10,'2026-10-9','Pembelian Speaker',275000,'P010');


INSERT INTO transaksi_detail VALUES
(1,1,7500000,1),
(2,2,150000,1),
(3,3,450000,1),
(4,4,2200000,1),
(5,5,1800000,1),
(6,6,75000,1),
(7,7,850000,1),
(8,8,350000,1),
(9,9,550000,1),
(10,10,275000,1);


INSERT INTO pembayaran VALUES
(1,'2026-10-01 10:12:20',7500000,'TRANSFER',1),
(2,'2026-10-02 11:06:08',150000,'TUNAI',2),
(3,'2026-10-03 12:20:12',450000,'EDC',3),
(4,'2026-10-04 13:01:10',2200000,'TRANSFER',4),
(5,'2026-10-05 14:49:04',1800000,'TUNAI',5),
(6,'2026-10-06 09:50:08',75000,'EDC',6),
(7,'2026-10-07 10:31:31',850000,'TRANSFER',7),
(8,'2026-10-07 11:36:11',350000,'TUNAI',8),
(9,'2026-10-08 13:35:06',550000,'EDC',9),
(10,'2026-10-09 15:01:44',275000,'TRANSFER',10);


INSERT INTO `user` VALUES
(1,'admin01','demo123','Administrator','Bojonegoro','081222222201',1),
(2,'kasir01','demo123','Kasir Satu','Sidoarjo','081222222202',2),
(3,'kasir02','demo123','Kasir Dua','Gresik','081222222203',2),
(4,'staff01','demo123','Staff Gudang','Malang','081222222204',3),
(5,'staff02','demo123','Staff Penjualan','Mojokerto','081222222205',3),
(6,'admin02','demo123','Admin Dua','Lamongan','081222222206',1),
(7,'kasir03','demo123','Kasir Tiga','Jombang','081222222207',2),
(8,'staff03','demo123','Staff Tiga','Pasuruan','081222222208',3),
(9,'kasir04','demo123','Kasir Empat','Kediri','081222222209',2),
(10,'admin03','demo123','Admin Tiga','Blitar','081222222210',1);
