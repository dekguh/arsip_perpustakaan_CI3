# arsip_perpustakaan_CI3
Aplikasi arsip buku perpustakaan berbasis PHP7 dengan Framework CI3
<br><br>
Info Detail:<br>
Version: PHP7<br>
Database Mysqli<br>
Framework: Codeigniter 3 & Bootstrap 4
<br><br>
pada folder config cari database.php lalu ubah setting nama db,username dan password databasenya
<br><br>
Install Database<br>
CREATE TABLE `buku` (
 `id` int(8) NOT NULL AUTO_INCREMENT,
 `judul` varchar(48) NOT NULL,
 `isbn` varchar(48) NOT NULL,
 `terbit` int(6) NOT NULL,
 `pengarang` varchar(88) NOT NULL,
 `kategori` int(5) NOT NULL,
 `penerbit` int(5) NOT NULL,
 `jumlah` int(6) NOT NULL,
 `rak_buku` int(4) NOT NULL,
 `sinopsis` varchar(216) NOT NULL,
 `status` int(1) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8
<br><br>
CREATE TABLE `kategori` (
 `id` int(5) NOT NULL AUTO_INCREMENT,
 `kategori` varchar(24) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8
<br><br>
CREATE TABLE `peminjam` (
 `id` int(10) NOT NULL AUTO_INCREMENT,
 `nama` varchar(88) NOT NULL,
 `nim` int(24) NOT NULL,
 `buku` int(10) NOT NULL,
 `status` int(1) NOT NULL,
 `end_date` varchar(48) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8
<br><br>
CREATE TABLE `penerbit` (
 `id` int(10) NOT NULL AUTO_INCREMENT,
 `penerbit` varchar(24) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8
<br><br>
CREATE TABLE `users` (
 `id` int(5) NOT NULL AUTO_INCREMENT,
 `username` varchar(24) NOT NULL,
 `email` varchar(88) NOT NULL,
 `password` varchar(88) NOT NULL,
 `status` int(1) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8

setelah itu menuju folder helper, lalu setting di personal_helper.php pada function config_web(),<br>ganti sitekey dan secretkey recaptcha
