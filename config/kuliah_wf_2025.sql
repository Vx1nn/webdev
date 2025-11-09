-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 23, 2025 at 09:01 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10
drop database if exists web_rshp;
create database if not exists web_rshp;
use web_rshp;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `kuliah_wf_2025`
--

-- --------------------------------------------------------
--
-- Table structure for table `detail_rekam_medis`
--

CREATE TABLE IF NOT EXISTS `detail_rekam_medis` (
  `iddetail_rekam_medis` int NOT NULL,
  `idrekam_medis` int NOT NULL,
  `idkode_tindakan_terapi` int NOT NULL,
  `detail` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `detail_rekam_medis`
--

-- --------------------------------------------------------
--
-- Table structure for table `jenis_hewan`
--

CREATE TABLE IF NOT EXISTS `jenis_hewan` (
  `idjenis_hewan` int NOT NULL,
  `nama_jenis_hewan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `jenis_hewan`
--

INSERT INTO `jenis_hewan` (`idjenis_hewan`, `nama_jenis_hewan`)
VALUES (1, 'Anjing (Canis lupus familiaris)'),
  (2, 'Kucing (Felis catus)'),
  (3, 'Kelinci (Oryctolagus cuniculus)'),
  (4, 'Burung'),
  (5, 'Reptil'),
  (6, 'Rodent / Hewan Kecil');
-- --------------------------------------------------------
--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `idkategori` int NOT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `nama_kategori`)
VALUES (1, 'Vaksinasi'),
  (2, 'Bedah / Operasi'),
  (3, 'Cairan infus'),
  (4, 'Terapi Injeksi'),
  (5, 'Terapi Oral'),
  (6, 'Diagnostik'),
  (7, 'Rawat Inap'),
  (8, 'Lain-lain');
-- --------------------------------------------------------
--
-- Table structure for table `kategori_klinis`
--

CREATE TABLE IF NOT EXISTS `kategori_klinis` (
  `idkategori_klinis` int NOT NULL,
  `nama_kategori_klinis` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `kategori_klinis`
--

INSERT INTO `kategori_klinis` (`idkategori_klinis`, `nama_kategori_klinis`)
VALUES (1, 'Terapi'),
  (2, 'Tindakan');
-- --------------------------------------------------------
--
-- Table structure for table `kode_tindakan_terapi`
--

CREATE TABLE IF NOT EXISTS `kode_tindakan_terapi` (
  `idkode_tindakan_terapi` int NOT NULL,
  `kode` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi_tindakan_terapi` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idkategori` int NOT NULL,
  `idkategori_klinis` int NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `kode_tindakan_terapi`
--

INSERT INTO `kode_tindakan_terapi` (
    `idkode_tindakan_terapi`,
    `kode`,
    `deskripsi_tindakan_terapi`,
    `idkategori`,
    `idkategori_klinis`
  )
VALUES (1, 'T01', 'Vaksinasi Rabies', 1, 1),
  (
    2,
    'T02',
    'Vaksinasi Polivalen (DHPPi/L untuk anjing)',
    1,
    1
  ),
  (
    3,
    'T03',
    'Vaksinasi Panleukopenia / Tricat kucing',
    1,
    1
  ),
  (
    4,
    'T04',
    'Vaksinasi lainnya (bordetella, influenza, dsb.)',
    1,
    1
  ),
  (5, 'T05', 'Sterilisasi jantan', 2, 2),
  (6, 'T06', 'Sterilisasi betina', 2, 2),
  (9, 'T07', 'Minor surgery (luka, abses)', 2, 2),
  (
    10,
    'T08',
    'Major surgery (laparotomi, tumor)',
    2,
    2
  ),
  (
    11,
    'T09',
    'Infus intravena cairan kristaloid',
    3,
    1
  ),
  (12, 'T10', 'Infus intravena cairan koloid', 3, 1),
  (13, 'T11', 'Antibiotik injeksi', 4, 1),
  (14, 'T12', 'Antiparasit injeksi', 4, 1),
  (15, 'T13', 'Antiemetik / gastroprotektor', 4, 1),
  (16, 'T14', 'Analgesik / antiinflamasi', 4, 1),
  (17, 'T15', 'Kortikosteroid', 4, 1),
  (18, 'T16', 'Antibiotik oral', 5, 1),
  (19, 'T17', 'Antiparasit oral', 5, 1),
  (20, 'T18', 'Vitamin / suplemen', 5, 1),
  (21, 'T19', 'Diet khusus', 5, 1),
  (22, 'T20', 'Pemeriksaan darah rutin', 6, 2),
  (23, 'T21', 'Pemeriksaan kimia darah', 6, 2),
  (
    24,
    'T22',
    'Pemeriksaan feses / parasitologi',
    6,
    2
  ),
  (25, 'T23', 'Pemeriksaan urin', 6, 2),
  (26, 'T24', 'Radiografi (rontgen)', 6, 2),
  (27, 'T25', 'USG Abdomen', 6, 2),
  (28, 'T26', 'Sitologi / biopsi', 6, 2),
  (29, 'T27', 'Rapid test penyakit infeksi', 6, 2),
  (30, 'T28', 'Observasi sehari', 7, 2),
  (31, 'T29', 'Observasi lebih dari 1 hari', 7, 2),
  (32, 'T30', 'Grooming medis', 8, 2),
  (33, 'T31', 'Deworming', 8, 1),
  (34, 'T32', 'Ektoparasit control', 8, 1);
-- --------------------------------------------------------
--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `NIP` char(25) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `No_telp` varchar(18) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status_aktif` tinyint(1) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
-- --------------------------------------------------------
--
-- Table structure for table `pemilik`
--

CREATE TABLE IF NOT EXISTS `pemilik` (
  `idpemilik` int NOT NULL,
  `no_wa` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `iduser` bigint NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `pemilik`
--

-- --------------------------------------------------------
--
-- Table structure for table `pet`
--

CREATE TABLE IF NOT EXISTS `pet` (
  `idpet` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `warna_tanda` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpemilik` int NOT NULL,
  `idras_hewan` int NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `pet`
--

-- --------------------------------------------------------
--
-- Table structure for table `proyek`
--

CREATE TABLE IF NOT EXISTS `proyek` (
  `id_proyek` char(25) NOT NULL,
  `nama_proyek` varchar(50) NOT NULL,
  `tanggal_dimulai` datetime DEFAULT CURRENT_TIMESTAMP,
  `tanggal_berakhir` date DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
-- --------------------------------------------------------
--
-- Table structure for table `ras_hewan`
--

CREATE TABLE IF NOT EXISTS `ras_hewan` (
  `idras_hewan` int NOT NULL,
  `nama_ras` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idjenis_hewan` int NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `ras_hewan`
--

INSERT INTO `ras_hewan` (`idras_hewan`, `nama_ras`, `idjenis_hewan`)
VALUES (1, 'Golden Retriever', 1),
  (2, 'Labrador Retriever', 1),
  (3, 'German Shepherd', 1),
  (4, 'Bulldog (English, French)', 1),
  (5, 'Poodle (Toy, Miniature, Standard)', 1),
  (6, 'Beagle', 1),
  (7, 'Siberian Husky', 1),
  (8, 'Shih Tzu', 1),
  (9, 'Dachshund', 1),
  (10, 'Chihuahua', 1),
  (11, 'Persia', 2),
  (12, 'Maine Coon', 2),
  (13, 'Siamese', 2),
  (14, 'Bengal', 2),
  (15, 'Sphynx', 2),
  (16, 'Scottish Fold', 2),
  (17, 'British Shorthair', 2),
  (18, 'Anggora', 2),
  (19, 'Domestic Shorthair (kampung)', 2),
  (20, 'Ragdoll', 2),
  (21, 'Holland Lop', 3),
  (22, 'Netherland Dwarf', 3),
  (23, 'Flemish Giant', 3),
  (24, 'Lionhead', 3),
  (25, 'Rex', 3),
  (26, 'Angora Rabbit', 3),
  (27, 'Mini Lop', 3),
  (28, 'Lovebird (Agapornis sp.)', 4),
  (29, 'Kakatua (Cockatoo)', 4),
  (
    30,
    'Parrot / Nuri (Macaw, African Grey, Amazon Parrot)',
    4
  ),
  (31, 'Kenari (Serinus canaria)', 4),
  (32, 'Merpati (Columba livia)', 4),
  (
    33,
    'Parkit (Budgerigar / Melopsittacus undulatus)',
    4
  ),
  (34, 'Jalak (Sturnus sp.)', 4),
  (
    35,
    'Kura-kura Sulcata (African spurred tortoise)',
    5
  ),
  (
    36,
    'Red-Eared Slider (Trachemys scripta elegans)',
    5
  ),
  (37, 'Leopard Gecko', 5),
  (38, 'Iguana hijau', 5),
  (39, 'Ball Python', 5),
  (40, 'Corn Snake', 5),
  (
    41,
    'Hamster (Syrian, Roborovski, Campbell, Winter White)',
    6
  ),
  (
    42,
    'Guinea Pig (Abyssinian, Peruvian, American Shorthair)',
    6
  ),
  (43, 'Gerbil', 6),
  (44, 'Chinchilla', 6);
-- --------------------------------------------------------
--
-- Table structure for table `rekam_medis`
--

CREATE TABLE IF NOT EXISTS `rekam_medis` (
  `idrekam_medis` int NOT NULL,
  `idreservasi_dokter` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `anamesis` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `temuan_klinis` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `diagnosa` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dokter_pemeriksa` int NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `rekam_medis`
--

-- --------------------------------------------------------
--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `idrole` int NOT NULL,
  `nama_role` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `role`
--

INSERT INTO `role` (`idrole`, `nama_role`)
VALUES (1, 'Administrator'),
  (2, 'Dokter'),
  (3, 'Perawat'),
  (4, 'Resepsionis'),
  (5, 'Pemilik');
-- --------------------------------------------------------
--
-- Table structure for table `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `idrole_user` int NOT NULL,
  `iduser` bigint NOT NULL,
  `idrole` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1'
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`idrole_user`, `iduser`, `idrole`, `status`)
VALUES (1, 6, 1, 1);
-- --------------------------------------------------------
--
-- Table structure for table `temu_dokter`
--

CREATE TABLE IF NOT EXISTS `temu_dokter` (
  `idreservasi_dokter` int NOT NULL,
  `no_urut` int DEFAULT NULL,
  `waktu_daftar` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpet` int NOT NULL,
  `idrole_user` int NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `temu_dokter`
--

-- --------------------------------------------------------
--
-- Table structure for table `todo_list`
--

CREATE TABLE IF NOT EXISTS `todo_list` (
  `status_selesai` tinyint(1) DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `NIP` char(25) DEFAULT NULL,
  `id_proyek` char(25) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
-- --------------------------------------------------------
--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `iduser` bigint NOT NULL,
  `nama` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `nama`, `email`, `password`)
VALUES (
    6,
    'admin',
    'admin@mail.com',
    '$2y$10$6fgJedH.24DiaHjbmspxZusZ/4.bNbQc18YGCNXKulAyJwLvsw8pO'
  );
--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_rekam_medis`
--
ALTER TABLE `detail_rekam_medis`
ADD PRIMARY KEY (`iddetail_rekam_medis`),
  ADD KEY `fk_detail_rekam_medis_rekam_medis1_idx` (`idrekam_medis`),
  ADD KEY `idkode_tindakan_terapi` (`idkode_tindakan_terapi`);
--
-- Indexes for table `jenis_hewan`
--
ALTER TABLE `jenis_hewan`
ADD PRIMARY KEY (`idjenis_hewan`);
--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
ADD PRIMARY KEY (`idkategori`);
--
-- Indexes for table `kategori_klinis`
--
ALTER TABLE `kategori_klinis`
ADD PRIMARY KEY (`idkategori_klinis`);
--
-- Indexes for table `kode_tindakan_terapi`
--
ALTER TABLE `kode_tindakan_terapi`
ADD PRIMARY KEY (`idkode_tindakan_terapi`),
  ADD KEY `fk_kode_tindakan_terapi_kategori1_idx` (`idkategori`),
  ADD KEY `fk_kode_tindakan_terapi_kategori_klinis1_idx` (`idkategori_klinis`);
--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
ADD PRIMARY KEY (`NIP`);
--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
ADD PRIMARY KEY (`idpemilik`),
  ADD KEY `fk_pemilik_user1_idx` (`iduser`);
--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
ADD PRIMARY KEY (`idpet`),
  ADD KEY `fk_pet_pemilik1_idx` (`idpemilik`),
  ADD KEY `fk_pet_ras_hewan1_idx` (`idras_hewan`);
--
-- Indexes for table `proyek`
--
ALTER TABLE `proyek`
ADD PRIMARY KEY (`id_proyek`);
--
-- Indexes for table `ras_hewan`
--
ALTER TABLE `ras_hewan`
ADD PRIMARY KEY (`idras_hewan`),
  ADD KEY `fk_ras_hewan_jenis_hewan1_idx` (`idjenis_hewan`);
--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
ADD PRIMARY KEY (`idrekam_medis`),
  ADD KEY `fk_rekam_medis_role_user1_idx` (`dokter_pemeriksa`),
  ADD KEY `fk_rekam_temu_idx` (`idreservasi_dokter`);
--
-- Indexes for table `role`
--
ALTER TABLE `role`
ADD PRIMARY KEY (`idrole`);
--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
ADD PRIMARY KEY (`idrole_user`),
  ADD KEY `fk_role_user_user_idx` (`iduser`),
  ADD KEY `fk_role_user_role1_idx` (`idrole`);
--
-- Indexes for table `temu_dokter`
--
ALTER TABLE `temu_dokter`
ADD PRIMARY KEY (`idreservasi_dokter`),
  ADD KEY `fk_temu_dokter_pet_idx` (`idpet`),
  ADD KEY `fk_temu_dokter_role_user_idx` (`idrole_user`);
--
-- Indexes for table `todo_list`
--
ALTER TABLE `todo_list`
ADD KEY `fk_pegawai` (`NIP`),
  ADD KEY `fk_proyek` (`id_proyek`);
--
-- Indexes for table `user`
--
ALTER TABLE `user`
ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `email` (`email`);
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_rekam_medis`
--
ALTER TABLE `detail_rekam_medis`
MODIFY `iddetail_rekam_medis` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jenis_hewan`
--
ALTER TABLE `jenis_hewan`
MODIFY `idjenis_hewan` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 7;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
MODIFY `idkategori` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 9;
--
-- AUTO_INCREMENT for table `kategori_klinis`
--
ALTER TABLE `kategori_klinis`
MODIFY `idkategori_klinis` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT for table `kode_tindakan_terapi`
--
ALTER TABLE `kode_tindakan_terapi`
MODIFY `idkode_tindakan_terapi` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 35;
--
-- AUTO_INCREMENT for table `pemilik`
--
ALTER TABLE `pemilik`
MODIFY `idpemilik` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
MODIFY `idpet` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ras_hewan`
--
ALTER TABLE `ras_hewan`
MODIFY `idras_hewan` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 45;
--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
MODIFY `idrekam_medis` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `idrole` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 6;
--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
MODIFY `idrole_user` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;
--
-- AUTO_INCREMENT for table `temu_dokter`
--
ALTER TABLE `temu_dokter`
MODIFY `idreservasi_dokter` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `iduser` bigint NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_rekam_medis`
--
ALTER TABLE `detail_rekam_medis`
ADD CONSTRAINT `detail_rekam_medis_ibfk_1` FOREIGN KEY (`idkode_tindakan_terapi`) REFERENCES `kode_tindakan_terapi` (`idkode_tindakan_terapi`),
  ADD CONSTRAINT `fk_detail_rekam_medis_rekam_medis1` FOREIGN KEY (`idrekam_medis`) REFERENCES `rekam_medis` (`idrekam_medis`);
--
-- Constraints for table `kode_tindakan_terapi`
--
ALTER TABLE `kode_tindakan_terapi`
ADD CONSTRAINT `fk_kode_tindakan_terapi_kategori_klinis1` FOREIGN KEY (`idkategori_klinis`) REFERENCES `kategori_klinis` (`idkategori_klinis`);
--
-- Constraints for table `pemilik`
--
ALTER TABLE `pemilik`
ADD CONSTRAINT `fk_pemilik_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);
--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
ADD CONSTRAINT `fk_pet_pemilik1` FOREIGN KEY (`idpemilik`) REFERENCES `pemilik` (`idpemilik`),
  ADD CONSTRAINT `fk_pet_ras_hewan1` FOREIGN KEY (`idras_hewan`) REFERENCES `ras_hewan` (`idras_hewan`);
--
-- Constraints for table `ras_hewan`
--
ALTER TABLE `ras_hewan`
ADD CONSTRAINT `fk_ras_hewan_jenis_hewan1` FOREIGN KEY (`idjenis_hewan`) REFERENCES `jenis_hewan` (`idjenis_hewan`);
--
-- Constraints for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
ADD CONSTRAINT `fk_rekam_temu` FOREIGN KEY (`idreservasi_dokter`) REFERENCES `temu_dokter` (`idreservasi_dokter`),
  ADD CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`dokter_pemeriksa`) REFERENCES `role_user` (`idrole_user`);
--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
ADD CONSTRAINT `fk_role_user_role1` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`),
  ADD CONSTRAINT `fk_role_user_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);
--
-- Constraints for table `temu_dokter`
--
ALTER TABLE `temu_dokter`
ADD CONSTRAINT `fk_temu_dokter_pet` FOREIGN KEY (`idpet`) REFERENCES `pet` (`idpet`),
  ADD CONSTRAINT `fk_temu_dokter_role_user` FOREIGN KEY (`idrole_user`) REFERENCES `role_user` (`idrole_user`);
--
-- Constraints for table `todo_list`
--
ALTER TABLE `todo_list`
ADD CONSTRAINT `fk_pegawai` FOREIGN KEY (`NIP`) REFERENCES `pegawai` (`NIP`),
  ADD CONSTRAINT `fk_proyek` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`);
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;