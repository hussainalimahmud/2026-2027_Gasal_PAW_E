CREATE DATABASE penjualan;


USE penjualan;


CREATE TABLE pelanggan (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100),
    jenis_kelamin ENUM('L','P'),
    telp VARCHAR(12),
    alamat TEXT
) ENGINE=InnoDB;


CREATE TABLE supplier (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    telp VARCHAR(12),
    alamat TEXT
) ENGINE=InnoDB;


CREATE TABLE barang (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(10),
    nama_barang VARCHAR(100),
    harga INT(11),
    stok INT(11),
    supplier_id INT(11),

    FOREIGN KEY (supplier_id)
    REFERENCES supplier(id)
) ENGINE=InnoDB;


CREATE TABLE transaksi (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi DATE,
    keterangan TEXT,
    total INT(11),
    pelanggan_id VARCHAR(20),

    FOREIGN KEY (pelanggan_id)
    REFERENCES pelanggan(id)
) ENGINE=InnoDB;


CREATE TABLE transaksi_detail (
    transaksi_id INT(11),
    barang_id INT(11),
    harga INT(11),
    qty INT(11),

    PRIMARY KEY (transaksi_id, barang_id),

    FOREIGN KEY (transaksi_id)
    REFERENCES transaksi(id),

    FOREIGN KEY (barang_id)
    REFERENCES barang(id)
) ENGINE=InnoDB;


CREATE TABLE pembayaran (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    waktu_bayar DATETIME,
    total INT(11),
    metode ENUM('TUNAI','TRANSFER','EDC'),
    transaksi_id INT(11),

    FOREIGN KEY (transaksi_id)
    REFERENCES transaksi(id)
) ENGINE=InnoDB;


CREATE TABLE `user` (
    id_user TINYINT(2) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30),
    password VARCHAR(35),
    nama VARCHAR(50),
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1)
) ENGINE=InnoDB;
