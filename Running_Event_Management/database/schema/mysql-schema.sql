/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ms_backuplog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_backuplog` (
  `BackupID` int NOT NULL AUTO_INCREMENT,
  `AdminID` int DEFAULT NULL,
  `WaktuBackup` datetime DEFAULT CURRENT_TIMESTAMP,
  `StatusBackup` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`BackupID`),
  KEY `AdminID` (`AdminID`),
  CONSTRAINT `ms_backuplog_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `tr_pengguna` (`PenggunaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ms_biayakategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_biayakategori` (
  `BiayaID` int NOT NULL AUTO_INCREMENT,
  `KategoriID` int DEFAULT NULL,
  `PeriodePembayaran` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Nominal` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`BiayaID`),
  KEY `KategoriID` (`KategoriID`),
  CONSTRAINT `ms_biayakategori_ibfk_1` FOREIGN KEY (`KategoriID`) REFERENCES `ms_kategorilomba` (`KategoriID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_audit_biaya_update` AFTER UPDATE ON `ms_biayakategori` FOR EACH ROW BEGIN
    INSERT INTO tr_logaktivitassistem (PenggunaID, Aktivitas, WaktuAktivitas)
    VALUES (
        1, -- Asumsi ID Admin Utama
        CONCAT('Mengubah biaya Kategori ID ', OLD.KategoriID, ' dari ', OLD.Nominal, ' menjadi ', NEW.Nominal),
        NOW()
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
DROP TABLE IF EXISTS `ms_dokumenpendukung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_dokumenpendukung` (
  `DokumenID` int NOT NULL AUTO_INCREMENT,
  `PendaftaranID` int DEFAULT NULL,
  `NamaDokumen` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Wajib` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`DokumenID`),
  KEY `PendaftaranID` (`PendaftaranID`),
  CONSTRAINT `ms_dokumenpendukung_ibfk_1` FOREIGN KEY (`PendaftaranID`) REFERENCES `tr_pendaftaran` (`PendaftaranID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ms_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_event` (
  `EventID` int NOT NULL AUTO_INCREMENT,
  `NamaEvent` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `DeskripsiEvent` text COLLATE utf8mb4_general_ci,
  `StatusEvent` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `GambarEvent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ms_faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_faq` (
  `FaqID` int NOT NULL AUTO_INCREMENT,
  `Pertanyaan` text COLLATE utf8mb4_general_ci,
  `Jawaban` text COLLATE utf8mb4_general_ci,
  `Urutan` int DEFAULT NULL,
  PRIMARY KEY (`FaqID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ms_halamanweb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_halamanweb` (
  `HalamanID` int NOT NULL AUTO_INCREMENT,
  `JudulHalaman` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Slug` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Konten` text COLLATE utf8mb4_general_ci,
  `LastUpdated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`HalamanID`),
  UNIQUE KEY `Slug` (`Slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ms_jadwalevent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_jadwalevent` (
  `JadwalID` int NOT NULL AUTO_INCREMENT,
  `EventID` int DEFAULT NULL,
  `JenisJadwal` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `WaktuJadwal` datetime DEFAULT NULL,
  PRIMARY KEY (`JadwalID`),
  KEY `EventID` (`EventID`),
  CONSTRAINT `ms_jadwalevent_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `ms_event` (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ms_kategorilomba`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_kategorilomba` (
  `KategoriID` int NOT NULL AUTO_INCREMENT,
  `EventID` int DEFAULT NULL,
  `NamaKategori` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Jarak` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `JarakKM` decimal(8,2) DEFAULT NULL,
  `BatasUsiaMin` int DEFAULT NULL,
  `BatasUsiaMax` int DEFAULT NULL,
  PRIMARY KEY (`KategoriID`),
  KEY `EventID` (`EventID`),
  CONSTRAINT `ms_kategorilomba_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `ms_event` (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ms_mediasosialevent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_mediasosialevent` (
  `MedsosID` int NOT NULL AUTO_INCREMENT,
  `EventID` int DEFAULT NULL,
  `NamaPlatform` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `URLAkun` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`MedsosID`),
  KEY `EventID` (`EventID`),
  CONSTRAINT `ms_mediasosialevent_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `ms_event` (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ms_metodepembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_metodepembayaran` (
  `MetodeID` int NOT NULL AUTO_INCREMENT,
  `NamaMetode` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `NomorAkun` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `AtasNama` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`MetodeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ms_notifikasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_notifikasi` (
  `NotifikasiID` int NOT NULL AUTO_INCREMENT,
  `AdminID` int DEFAULT NULL,
  `TipeNotifikasi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `JudulNotifikasi` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `IsiNotifikasi` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`NotifikasiID`),
  KEY `AdminID` (`AdminID`),
  CONSTRAINT `ms_notifikasi_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `tr_pengguna` (`PenggunaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ms_pengaturanuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_pengaturanuser` (
  `PengaturanID` int NOT NULL AUTO_INCREMENT,
  `PenggunaID` int DEFAULT NULL,
  `NamaPengaturan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `NilaiPengaturan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`PengaturanID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ms_peran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_peran` (
  `PeranID` int NOT NULL AUTO_INCREMENT,
  `NamaPeran` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`PeranID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ms_racepackitem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_racepackitem` (
  `ItemID` int NOT NULL AUTO_INCREMENT,
  `NamaItem` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `DeskripsiItem` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ms_resetpasswordtoken`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_resetpasswordtoken` (
  `TokenID` int NOT NULL AUTO_INCREMENT,
  `PenggunaID` int DEFAULT NULL,
  `Token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `WaktuExpired` datetime DEFAULT NULL,
  PRIMARY KEY (`TokenID`),
  KEY `PenggunaID` (`PenggunaID`),
  CONSTRAINT `ms_resetpasswordtoken_ibfk_1` FOREIGN KEY (`PenggunaID`) REFERENCES `tr_pengguna` (`PenggunaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ms_slotkategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_slotkategori` (
  `SlotID` int NOT NULL AUTO_INCREMENT,
  `KategoriID` int DEFAULT NULL,
  `KuotaTotal` int DEFAULT NULL,
  `KuotaTersisa` int DEFAULT NULL,
  `TanggalMulai` datetime DEFAULT NULL,
  `TanggalSelesai` datetime DEFAULT NULL,
  `LokasiEvent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `StatusEvent` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`SlotID`),
  KEY `KategoriID` (`KategoriID`),
  CONSTRAINT `ms_slotkategori_ibfk_1` FOREIGN KEY (`KategoriID`) REFERENCES `ms_kategorilomba` (`KategoriID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ms_stokracepack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_stokracepack` (
  `StokID` int NOT NULL AUTO_INCREMENT,
  `ItemID` int DEFAULT NULL,
  `Ukuran` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `JumlahStok` int DEFAULT NULL,
  PRIMARY KEY (`StokID`),
  KEY `ItemID` (`ItemID`),
  CONSTRAINT `ms_stokracepack_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `ms_racepackitem` (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `total_distances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `total_distances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `PenggunaID` int unsigned NOT NULL,
  `TotalDistance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `LastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `total_distances_penggunaid_unique` (`PenggunaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tr_aktivitaslogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_aktivitaslogin` (
  `LoginID` int NOT NULL AUTO_INCREMENT,
  `PenggunaID` int DEFAULT NULL,
  `IPAddress` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `WaktuLogin` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`LoginID`),
  KEY `PenggunaID` (`PenggunaID`),
  CONSTRAINT `tr_aktivitaslogin_ibfk_1` FOREIGN KEY (`PenggunaID`) REFERENCES `tr_pengguna` (`PenggunaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tr_detailpilihanpeserta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_detailpilihanpeserta` (
  `PilihanID` int NOT NULL AUTO_INCREMENT,
  `PendaftaranID` int DEFAULT NULL,
  `SponsorID` int DEFAULT NULL,
  `JenisPilihan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `NilaiPilihan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`PilihanID`),
  KEY `PendaftaranID` (`PendaftaranID`),
  KEY `SponsorID` (`SponsorID`),
  CONSTRAINT `tr_detailpilihanpeserta_ibfk_1` FOREIGN KEY (`PendaftaranID`) REFERENCES `tr_pendaftaran` (`PendaftaranID`),
  CONSTRAINT `tr_detailpilihanpeserta_ibfk_2` FOREIGN KEY (`SponsorID`) REFERENCES `tr_sponsor` (`SponsorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tr_galleryevent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_galleryevent` (
  `PhotoID` int NOT NULL AUTO_INCREMENT,
  `EventID` int DEFAULT NULL,
  `Caption` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `FilePath` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`PhotoID`),
  KEY `EventID` (`EventID`),
  CONSTRAINT `tr_galleryevent_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `ms_event` (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tr_hasillomba`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_hasillomba` (
  `HasilID` int NOT NULL AUTO_INCREMENT,
  `PendaftaranID` int DEFAULT NULL,
  `WaktuFinish` time DEFAULT NULL,
  `PeringkatUmum` int DEFAULT NULL,
  `StatusHasil` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`HasilID`),
  KEY `PendaftaranID` (`PendaftaranID`),
  CONSTRAINT `tr_hasillomba_ibfk_1` FOREIGN KEY (`PendaftaranID`) REFERENCES `tr_pendaftaran` (`PendaftaranID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tr_logaktivitassistem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_logaktivitassistem` (
  `LogID` int NOT NULL AUTO_INCREMENT,
  `PenggunaID` int DEFAULT NULL,
  `TipeAktivitas` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `DetailAktivitas` text COLLATE utf8mb4_general_ci,
  `WaktuLog` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`LogID`),
  KEY `PenggunaID` (`PenggunaID`),
  CONSTRAINT `tr_logaktivitassistem_ibfk_1` FOREIGN KEY (`PenggunaID`) REFERENCES `tr_pengguna` (`PenggunaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tr_pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_pembayaran` (
  `PembayaranID` int NOT NULL AUTO_INCREMENT,
  `PendaftaranID` int DEFAULT NULL,
  `MetodeID` int DEFAULT NULL,
  `NominalBayar` decimal(15,2) DEFAULT NULL,
  `StatusPembayaran` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `BuktiPembayaran` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `TanggalBayar` datetime DEFAULT NULL,
  PRIMARY KEY (`PembayaranID`),
  KEY `PendaftaranID` (`PendaftaranID`),
  KEY `MetodeID` (`MetodeID`),
  CONSTRAINT `tr_pembayaran_ibfk_1` FOREIGN KEY (`PendaftaranID`) REFERENCES `tr_pendaftaran` (`PendaftaranID`),
  CONSTRAINT `tr_pembayaran_ibfk_2` FOREIGN KEY (`MetodeID`) REFERENCES `ms_metodepembayaran` (`MetodeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tr_pendaftaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_pendaftaran` (
  `PendaftaranID` int NOT NULL AUTO_INCREMENT,
  `PenggunaID` int DEFAULT NULL,
  `KategoriID` int DEFAULT NULL,
  `NomorBIB` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `StatusPendaftaran` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `TanggalPendaftaran` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PendaftaranID`),
  KEY `PenggunaID` (`PenggunaID`),
  KEY `KategoriID` (`KategoriID`),
  CONSTRAINT `tr_pendaftaran_ibfk_1` FOREIGN KEY (`PenggunaID`) REFERENCES `tr_pengguna` (`PenggunaID`),
  CONSTRAINT `tr_pendaftaran_ibfk_2` FOREIGN KEY (`KategoriID`) REFERENCES `ms_kategorilomba` (`KategoriID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_after_pendaftaran_insert` AFTER INSERT ON `tr_pendaftaran` FOR EACH ROW BEGIN
    -- Mengurangi kuota pada kategori yang dipilih peserta
    UPDATE ms_slotkategori 
    SET KuotaTersisa = KuotaTersisa - 1
    WHERE KategoriID = NEW.KategoriID;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_backup_pendaftaran_deleted` BEFORE DELETE ON `tr_pendaftaran` FOR EACH ROW BEGIN
    INSERT INTO ms_backuplog (Aktivitas, DataLama, WaktuBackup)
    VALUES (
        'DELETE_PENDAFTARAN', 
        CONCAT('Pendaftaran ID: ', OLD.PendaftaranID, ' dihapus.'), 
        NOW()
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
DROP TABLE IF EXISTS `tr_pengguna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_pengguna` (
  `PenggunaID` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `NomorTelepon` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Kota` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `NamaLengkap` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Gambar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `PeranID` int DEFAULT NULL,
  PRIMARY KEY (`PenggunaID`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`),
  KEY `PeranID` (`PeranID`),
  CONSTRAINT `tr_pengguna_ibfk_1` FOREIGN KEY (`PeranID`) REFERENCES `ms_peran` (`PeranID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tr_pengirimannotifikasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_pengirimannotifikasi` (
  `KirimID` int NOT NULL AUTO_INCREMENT,
  `NotifikasiID` int DEFAULT NULL,
  `PenggunaTargetID` int DEFAULT NULL,
  `WaktuKirim` datetime DEFAULT CURRENT_TIMESTAMP,
  `StatusKirim` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`KirimID`),
  KEY `NotifikasiID` (`NotifikasiID`),
  KEY `PenggunaTargetID` (`PenggunaTargetID`),
  CONSTRAINT `tr_pengirimannotifikasi_ibfk_1` FOREIGN KEY (`NotifikasiID`) REFERENCES `ms_notifikasi` (`NotifikasiID`),
  CONSTRAINT `tr_pengirimannotifikasi_ibfk_2` FOREIGN KEY (`PenggunaTargetID`) REFERENCES `tr_pengguna` (`PenggunaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tr_peringkatkelompokusia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_peringkatkelompokusia` (
  `PeringkatUsiaID` int NOT NULL AUTO_INCREMENT,
  `EventID` int DEFAULT NULL,
  `HasilID` int DEFAULT NULL,
  `KelompokUsia` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PeringkatKelompok` int DEFAULT NULL,
  PRIMARY KEY (`PeringkatUsiaID`),
  KEY `EventID` (`EventID`),
  KEY `HasilID` (`HasilID`),
  CONSTRAINT `tr_peringkatkelompokusia_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `ms_event` (`EventID`),
  CONSTRAINT `tr_peringkatkelompokusia_ibfk_2` FOREIGN KEY (`HasilID`) REFERENCES `tr_hasillomba` (`HasilID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tr_pesankontak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_pesankontak` (
  `PesanID` int NOT NULL AUTO_INCREMENT,
  `NamaPengirim` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `EmailPengirim` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Subjek` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `IsiPesan` text COLLATE utf8mb4_general_ci,
  `TanggalKirim` datetime DEFAULT CURRENT_TIMESTAMP,
  `StatusBaca` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`PesanID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tr_peserta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_peserta` (
  `PesertaID` int NOT NULL AUTO_INCREMENT,
  `PendaftaranID` int DEFAULT NULL,
  `JenisKelamin` enum('L','P') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `TanggalLahir` date DEFAULT NULL,
  `NomorTelepon` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`PesertaID`),
  KEY `PendaftaranID` (`PendaftaranID`),
  CONSTRAINT `tr_peserta_ibfk_1` FOREIGN KEY (`PendaftaranID`) REFERENCES `tr_pendaftaran` (`PendaftaranID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tr_racepackdetailpeserta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_racepackdetailpeserta` (
  `RacePackPesertaID` int NOT NULL AUTO_INCREMENT,
  `PendaftaranID` int DEFAULT NULL,
  `NomorBIB` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ChipTimerID` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`RacePackPesertaID`),
  KEY `PendaftaranID` (`PendaftaranID`),
  CONSTRAINT `tr_racepackdetailpeserta_ibfk_1` FOREIGN KEY (`PendaftaranID`) REFERENCES `tr_pendaftaran` (`PendaftaranID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tr_racepackdistribusi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_racepackdistribusi` (
  `DistribusiID` int NOT NULL AUTO_INCREMENT,
  `PendaftaranID` int DEFAULT NULL,
  `PetugasID` int DEFAULT NULL,
  `StatusPengambilan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `TanggalPengambilan` datetime DEFAULT NULL,
  PRIMARY KEY (`DistribusiID`),
  KEY `PendaftaranID` (`PendaftaranID`),
  KEY `PetugasID` (`PetugasID`),
  CONSTRAINT `tr_racepackdistribusi_ibfk_1` FOREIGN KEY (`PendaftaranID`) REFERENCES `tr_pendaftaran` (`PendaftaranID`),
  CONSTRAINT `tr_racepackdistribusi_ibfk_2` FOREIGN KEY (`PetugasID`) REFERENCES `tr_pengguna` (`PenggunaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tr_sertifikat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_sertifikat` (
  `SertifikatID` int NOT NULL AUTO_INCREMENT,
  `PendaftaranID` int DEFAULT NULL,
  `NomorSertifikat` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `FilePathPdf` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`SertifikatID`),
  KEY `PendaftaranID` (`PendaftaranID`),
  CONSTRAINT `tr_sertifikat_ibfk_1` FOREIGN KEY (`PendaftaranID`) REFERENCES `tr_pendaftaran` (`PendaftaranID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tr_sponsor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_sponsor` (
  `SponsorID` int NOT NULL AUTO_INCREMENT,
  `EventID` int DEFAULT NULL,
  `NamaSponsor` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `TingkatSponsor` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`SponsorID`),
  KEY `EventID` (`EventID`),
  CONSTRAINT `tr_sponsor_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `ms_event` (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tr_verifikasipembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tr_verifikasipembayaran` (
  `VerifikasiID` int NOT NULL AUTO_INCREMENT,
  `PembayaranID` int DEFAULT NULL,
  `PanitiaID` int DEFAULT NULL,
  `StatusVerifikasi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `WaktuVerifikasi` datetime DEFAULT NULL,
  PRIMARY KEY (`VerifikasiID`),
  KEY `PembayaranID` (`PembayaranID`),
  KEY `PanitiaID` (`PanitiaID`),
  CONSTRAINT `tr_verifikasipembayaran_ibfk_1` FOREIGN KEY (`PembayaranID`) REFERENCES `tr_pembayaran` (`PembayaranID`),
  CONSTRAINT `tr_verifikasipembayaran_ibfk_2` FOREIGN KEY (`PanitiaID`) REFERENCES `tr_pengguna` (`PenggunaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_verifikasi_to_logistik` AFTER UPDATE ON `tr_verifikasipembayaran` FOR EACH ROW BEGIN
    DECLARE v_pendaftaran_id INT;

    -- Mencari PendaftaranID dari tabel pembayaran karena di tabel verifikasi tidak ada
    SELECT PendaftaranID INTO v_pendaftaran_id 
    FROM tr_pembayaran 
    WHERE PembayaranID = NEW.PembayaranID;

    -- Jika status verifikasi berubah menjadi 'Valid'
    IF NEW.StatusVerifikasi = 'Valid' THEN
        -- Memasukkan data ke distribusi racepack
        INSERT INTO tr_racepackdistribusi (PendaftaranID, StatusAmbil, TanggalUpdate)
        VALUES (v_pendaftaran_id, 'Belum Diambil', NOW());
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
DROP TABLE IF EXISTS `v_aktivitas_terbaru`;
/*!50001 DROP VIEW IF EXISTS `v_aktivitas_terbaru`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_aktivitas_terbaru` AS SELECT 
 1 AS `NamaLengkap`,
 1 AS `Aktivitas`,
 1 AS `Waktu`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_audit_sistem`;
/*!50001 DROP VIEW IF EXISTS `v_audit_sistem`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_audit_sistem` AS SELECT 
 1 AS `LogID`,
 1 AS `Username`,
 1 AS `TipeAktivitas`,
 1 AS `DetailAktivitas`,
 1 AS `WaktuLog`,
 1 AS `StatusBackup`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_cek_sertifikat`;
/*!50001 DROP VIEW IF EXISTS `v_cek_sertifikat`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_cek_sertifikat` AS SELECT 
 1 AS `NamaLengkap`,
 1 AS `NamaEvent`,
 1 AS `NomorSertifikat`,
 1 AS `FilePathPdf`,
 1 AS `WaktuFinish`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_data_pendaftaran`;
/*!50001 DROP VIEW IF EXISTS `v_data_pendaftaran`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_data_pendaftaran` AS SELECT 
 1 AS `PendaftaranID`,
 1 AS `NamaLengkap`,
 1 AS `NamaEvent`,
 1 AS `NamaKategori`,
 1 AS `StatusPendaftaran`,
 1 AS `TanggalPendaftaran`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_identitas_event_medsos`;
/*!50001 DROP VIEW IF EXISTS `v_identitas_event_medsos`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_identitas_event_medsos` AS SELECT 
 1 AS `EventID`,
 1 AS `NamaEvent`,
 1 AS `NamaPlatform`,
 1 AS `URLAkun`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_jadwal_slot_lengkap`;
/*!50001 DROP VIEW IF EXISTS `v_jadwal_slot_lengkap`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_jadwal_slot_lengkap` AS SELECT 
 1 AS `NamaEvent`,
 1 AS `JenisJadwal`,
 1 AS `WaktuJadwal`,
 1 AS `NamaKategori`,
 1 AS `KuotaTersisa`,
 1 AS `TanggalMulai`,
 1 AS `TanggalSelesai`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_katalog_event`;
/*!50001 DROP VIEW IF EXISTS `v_katalog_event`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_katalog_event` AS SELECT 
 1 AS `EventID`,
 1 AS `NamaEvent`,
 1 AS `NamaKategori`,
 1 AS `Jarak`,
 1 AS `KuotaTersisa`,
 1 AS `Harga`,
 1 AS `LokasiEvent`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_keamanan_akses`;
/*!50001 DROP VIEW IF EXISTS `v_keamanan_akses`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_keamanan_akses` AS SELECT 
 1 AS `Username`,
 1 AS `IPAddress`,
 1 AS `WaktuLogin`,
 1 AS `TokenExpired`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_konfirmasi_pembayaran`;
/*!50001 DROP VIEW IF EXISTS `v_konfirmasi_pembayaran`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_konfirmasi_pembayaran` AS SELECT 
 1 AS `PembayaranID`,
 1 AS `PendaftaranID`,
 1 AS `NamaLengkap`,
 1 AS `NamaMetode`,
 1 AS `NominalBayar`,
 1 AS `StatusPembayaran`,
 1 AS `StatusVerifikasi`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_leaderboard`;
/*!50001 DROP VIEW IF EXISTS `v_leaderboard`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_leaderboard` AS SELECT 
 1 AS `PeringkatUmum`,
 1 AS `NamaLengkap`,
 1 AS `NamaKategori`,
 1 AS `WaktuFinish`,
 1 AS `KelompokUsia`,
 1 AS `PeringkatKelompok`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_logistik_racepack`;
/*!50001 DROP VIEW IF EXISTS `v_logistik_racepack`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_logistik_racepack` AS SELECT 
 1 AS `PendaftaranID`,
 1 AS `NamaLengkap`,
 1 AS `NomorBIB`,
 1 AS `ChipTimerID`,
 1 AS `StatusPengambilan`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_monitoring_stok_rp`;
/*!50001 DROP VIEW IF EXISTS `v_monitoring_stok_rp`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_monitoring_stok_rp` AS SELECT 
 1 AS `NamaItem`,
 1 AS `Ukuran`,
 1 AS `JumlahStok`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_profil_pengguna`;
/*!50001 DROP VIEW IF EXISTS `v_profil_pengguna`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_profil_pengguna` AS SELECT 
 1 AS `PenggunaID`,
 1 AS `Username`,
 1 AS `Email`,
 1 AS `NamaLengkap`,
 1 AS `NamaPeran`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_rekap_keuangan_event`;
/*!50001 DROP VIEW IF EXISTS `v_rekap_keuangan_event`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_rekap_keuangan_event` AS SELECT 
 1 AS `NamaEvent`,
 1 AS `Total_Pendaftar`,
 1 AS `Total_Pendapatan`,
 1 AS `Jumlah_Lunas`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_rekap_sponsor_peserta`;
/*!50001 DROP VIEW IF EXISTS `v_rekap_sponsor_peserta`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_rekap_sponsor_peserta` AS SELECT 
 1 AS `NamaSponsor`,
 1 AS `TingkatSponsor`,
 1 AS `NamaPeserta`,
 1 AS `JenisPilihan`,
 1 AS `NilaiPilihan`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_riwayat_notifikasi`;
/*!50001 DROP VIEW IF EXISTS `v_riwayat_notifikasi`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_riwayat_notifikasi` AS SELECT 
 1 AS `KirimID`,
 1 AS `Penerima`,
 1 AS `JudulNotifikasi`,
 1 AS `TipeNotifikasi`,
 1 AS `WaktuKirim`,
 1 AS `StatusKirim`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_statistik_admin`;
/*!50001 DROP VIEW IF EXISTS `v_statistik_admin`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_statistik_admin` AS SELECT 
 1 AS `Total_Event`,
 1 AS `Total_Pendaftar`,
 1 AS `Total_Pendapatan`,
 1 AS `Total_User`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_timeline_aktivitas`;
/*!50001 DROP VIEW IF EXISTS `v_timeline_aktivitas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_timeline_aktivitas` AS SELECT 
 1 AS `NamaLengkap`,
 1 AS `Tipe_Aktivitas`,
 1 AS `Waktu`*/;
SET character_set_client = @saved_cs_client;
DROP TABLE IF EXISTS `v_verifikasi_dokumen`;
/*!50001 DROP VIEW IF EXISTS `v_verifikasi_dokumen`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_verifikasi_dokumen` AS SELECT 
 1 AS `DokumenID`,
 1 AS `PendaftaranID`,
 1 AS `NamaLengkap`,
 1 AS `NamaDokumen`,
 1 AS `Wajib`*/;
SET character_set_client = @saved_cs_client;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ambil_racepack` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ambil_racepack`(IN `p_pendaftaran_id` INT, IN `p_petugas_id` INT, IN `p_item_id` INT, IN `p_ukuran` VARCHAR(10))
BEGIN
    -- Cek ketersediaan stok
    IF (SELECT JumlahStok FROM ms_stokracepack WHERE ItemID = p_item_id AND Ukuran = p_ukuran) > 0 THEN
        START TRANSACTION;
            -- Catat distribusi
            INSERT INTO tr_racepackdistribusi (PendaftaranID, PetugasID, StatusPengambilan, TanggalPengambilan)
            VALUES (p_pendaftaran_id, p_petugas_id, 'Sudah Diambil', NOW());
            
            -- Kurangi stok item
            UPDATE ms_stokracepack 
            SET JumlahStok = JumlahStok - 1 
            WHERE ItemID = p_item_id AND Ukuran = p_ukuran;
        COMMIT;
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stok ukuran tersebut habis';
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_buat_notifikasi_dan_log` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_buat_notifikasi_dan_log`(IN `p_user_id` INT, IN `p_tipe_notif` VARCHAR(50), IN `p_judul` VARCHAR(150), IN `p_isi` TEXT, IN `p_aktivitas` VARCHAR(50))
BEGIN
    -- 1. Insert ke MS_Notifikasi (Template/Master)
    INSERT INTO ms_notifikasi (AdminID, TipeNotifikasi, JudulNotifikasi, IsiNotifikasi)
    VALUES (p_user_id, p_tipe_notif, p_judul, p_isi);
    
    SET @notif_id = LAST_INSERT_ID();
    
    -- 2. Insert ke TR_PengirimanNotifikasi (Transaksi)
    INSERT INTO tr_pengirimannotifikasi (NotifikasiID, PenggunaTargetID, WaktuKirim, StatusKirim)
    VALUES (@notif_id, p_user_id, NOW(), 'Pending');
    
    -- 3. Insert ke TR_LogAktivitasSistem (Audit Trail)
    INSERT INTO tr_logaktivitassistem (PenggunaID, TipeAktivitas, DetailAktivitas, WaktuLog)
    VALUES (p_user_id, p_aktivitas, p_isi, NOW());
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_daftar_event` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_daftar_event`(IN `p_pengguna_id` INT, IN `p_kategori_id` INT, IN `p_jk` ENUM('L','P'), IN `p_tgl_lahir` DATE, IN `p_telp` VARCHAR(20))
BEGIN
    DECLARE v_sisa_kuota INT;
    
    -- Cek sisa kuota
    SELECT KuotaTersisa INTO v_sisa_kuota 
    FROM ms_slotkategori 
    WHERE KategoriID = p_kategori_id;
    
    IF v_sisa_kuota > 0 THEN
        START TRANSACTION;
            -- 1. Insert ke Pendaftaran
            INSERT INTO tr_pendaftaran (PenggunaID, KategoriID, StatusPendaftaran, TanggalPendaftaran)
            VALUES (p_pengguna_id, p_kategori_id, 'Menunggu Pembayaran', NOW());
            
            SET @last_id = LAST_INSERT_ID();
            
            -- 2. Insert ke detail Peserta
            INSERT INTO tr_peserta (PendaftaranID, JenisKelamin, TanggalLahir, NomorTelepon)
            VALUES (@last_id, p_jk, p_tgl_lahir, p_telp);
            
            -- 3. Update Kuota
            UPDATE ms_slotkategori 
            SET KuotaTersisa = KuotaTersisa - 1 
            WHERE KategoriID = p_kategori_id;
        COMMIT;
        SELECT 'Berhasil mendaftar' AS Pesan;
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Kuota pendaftaran sudah habis';
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_input_hasil` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_input_hasil`(IN `p_pendaftaran_id` INT, IN `p_waktu` TIME)
BEGIN
    INSERT INTO tr_hasillomba (PendaftaranID, WaktuFinish, StatusHasil)
    VALUES (p_pendaftaran_id, p_waktu, 'Finish');
    
    -- Menghitung peringkat otomatis berdasarkan waktu tercepat
    SET @rank := 0;
    UPDATE tr_hasillomba 
    SET PeringkatUmum = (@rank := @rank + 1)
    ORDER BY WaktuFinish ASC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_request_reset_password` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_request_reset_password`(IN `p_email` VARCHAR(100), IN `p_token` VARCHAR(255))
BEGIN
    DECLARE v_user_id INT;
    SELECT PenggunaID INTO v_user_id FROM tr_pengguna WHERE Email = p_email;
    
    IF v_user_id IS NOT NULL THEN
        -- Hapus token lama jika ada
        DELETE FROM ms_resetpasswordtoken WHERE PenggunaID = v_user_id;
        
        -- Insert token baru (berlaku 1 jam)
        INSERT INTO ms_resetpasswordtoken (PenggunaID, Token, WaktuExpired)
        VALUES (v_user_id, p_token, DATE_ADD(NOW(), INTERVAL 1 HOUR));
        
        SELECT 'Token berhasil dibuat' AS Status;
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Email tidak ditemukan';
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_simpan_pesan_kontak` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_simpan_pesan_kontak`(IN `p_nama` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_subjek` VARCHAR(150), IN `p_pesan` TEXT)
BEGIN
    INSERT INTO tr_pesankontak (NamaPengirim, EmailPengirim, Subjek, IsiPesan, TanggalKirim, StatusBaca)
    VALUES (p_nama, p_email, p_subjek, p_pesan, NOW(), 0);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_verifikasi_bayar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_verifikasi_bayar`(IN `p_pembayaran_id` INT, IN `p_panitia_id` INT, IN `p_status` VARCHAR(50))
BEGIN
    START TRANSACTION;
        -- 1. Update Tabel Pembayaran
        UPDATE tr_pembayaran SET StatusPembayaran = 'Lunas' WHERE PembayaranID = p_pembayaran_id;
        
        -- 2. Insert ke Verifikasi
        INSERT INTO tr_verifikasipembayaran (PembayaranID, PanitiaID, StatusVerifikasi, WaktuVerifikasi)
        VALUES (p_pembayaran_id, p_panitia_id, p_status, NOW());
        
        -- 3. Update Status di Pendaftaran
        SET @pendaftar_id = (SELECT PendaftaranID FROM tr_pembayaran WHERE PembayaranID = p_pembayaran_id);
        UPDATE tr_pendaftaran SET StatusPendaftaran = 'Terverifikasi' WHERE PendaftaranID = @pendaftar_id;
    COMMIT;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50001 DROP VIEW IF EXISTS `v_aktivitas_terbaru`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_aktivitas_terbaru` AS select `u`.`NamaLengkap` AS `NamaLengkap`,'Login' AS `Aktivitas`,`a`.`WaktuLogin` AS `Waktu` from (`tr_aktivitaslogin` `a` join `tr_pengguna` `u` on((`a`.`PenggunaID` = `u`.`PenggunaID`))) union all select `u`.`NamaLengkap` AS `NamaLengkap`,'Mendaftar Event' AS `Aktivitas`,`p`.`TanggalPendaftaran` AS `Waktu` from (`tr_pendaftaran` `p` join `tr_pengguna` `u` on((`p`.`PenggunaID` = `u`.`PenggunaID`))) order by `Waktu` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_audit_sistem`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_audit_sistem` AS select `l`.`LogID` AS `LogID`,`u`.`Username` AS `Username`,`l`.`TipeAktivitas` AS `TipeAktivitas`,`l`.`DetailAktivitas` AS `DetailAktivitas`,`l`.`WaktuLog` AS `WaktuLog`,`b`.`StatusBackup` AS `StatusBackup` from ((`tr_logaktivitassistem` `l` join `tr_pengguna` `u` on((`l`.`PenggunaID` = `u`.`PenggunaID`))) left join `ms_backuplog` `b` on((`u`.`PenggunaID` = `b`.`AdminID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_cek_sertifikat`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_cek_sertifikat` AS select `u`.`NamaLengkap` AS `NamaLengkap`,`e`.`NamaEvent` AS `NamaEvent`,`s`.`NomorSertifikat` AS `NomorSertifikat`,`s`.`FilePathPdf` AS `FilePathPdf`,`h`.`WaktuFinish` AS `WaktuFinish` from (((((`tr_sertifikat` `s` join `tr_pendaftaran` `p` on((`s`.`PendaftaranID` = `p`.`PendaftaranID`))) join `tr_pengguna` `u` on((`p`.`PenggunaID` = `u`.`PenggunaID`))) join `tr_hasillomba` `h` on((`p`.`PendaftaranID` = `h`.`PendaftaranID`))) join `ms_kategorilomba` `k` on((`p`.`KategoriID` = `k`.`KategoriID`))) join `ms_event` `e` on((`k`.`EventID` = `e`.`EventID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_data_pendaftaran`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_data_pendaftaran` AS select `p`.`PendaftaranID` AS `PendaftaranID`,`u`.`NamaLengkap` AS `NamaLengkap`,`e`.`NamaEvent` AS `NamaEvent`,`k`.`NamaKategori` AS `NamaKategori`,`p`.`StatusPendaftaran` AS `StatusPendaftaran`,`p`.`TanggalPendaftaran` AS `TanggalPendaftaran` from (((`tr_pendaftaran` `p` join `tr_pengguna` `u` on((`p`.`PenggunaID` = `u`.`PenggunaID`))) join `ms_kategorilomba` `k` on((`p`.`KategoriID` = `k`.`KategoriID`))) join `ms_event` `e` on((`k`.`EventID` = `e`.`EventID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_identitas_event_medsos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_identitas_event_medsos` AS select `e`.`EventID` AS `EventID`,`e`.`NamaEvent` AS `NamaEvent`,`m`.`NamaPlatform` AS `NamaPlatform`,`m`.`URLAkun` AS `URLAkun` from (`ms_event` `e` left join `ms_mediasosialevent` `m` on((`e`.`EventID` = `m`.`EventID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_jadwal_slot_lengkap`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_jadwal_slot_lengkap` AS select `e`.`NamaEvent` AS `NamaEvent`,`j`.`JenisJadwal` AS `JenisJadwal`,`j`.`WaktuJadwal` AS `WaktuJadwal`,`k`.`NamaKategori` AS `NamaKategori`,`s`.`KuotaTersisa` AS `KuotaTersisa`,`s`.`TanggalMulai` AS `TanggalMulai`,`s`.`TanggalSelesai` AS `TanggalSelesai` from (((`ms_event` `e` join `ms_jadwalevent` `j` on((`e`.`EventID` = `j`.`EventID`))) join `ms_kategorilomba` `k` on((`e`.`EventID` = `k`.`EventID`))) join `ms_slotkategori` `s` on((`k`.`KategoriID` = `s`.`KategoriID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_katalog_event`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_katalog_event` AS select `e`.`EventID` AS `EventID`,`e`.`NamaEvent` AS `NamaEvent`,`k`.`NamaKategori` AS `NamaKategori`,`k`.`Jarak` AS `Jarak`,`s`.`KuotaTersisa` AS `KuotaTersisa`,`b`.`Nominal` AS `Harga`,`s`.`LokasiEvent` AS `LokasiEvent` from (((`ms_event` `e` join `ms_kategorilomba` `k` on((`e`.`EventID` = `k`.`EventID`))) join `ms_slotkategori` `s` on((`k`.`KategoriID` = `s`.`KategoriID`))) join `ms_biayakategori` `b` on((`k`.`KategoriID` = `b`.`KategoriID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_keamanan_akses`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_keamanan_akses` AS select `u`.`Username` AS `Username`,`al`.`IPAddress` AS `IPAddress`,`al`.`WaktuLogin` AS `WaktuLogin`,`t`.`WaktuExpired` AS `TokenExpired` from ((`tr_pengguna` `u` left join `tr_aktivitaslogin` `al` on((`u`.`PenggunaID` = `al`.`PenggunaID`))) left join `ms_resetpasswordtoken` `t` on((`u`.`PenggunaID` = `t`.`PenggunaID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_konfirmasi_pembayaran`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_konfirmasi_pembayaran` AS select `py`.`PembayaranID` AS `PembayaranID`,`p`.`PendaftaranID` AS `PendaftaranID`,`u`.`NamaLengkap` AS `NamaLengkap`,`m`.`NamaMetode` AS `NamaMetode`,`py`.`NominalBayar` AS `NominalBayar`,`py`.`StatusPembayaran` AS `StatusPembayaran`,`v`.`StatusVerifikasi` AS `StatusVerifikasi` from ((((`tr_pembayaran` `py` join `tr_pendaftaran` `p` on((`py`.`PendaftaranID` = `p`.`PendaftaranID`))) join `tr_pengguna` `u` on((`p`.`PenggunaID` = `u`.`PenggunaID`))) join `ms_metodepembayaran` `m` on((`py`.`MetodeID` = `m`.`MetodeID`))) left join `tr_verifikasipembayaran` `v` on((`py`.`PembayaranID` = `v`.`PembayaranID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_leaderboard`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_leaderboard` AS select `h`.`PeringkatUmum` AS `PeringkatUmum`,`u`.`NamaLengkap` AS `NamaLengkap`,`k`.`NamaKategori` AS `NamaKategori`,`h`.`WaktuFinish` AS `WaktuFinish`,`pu`.`KelompokUsia` AS `KelompokUsia`,`pu`.`PeringkatKelompok` AS `PeringkatKelompok` from ((((`tr_hasillomba` `h` join `tr_pendaftaran` `p` on((`h`.`PendaftaranID` = `p`.`PendaftaranID`))) join `tr_pengguna` `u` on((`p`.`PenggunaID` = `u`.`PenggunaID`))) join `ms_kategorilomba` `k` on((`p`.`KategoriID` = `k`.`KategoriID`))) left join `tr_peringkatkelompokusia` `pu` on((`h`.`HasilID` = `pu`.`HasilID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_logistik_racepack`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_logistik_racepack` AS select `p`.`PendaftaranID` AS `PendaftaranID`,`u`.`NamaLengkap` AS `NamaLengkap`,`d`.`NomorBIB` AS `NomorBIB`,`d`.`ChipTimerID` AS `ChipTimerID`,`rs`.`StatusPengambilan` AS `StatusPengambilan` from (((`tr_pendaftaran` `p` join `tr_pengguna` `u` on((`p`.`PenggunaID` = `u`.`PenggunaID`))) join `tr_racepackdetailpeserta` `d` on((`p`.`PendaftaranID` = `d`.`PendaftaranID`))) left join `tr_racepackdistribusi` `rs` on((`p`.`PendaftaranID` = `rs`.`PendaftaranID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_monitoring_stok_rp`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_monitoring_stok_rp` AS select `i`.`NamaItem` AS `NamaItem`,`s`.`Ukuran` AS `Ukuran`,`s`.`JumlahStok` AS `JumlahStok` from (`ms_racepackitem` `i` join `ms_stokracepack` `s` on((`i`.`ItemID` = `s`.`ItemID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_profil_pengguna`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_profil_pengguna` AS select `p`.`PenggunaID` AS `PenggunaID`,`p`.`Username` AS `Username`,`p`.`Email` AS `Email`,`p`.`NamaLengkap` AS `NamaLengkap`,`r`.`NamaPeran` AS `NamaPeran` from (`tr_pengguna` `p` join `ms_peran` `r` on((`p`.`PeranID` = `r`.`PeranID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_rekap_keuangan_event`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_rekap_keuangan_event` AS select `e`.`NamaEvent` AS `NamaEvent`,count(`p`.`PendaftaranID`) AS `Total_Pendaftar`,sum(`py`.`NominalBayar`) AS `Total_Pendapatan`,count((case when (`py`.`StatusPembayaran` = 'Lunas') then 1 end)) AS `Jumlah_Lunas` from (((`ms_event` `e` join `ms_kategorilomba` `k` on((`e`.`EventID` = `k`.`EventID`))) join `tr_pendaftaran` `p` on((`k`.`KategoriID` = `p`.`KategoriID`))) left join `tr_pembayaran` `py` on((`p`.`PendaftaranID` = `py`.`PendaftaranID`))) group by `e`.`EventID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_rekap_sponsor_peserta`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_rekap_sponsor_peserta` AS select `s`.`NamaSponsor` AS `NamaSponsor`,`s`.`TingkatSponsor` AS `TingkatSponsor`,`u`.`NamaLengkap` AS `NamaPeserta`,`dp`.`JenisPilihan` AS `JenisPilihan`,`dp`.`NilaiPilihan` AS `NilaiPilihan` from (((`tr_sponsor` `s` join `tr_detailpilihanpeserta` `dp` on((`s`.`SponsorID` = `dp`.`SponsorID`))) join `tr_pendaftaran` `p` on((`dp`.`PendaftaranID` = `p`.`PendaftaranID`))) join `tr_pengguna` `u` on((`p`.`PenggunaID` = `u`.`PenggunaID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_riwayat_notifikasi`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_riwayat_notifikasi` AS select `kn`.`KirimID` AS `KirimID`,`u`.`NamaLengkap` AS `Penerima`,`n`.`JudulNotifikasi` AS `JudulNotifikasi`,`n`.`TipeNotifikasi` AS `TipeNotifikasi`,`kn`.`WaktuKirim` AS `WaktuKirim`,`kn`.`StatusKirim` AS `StatusKirim` from ((`tr_pengirimannotifikasi` `kn` join `ms_notifikasi` `n` on((`kn`.`NotifikasiID` = `n`.`NotifikasiID`))) join `tr_pengguna` `u` on((`kn`.`PenggunaTargetID` = `u`.`PenggunaID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_statistik_admin`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_statistik_admin` AS select (select count(0) from `ms_event`) AS `Total_Event`,(select count(0) from `tr_pendaftaran`) AS `Total_Pendaftar`,(select sum(`tr_pembayaran`.`NominalBayar`) from `tr_pembayaran` where (`tr_pembayaran`.`StatusPembayaran` = 'Lunas')) AS `Total_Pendapatan`,(select count(0) from `tr_pengguna`) AS `Total_User` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_timeline_aktivitas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_timeline_aktivitas` AS select `u`.`NamaLengkap` AS `NamaLengkap`,'Pendaftaran Baru' AS `Tipe_Aktivitas`,`p`.`TanggalPendaftaran` AS `Waktu` from (`tr_pendaftaran` `p` join `tr_pengguna` `u` on((`p`.`PenggunaID` = `u`.`PenggunaID`))) union all select `u`.`NamaLengkap` AS `NamaLengkap`,'Login' AS `Tipe_Aktivitas`,`l`.`WaktuLogin` AS `Waktu` from (`tr_aktivitaslogin` `l` join `tr_pengguna` `u` on((`l`.`PenggunaID` = `u`.`PenggunaID`))) order by `Waktu` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP VIEW IF EXISTS `v_verifikasi_dokumen`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_verifikasi_dokumen` AS select `d`.`DokumenID` AS `DokumenID`,`p`.`PendaftaranID` AS `PendaftaranID`,`u`.`NamaLengkap` AS `NamaLengkap`,`d`.`NamaDokumen` AS `NamaDokumen`,`d`.`Wajib` AS `Wajib` from ((`ms_dokumenpendukung` `d` join `tr_pendaftaran` `p` on((`d`.`PendaftaranID` = `p`.`PendaftaranID`))) join `tr_pengguna` `u` on((`p`.`PenggunaID` = `u`.`PenggunaID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'2026_01_18_000000_import_legacy_schema',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'2026_01_18_165338_create_sessions_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'2026_01_18_165339_create_cache_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4,'2026_01_18_165339_create_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5,'2026_01_18_171545_update_schema_for_dynamic_data',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6,'2026_01_18_201303_add_bukti_pembayaran_to_tr_pembayaran_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7,'2026_01_19_000000_add_profile_fields_to_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8,'2026_01_19_000001_add_numeric_distance_to_categories',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9,'2026_01_19_000002_add_club_and_bib_columns',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10,'2026_01_19_000003_rename_club_to_city',1);
