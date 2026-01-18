-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2026 at 08:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sistemmanajemenevent_lari`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ambil_racepack` (IN `p_pendaftaran_id` INT, IN `p_petugas_id` INT, IN `p_item_id` INT, IN `p_ukuran` VARCHAR(10))   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_buat_notifikasi_dan_log` (IN `p_user_id` INT, IN `p_tipe_notif` VARCHAR(50), IN `p_judul` VARCHAR(150), IN `p_isi` TEXT, IN `p_aktivitas` VARCHAR(50))   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_daftar_event` (IN `p_pengguna_id` INT, IN `p_kategori_id` INT, IN `p_jk` ENUM('L','P'), IN `p_tgl_lahir` DATE, IN `p_telp` VARCHAR(20))   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_input_hasil` (IN `p_pendaftaran_id` INT, IN `p_waktu` TIME)   BEGIN
    INSERT INTO tr_hasillomba (PendaftaranID, WaktuFinish, StatusHasil)
    VALUES (p_pendaftaran_id, p_waktu, 'Finish');
    
    -- Menghitung peringkat otomatis berdasarkan waktu tercepat
    SET @rank := 0;
    UPDATE tr_hasillomba 
    SET PeringkatUmum = (@rank := @rank + 1)
    ORDER BY WaktuFinish ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_request_reset_password` (IN `p_email` VARCHAR(100), IN `p_token` VARCHAR(255))   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_simpan_pesan_kontak` (IN `p_nama` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_subjek` VARCHAR(150), IN `p_pesan` TEXT)   BEGIN
    INSERT INTO tr_pesankontak (NamaPengirim, EmailPengirim, Subjek, IsiPesan, TanggalKirim, StatusBaca)
    VALUES (p_nama, p_email, p_subjek, p_pesan, NOW(), 0);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_verifikasi_bayar` (IN `p_pembayaran_id` INT, IN `p_panitia_id` INT, IN `p_status` VARCHAR(50))   BEGIN
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
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ms_backuplog`
--

CREATE TABLE `ms_backuplog` (
  `BackupID` int(11) NOT NULL,
  `AdminID` int(11) DEFAULT NULL,
  `WaktuBackup` datetime DEFAULT current_timestamp(),
  `StatusBackup` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ms_biayakategori`
--

CREATE TABLE `ms_biayakategori` (
  `BiayaID` int(11) NOT NULL,
  `KategoriID` int(11) DEFAULT NULL,
  `PeriodePembayaran` varchar(100) DEFAULT NULL,
  `Nominal` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ms_biayakategori`
--

INSERT INTO `ms_biayakategori` (`BiayaID`, `KategoriID`, `PeriodePembayaran`, `Nominal`) VALUES
(1, 1, 'Normal', 175000.00),
(2, NULL, 'Normal', 275000.00),
(3, NULL, 'Normal', 475000.00),
(4, NULL, 'Normal', 575000.00),
(5, NULL, 'Normal', 775000.00),
(6, NULL, 'Normal', 975000.00);

--
-- Triggers `ms_biayakategori`
--
DELIMITER $$
CREATE TRIGGER `trg_audit_biaya_update` AFTER UPDATE ON `ms_biayakategori` FOR EACH ROW BEGIN
    INSERT INTO tr_logaktivitassistem (PenggunaID, Aktivitas, WaktuAktivitas)
    VALUES (
        1, -- Asumsi ID Admin Utama
        CONCAT('Mengubah biaya Kategori ID ', OLD.KategoriID, ' dari ', OLD.Nominal, ' menjadi ', NEW.Nominal),
        NOW()
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ms_dokumenpendukung`
--

CREATE TABLE `ms_dokumenpendukung` (
  `DokumenID` int(11) NOT NULL,
  `PendaftaranID` int(11) DEFAULT NULL,
  `NamaDokumen` varchar(150) DEFAULT NULL,
  `Wajib` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ms_dokumenpendukung`
--

INSERT INTO `ms_dokumenpendukung` (`DokumenID`, `PendaftaranID`, `NamaDokumen`, `Wajib`) VALUES
(1, NULL, 'Foto KTP / Kartu Identitas', 1),
(2, NULL, 'Surat Keterangan Sehat', 1),
(3, NULL, 'Surat Persetujuan Ikut Event (Signed Consent)', 1),
(4, NULL, 'Foto KTP / SIM / Paspor', 1),
(5, NULL, 'Surat Keterangan Sehat (Puskesmas/RS)', 1),
(6, NULL, 'Surat Persetujuan Ikut Event (Signed Consent)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_event`
--

CREATE TABLE `ms_event` (
  `EventID` int(11) NOT NULL,
  `NamaEvent` varchar(255) NOT NULL,
  `DeskripsiEvent` text DEFAULT NULL,
  `StatusEvent` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ms_event`
--

INSERT INTO `ms_event` (`EventID`, `NamaEvent`, `DeskripsiEvent`, `StatusEvent`) VALUES
(1, 'Bandung Marathon 2026', 'Event lari tahunan terbesar di Kota Kembang Bandung.', 'Buka');

-- --------------------------------------------------------

--
-- Table structure for table `ms_faq`
--

CREATE TABLE `ms_faq` (
  `FaqID` int(11) NOT NULL,
  `Pertanyaan` text DEFAULT NULL,
  `Jawaban` text DEFAULT NULL,
  `Urutan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ms_faq`
--

INSERT INTO `ms_faq` (`FaqID`, `Pertanyaan`, `Jawaban`, `Urutan`) VALUES
(1, 'Kapan pendaftaran ditutup?', 'Pendaftaran ditutup pada 1 Juni 2026 atau saat kuota habis.', 1),
(2, 'Dimana lokasi pengambilan Race Pack?', 'Di Gedung Sate, Bandung, H-2 sebelum acara.', 2),
(3, 'Kapan dan di mana pengambilan Race Pack dilakukan?', 'Pengambilan Race Pack dilakukan di Gedung Sate, Bandung pada tanggal 10-11 Juli 2026 pukul 10.00 - 20.00 WIB.', 1),
(4, 'Apakah pendaftaran bisa dibatalkan atau refund?', 'Sesuai kebijakan penyelenggara, pendaftaran yang sudah dibayar tidak dapat dibatalkan atau di-refund.', 2),
(5, 'Apakah boleh mewakilkan pengambilan Race Pack?', 'Boleh, dengan membawa surat kuasa bermaterai dan fotokopi kartu identitas peserta.', 3),
(6, 'Apa itu Cut Off Time (COT)?', 'Batas waktu maksimal untuk menyelesaikan lari. Untuk Full Marathon (42K) adalah 7 jam.', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ms_halamanweb`
--

CREATE TABLE `ms_halamanweb` (
  `HalamanID` int(11) NOT NULL,
  `JudulHalaman` varchar(100) DEFAULT NULL,
  `Slug` varchar(100) DEFAULT NULL,
  `Konten` text DEFAULT NULL,
  `LastUpdated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ms_halamanweb`
--

INSERT INTO `ms_halamanweb` (`HalamanID`, `JudulHalaman`, `Slug`, `Konten`, `LastUpdated`) VALUES
(1, 'Tentang Kami', 'tentang-kami', 'Bandung Marathon adalah event lari tahunan sejak 2020...', '2026-01-16 01:30:46'),
(2, 'Syarat & Ketentuan', 'rules', 'Peserta wajib dalam kondisi sehat walafiat...', '2026-01-16 01:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `ms_jadwalevent`
--

CREATE TABLE `ms_jadwalevent` (
  `JadwalID` int(11) NOT NULL,
  `EventID` int(11) DEFAULT NULL,
  `JenisJadwal` varchar(100) DEFAULT NULL,
  `WaktuJadwal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ms_kategorilomba`
--

CREATE TABLE `ms_kategorilomba` (
  `KategoriID` int(11) NOT NULL,
  `EventID` int(11) DEFAULT NULL,
  `NamaKategori` varchar(100) DEFAULT NULL,
  `Jarak` varchar(20) DEFAULT NULL,
  `BatasUsiaMin` int(11) DEFAULT NULL,
  `BatasUsiaMax` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ms_kategorilomba`
--

INSERT INTO `ms_kategorilomba` (`KategoriID`, `EventID`, `NamaKategori`, `Jarak`, `BatasUsiaMin`, `BatasUsiaMax`) VALUES
(1, NULL, 'Fun Run Bandung', '5K', 12, 60),
(2, NULL, 'Heritage Run', '10K', 15, 60),
(3, NULL, 'Half Marathon', '21K', 17, 60),
(4, NULL, 'Intermediate Bandung', '25K', 18, 55),
(5, NULL, 'Full Marathon', '42K', 18, 50),
(6, NULL, 'Ultra Marathon Lembang', '50K', 21, 50);

-- --------------------------------------------------------

--
-- Table structure for table `ms_mediasosialevent`
--

CREATE TABLE `ms_mediasosialevent` (
  `MedsosID` int(11) NOT NULL,
  `EventID` int(11) DEFAULT NULL,
  `NamaPlatform` varchar(50) DEFAULT NULL,
  `URLAkun` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ms_mediasosialevent`
--

INSERT INTO `ms_mediasosialevent` (`MedsosID`, `EventID`, `NamaPlatform`, `URLAkun`) VALUES
(1, 1, 'Instagram', 'https://instagram.com/bandungmarathon'),
(2, 1, 'Facebook', 'https://facebook.com/bandungmarathon'),
(3, 1, 'Twitter/X', 'https://x.com/bdgmarathon');

-- --------------------------------------------------------

--
-- Table structure for table `ms_metodepembayaran`
--

CREATE TABLE `ms_metodepembayaran` (
  `MetodeID` int(11) NOT NULL,
  `NamaMetode` varchar(100) DEFAULT NULL,
  `NomorAkun` varchar(100) DEFAULT NULL,
  `AtasNama` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ms_metodepembayaran`
--

INSERT INTO `ms_metodepembayaran` (`MetodeID`, `NamaMetode`, `NomorAkun`, `AtasNama`) VALUES
(1, 'Transfer Bank BCA', '0012344556', 'Panitia Bandung Run'),
(2, 'Transfer Bank Mandiri', '13100223344', 'Panitia Bandung Run'),
(3, 'Transfer Bank BNI', '0098877665', 'Panitia Bandung Run'),
(4, 'Transfer Bank BRI', '00211223344', 'Panitia Bandung Run'),
(5, 'Gopay', '08123456789', 'Bandung Run Official'),
(6, 'OVO', '08123456789', 'Bandung Run Official'),
(7, 'Dana', '08123456789', 'Bandung Run Official'),
(8, 'ShopeePay', '08123456789', 'Bandung Run Official'),
(9, 'QRIS / QR Code', 'QR-BDG-2026', 'Bandung Marathon 2026');

-- --------------------------------------------------------

--
-- Table structure for table `ms_notifikasi`
--

CREATE TABLE `ms_notifikasi` (
  `NotifikasiID` int(11) NOT NULL,
  `AdminID` int(11) DEFAULT NULL,
  `TipeNotifikasi` varchar(50) DEFAULT NULL,
  `JudulNotifikasi` varchar(150) DEFAULT NULL,
  `IsiNotifikasi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ms_notifikasi`
--

INSERT INTO `ms_notifikasi` (`NotifikasiID`, `AdminID`, `TipeNotifikasi`, `JudulNotifikasi`, `IsiNotifikasi`) VALUES
(3, 1, 'Email', 'Pendaftaran Berhasil', 'Terima kasih telah mendaftar. Silakan lakukan pembayaran.'),
(4, 1, 'Web', 'Pembayaran Terverifikasi', 'Selamat! Pembayaran Anda telah kami terima.');

-- --------------------------------------------------------

--
-- Table structure for table `ms_pengaturanuser`
--

CREATE TABLE `ms_pengaturanuser` (
  `PengaturanID` int(11) NOT NULL,
  `PenggunaID` int(11) DEFAULT NULL,
  `NamaPengaturan` varchar(100) DEFAULT NULL,
  `NilaiPengaturan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ms_pengaturanuser`
--

INSERT INTO `ms_pengaturanuser` (`PengaturanID`, `PenggunaID`, `NamaPengaturan`, `NilaiPengaturan`) VALUES
(1, 1, 'Email_Notification', 'Enabled'),
(2, 1, 'Two_Factor_Auth', 'Disabled');

-- --------------------------------------------------------

--
-- Table structure for table `ms_peran`
--

CREATE TABLE `ms_peran` (
  `PeranID` int(11) NOT NULL,
  `NamaPeran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ms_peran`
--

INSERT INTO `ms_peran` (`PeranID`, `NamaPeran`) VALUES
(1, 'Admin'),
(2, 'Panitia'),
(3, 'Petugas Lapangan'),
(4, 'Peserta');

-- --------------------------------------------------------

--
-- Table structure for table `ms_racepackitem`
--

CREATE TABLE `ms_racepackitem` (
  `ItemID` int(11) NOT NULL,
  `NamaItem` varchar(100) DEFAULT NULL,
  `DeskripsiItem` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ms_racepackitem`
--

INSERT INTO `ms_racepackitem` (`ItemID`, `NamaItem`, `DeskripsiItem`) VALUES
(1, 'Jersey Eksklusif', 'Kaos lari bahan dry-fit kualitas premium'),
(2, 'Nomor BIB', 'Nomor dada peserta dengan chip timer'),
(3, 'Tote Bag', 'Tas serbaguna untuk perlengkapan lari'),
(4, 'Medali Finisher', 'Medali logam untuk yang mencapai garis finish'),
(5, 'Jersey Eksklusif', 'Kaos lari bahan dry-fit premium dengan desain edisi Bandung Marathon 2026.'),
(6, 'Nomor BIB', 'Nomor dada peserta yang dilengkapi dengan UHF RFID Chip untuk timing system.'),
(7, 'Tote Bag', 'Tas ramah lingkungan untuk menyimpan perlengkapan lari.'),
(8, 'Medali Finisher', 'Medali logam eksklusif bagi seluruh peserta yang berhasil mencapai finish sebelum COT.'),
(9, 'E-Sertifikat', 'Sertifikat digital yang dapat diunduh setelah perlombaan berakhir.');

-- --------------------------------------------------------

--
-- Table structure for table `ms_resetpasswordtoken`
--

CREATE TABLE `ms_resetpasswordtoken` (
  `TokenID` int(11) NOT NULL,
  `PenggunaID` int(11) DEFAULT NULL,
  `Token` varchar(255) DEFAULT NULL,
  `WaktuExpired` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ms_slotkategori`
--

CREATE TABLE `ms_slotkategori` (
  `SlotID` int(11) NOT NULL,
  `KategoriID` int(11) DEFAULT NULL,
  `KuotaTotal` int(11) DEFAULT NULL,
  `KuotaTersisa` int(11) DEFAULT NULL,
  `TanggalMulai` datetime DEFAULT NULL,
  `TanggalSelesai` datetime DEFAULT NULL,
  `LokasiEvent` varchar(255) DEFAULT NULL,
  `StatusEvent` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ms_slotkategori`
--

INSERT INTO `ms_slotkategori` (`SlotID`, `KategoriID`, `KuotaTotal`, `KuotaTersisa`, `TanggalMulai`, `TanggalSelesai`, `LokasiEvent`, `StatusEvent`) VALUES
(1, 1, 1000, 1000, '2026-02-01 00:00:00', '2026-07-01 00:00:00', 'Gedung Sate, Bandung', 'Aktif'),
(2, NULL, 800, 800, '2026-02-01 00:00:00', '2026-07-01 00:00:00', 'Jl. Asia Afrika, Bandung', 'Aktif'),
(3, NULL, 500, 500, '2026-02-01 00:00:00', '2026-07-01 00:00:00', 'Dago, Bandung', 'Aktif'),
(4, NULL, 400, 400, '2026-02-01 00:00:00', '2026-07-01 00:00:00', 'Ciumbuleuit, Bandung', 'Aktif'),
(5, NULL, 300, 300, '2026-02-01 00:00:00', '2026-07-01 00:00:00', 'Pusat Kota Bandung', 'Aktif'),
(6, NULL, 150, 150, '2026-02-01 00:00:00', '2026-07-01 00:00:00', 'Tangkuban Perahu, Bandung', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `ms_stokracepack`
--

CREATE TABLE `ms_stokracepack` (
  `StokID` int(11) NOT NULL,
  `ItemID` int(11) DEFAULT NULL,
  `Ukuran` varchar(10) DEFAULT NULL,
  `JumlahStok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ms_stokracepack`
--

INSERT INTO `ms_stokracepack` (`StokID`, `ItemID`, `Ukuran`, `JumlahStok`) VALUES
(1, 1, 'S', 250),
(2, 1, 'M', 350),
(3, 1, 'L', 300),
(4, 1, 'XL', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tr_aktivitaslogin`
--

CREATE TABLE `tr_aktivitaslogin` (
  `LoginID` int(11) NOT NULL,
  `PenggunaID` int(11) DEFAULT NULL,
  `IPAddress` varchar(45) DEFAULT NULL,
  `WaktuLogin` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_detailpilihanpeserta`
--

CREATE TABLE `tr_detailpilihanpeserta` (
  `PilihanID` int(11) NOT NULL,
  `PendaftaranID` int(11) DEFAULT NULL,
  `SponsorID` int(11) DEFAULT NULL,
  `JenisPilihan` varchar(100) DEFAULT NULL,
  `NilaiPilihan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_galleryevent`
--

CREATE TABLE `tr_galleryevent` (
  `PhotoID` int(11) NOT NULL,
  `EventID` int(11) DEFAULT NULL,
  `Caption` varchar(255) DEFAULT NULL,
  `FilePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_hasillomba`
--

CREATE TABLE `tr_hasillomba` (
  `HasilID` int(11) NOT NULL,
  `PendaftaranID` int(11) DEFAULT NULL,
  `WaktuFinish` time DEFAULT NULL,
  `PeringkatUmum` int(11) DEFAULT NULL,
  `StatusHasil` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_logaktivitassistem`
--

CREATE TABLE `tr_logaktivitassistem` (
  `LogID` int(11) NOT NULL,
  `PenggunaID` int(11) DEFAULT NULL,
  `TipeAktivitas` varchar(50) DEFAULT NULL,
  `DetailAktivitas` text DEFAULT NULL,
  `WaktuLog` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_pembayaran`
--

CREATE TABLE `tr_pembayaran` (
  `PembayaranID` int(11) NOT NULL,
  `PendaftaranID` int(11) DEFAULT NULL,
  `MetodeID` int(11) DEFAULT NULL,
  `NominalBayar` decimal(15,2) DEFAULT NULL,
  `StatusPembayaran` varchar(50) DEFAULT NULL,
  `TanggalBayar` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_pendaftaran`
--

CREATE TABLE `tr_pendaftaran` (
  `PendaftaranID` int(11) NOT NULL,
  `PenggunaID` int(11) DEFAULT NULL,
  `KategoriID` int(11) DEFAULT NULL,
  `StatusPendaftaran` varchar(50) DEFAULT NULL,
  `TanggalPendaftaran` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `tr_pendaftaran`
--
DELIMITER $$
CREATE TRIGGER `trg_after_pendaftaran_insert` AFTER INSERT ON `tr_pendaftaran` FOR EACH ROW BEGIN
    -- Mengurangi kuota pada kategori yang dipilih peserta
    UPDATE ms_slotkategori 
    SET KuotaTersisa = KuotaTersisa - 1
    WHERE KategoriID = NEW.KategoriID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_backup_pendaftaran_deleted` BEFORE DELETE ON `tr_pendaftaran` FOR EACH ROW BEGIN
    INSERT INTO ms_backuplog (Aktivitas, DataLama, WaktuBackup)
    VALUES (
        'DELETE_PENDAFTARAN', 
        CONCAT('Pendaftaran ID: ', OLD.PendaftaranID, ' dihapus.'), 
        NOW()
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_validasi_pendaftaran_umur` BEFORE INSERT ON `tr_pendaftaran` FOR EACH ROW BEGIN
    DECLARE v_usia_peserta INT;
    DECLARE v_usia_min INT;
    DECLARE v_usia_max INT;

    -- Perbaikan: Menggunakan PenggunaID karena PesertaID tidak ada di tr_pendaftaran
    -- Mengambil data usia dari tabel tr_peserta berdasarkan PenggunaID yang mendaftar
    SELECT TIMESTAMPDIFF(YEAR, TanggalLahir, CURDATE()) INTO v_usia_peserta 
    FROM tr_peserta 
    WHERE PenggunaID = NEW.PenggunaID;

    -- Mengambil batas usia dari master kategori lomba
    SELECT BatasUsiaMin, BatasUsiaMax INTO v_usia_min, v_usia_max 
    FROM ms_kategorilomba 
    WHERE KategoriID = NEW.KategoriID;

    -- Melakukan validasi kesesuaian umur
    IF v_usia_peserta < v_usia_min OR v_usia_peserta > v_usia_max THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Maaf, usia Anda tidak memenuhi syarat untuk kategori lomba ini.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tr_pengguna`
--

CREATE TABLE `tr_pengguna` (
  `PenggunaID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `NamaLengkap` varchar(150) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `PeranID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tr_pengguna`
--

INSERT INTO `tr_pengguna` (`PenggunaID`, `Username`, `Email`, `NamaLengkap`, `Password`, `PeranID`) VALUES
(1, 'admin_utama', 'admin@bandungrun.com', 'Super Admin Bandung Run', 'admin123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_pengirimannotifikasi`
--

CREATE TABLE `tr_pengirimannotifikasi` (
  `KirimID` int(11) NOT NULL,
  `NotifikasiID` int(11) DEFAULT NULL,
  `PenggunaTargetID` int(11) DEFAULT NULL,
  `WaktuKirim` datetime DEFAULT current_timestamp(),
  `StatusKirim` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_peringkatkelompokusia`
--

CREATE TABLE `tr_peringkatkelompokusia` (
  `PeringkatUsiaID` int(11) NOT NULL,
  `EventID` int(11) DEFAULT NULL,
  `HasilID` int(11) DEFAULT NULL,
  `KelompokUsia` varchar(50) DEFAULT NULL,
  `PeringkatKelompok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_pesankontak`
--

CREATE TABLE `tr_pesankontak` (
  `PesanID` int(11) NOT NULL,
  `NamaPengirim` varchar(100) DEFAULT NULL,
  `EmailPengirim` varchar(100) DEFAULT NULL,
  `Subjek` varchar(150) DEFAULT NULL,
  `IsiPesan` text DEFAULT NULL,
  `TanggalKirim` datetime DEFAULT current_timestamp(),
  `StatusBaca` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_peserta`
--

CREATE TABLE `tr_peserta` (
  `PesertaID` int(11) NOT NULL,
  `PendaftaranID` int(11) DEFAULT NULL,
  `JenisKelamin` enum('L','P') DEFAULT NULL,
  `TanggalLahir` date DEFAULT NULL,
  `NomorTelepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_racepackdetailpeserta`
--

CREATE TABLE `tr_racepackdetailpeserta` (
  `RacePackPesertaID` int(11) NOT NULL,
  `PendaftaranID` int(11) DEFAULT NULL,
  `NomorBIB` varchar(20) DEFAULT NULL,
  `ChipTimerID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_racepackdistribusi`
--

CREATE TABLE `tr_racepackdistribusi` (
  `DistribusiID` int(11) NOT NULL,
  `PendaftaranID` int(11) DEFAULT NULL,
  `PetugasID` int(11) DEFAULT NULL,
  `StatusPengambilan` varchar(50) DEFAULT NULL,
  `TanggalPengambilan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_sertifikat`
--

CREATE TABLE `tr_sertifikat` (
  `SertifikatID` int(11) NOT NULL,
  `PendaftaranID` int(11) DEFAULT NULL,
  `NomorSertifikat` varchar(100) DEFAULT NULL,
  `FilePathPdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_sponsor`
--

CREATE TABLE `tr_sponsor` (
  `SponsorID` int(11) NOT NULL,
  `EventID` int(11) DEFAULT NULL,
  `NamaSponsor` varchar(150) DEFAULT NULL,
  `TingkatSponsor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tr_sponsor`
--

INSERT INTO `tr_sponsor` (`SponsorID`, `EventID`, `NamaSponsor`, `TingkatSponsor`) VALUES
(1, 1, 'Bank Mandiri', 'Platinum'),
(2, 1, 'Pocari Sweat', 'Gold'),
(3, 1, 'Adidas Indonesia', 'Gold'),
(4, 1, 'Indofood', 'Silver'),
(5, 1, 'Grab Indonesia', 'Transport Partner');

-- --------------------------------------------------------

--
-- Table structure for table `tr_verifikasipembayaran`
--

CREATE TABLE `tr_verifikasipembayaran` (
  `VerifikasiID` int(11) NOT NULL,
  `PembayaranID` int(11) DEFAULT NULL,
  `PanitiaID` int(11) DEFAULT NULL,
  `StatusVerifikasi` varchar(50) DEFAULT NULL,
  `WaktuVerifikasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `tr_verifikasipembayaran`
--
DELIMITER $$
CREATE TRIGGER `trg_verifikasi_to_logistik` AFTER UPDATE ON `tr_verifikasipembayaran` FOR EACH ROW BEGIN
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
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_aktivitas_terbaru`
-- (See below for the actual view)
--
CREATE TABLE `v_aktivitas_terbaru` (
`NamaLengkap` varchar(150)
,`Aktivitas` varchar(15)
,`Waktu` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_audit_sistem`
-- (See below for the actual view)
--
CREATE TABLE `v_audit_sistem` (
`LogID` int(11)
,`Username` varchar(50)
,`TipeAktivitas` varchar(50)
,`DetailAktivitas` text
,`WaktuLog` datetime
,`StatusBackup` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_cek_sertifikat`
-- (See below for the actual view)
--
CREATE TABLE `v_cek_sertifikat` (
`NamaLengkap` varchar(150)
,`NamaEvent` varchar(255)
,`NomorSertifikat` varchar(100)
,`FilePathPdf` varchar(255)
,`WaktuFinish` time
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_data_pendaftaran`
-- (See below for the actual view)
--
CREATE TABLE `v_data_pendaftaran` (
`PendaftaranID` int(11)
,`NamaLengkap` varchar(150)
,`NamaEvent` varchar(255)
,`NamaKategori` varchar(100)
,`StatusPendaftaran` varchar(50)
,`TanggalPendaftaran` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_identitas_event_medsos`
-- (See below for the actual view)
--
CREATE TABLE `v_identitas_event_medsos` (
`EventID` int(11)
,`NamaEvent` varchar(255)
,`NamaPlatform` varchar(50)
,`URLAkun` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_jadwal_slot_lengkap`
-- (See below for the actual view)
--
CREATE TABLE `v_jadwal_slot_lengkap` (
`NamaEvent` varchar(255)
,`JenisJadwal` varchar(100)
,`WaktuJadwal` datetime
,`NamaKategori` varchar(100)
,`KuotaTersisa` int(11)
,`TanggalMulai` datetime
,`TanggalSelesai` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_katalog_event`
-- (See below for the actual view)
--
CREATE TABLE `v_katalog_event` (
`EventID` int(11)
,`NamaEvent` varchar(255)
,`NamaKategori` varchar(100)
,`Jarak` varchar(20)
,`KuotaTersisa` int(11)
,`Harga` decimal(15,2)
,`LokasiEvent` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_keamanan_akses`
-- (See below for the actual view)
--
CREATE TABLE `v_keamanan_akses` (
`Username` varchar(50)
,`IPAddress` varchar(45)
,`WaktuLogin` datetime
,`TokenExpired` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_konfirmasi_pembayaran`
-- (See below for the actual view)
--
CREATE TABLE `v_konfirmasi_pembayaran` (
`PembayaranID` int(11)
,`PendaftaranID` int(11)
,`NamaLengkap` varchar(150)
,`NamaMetode` varchar(100)
,`NominalBayar` decimal(15,2)
,`StatusPembayaran` varchar(50)
,`StatusVerifikasi` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_leaderboard`
-- (See below for the actual view)
--
CREATE TABLE `v_leaderboard` (
`PeringkatUmum` int(11)
,`NamaLengkap` varchar(150)
,`NamaKategori` varchar(100)
,`WaktuFinish` time
,`KelompokUsia` varchar(50)
,`PeringkatKelompok` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_logistik_racepack`
-- (See below for the actual view)
--
CREATE TABLE `v_logistik_racepack` (
`PendaftaranID` int(11)
,`NamaLengkap` varchar(150)
,`NomorBIB` varchar(20)
,`ChipTimerID` varchar(50)
,`StatusPengambilan` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_monitoring_stok_rp`
-- (See below for the actual view)
--
CREATE TABLE `v_monitoring_stok_rp` (
`NamaItem` varchar(100)
,`Ukuran` varchar(10)
,`JumlahStok` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_profil_pengguna`
-- (See below for the actual view)
--
CREATE TABLE `v_profil_pengguna` (
`PenggunaID` int(11)
,`Username` varchar(50)
,`Email` varchar(100)
,`NamaLengkap` varchar(150)
,`NamaPeran` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_rekap_keuangan_event`
-- (See below for the actual view)
--
CREATE TABLE `v_rekap_keuangan_event` (
`NamaEvent` varchar(255)
,`Total_Pendaftar` bigint(21)
,`Total_Pendapatan` decimal(37,2)
,`Jumlah_Lunas` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_rekap_sponsor_peserta`
-- (See below for the actual view)
--
CREATE TABLE `v_rekap_sponsor_peserta` (
`NamaSponsor` varchar(150)
,`TingkatSponsor` varchar(50)
,`NamaPeserta` varchar(150)
,`JenisPilihan` varchar(100)
,`NilaiPilihan` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_riwayat_notifikasi`
-- (See below for the actual view)
--
CREATE TABLE `v_riwayat_notifikasi` (
`KirimID` int(11)
,`Penerima` varchar(150)
,`JudulNotifikasi` varchar(150)
,`TipeNotifikasi` varchar(50)
,`WaktuKirim` datetime
,`StatusKirim` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_statistik_admin`
-- (See below for the actual view)
--
CREATE TABLE `v_statistik_admin` (
`Total_Event` bigint(21)
,`Total_Pendaftar` bigint(21)
,`Total_Pendapatan` decimal(37,2)
,`Total_User` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_timeline_aktivitas`
-- (See below for the actual view)
--
CREATE TABLE `v_timeline_aktivitas` (
`NamaLengkap` varchar(150)
,`Tipe_Aktivitas` varchar(16)
,`Waktu` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_verifikasi_dokumen`
-- (See below for the actual view)
--
CREATE TABLE `v_verifikasi_dokumen` (
`DokumenID` int(11)
,`PendaftaranID` int(11)
,`NamaLengkap` varchar(150)
,`NamaDokumen` varchar(150)
,`Wajib` tinyint(1)
);

-- --------------------------------------------------------

--
-- Structure for view `v_aktivitas_terbaru`
--
DROP TABLE IF EXISTS `v_aktivitas_terbaru`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_aktivitas_terbaru`  AS SELECT `u`.`NamaLengkap` AS `NamaLengkap`, 'Login' AS `Aktivitas`, `a`.`WaktuLogin` AS `Waktu` FROM (`tr_aktivitaslogin` `a` join `tr_pengguna` `u` on(`a`.`PenggunaID` = `u`.`PenggunaID`))union all select `u`.`NamaLengkap` AS `NamaLengkap`,'Mendaftar Event' AS `Aktivitas`,`p`.`TanggalPendaftaran` AS `Waktu` from (`tr_pendaftaran` `p` join `tr_pengguna` `u` on(`p`.`PenggunaID` = `u`.`PenggunaID`)) order by `Waktu` desc  ;

-- --------------------------------------------------------

--
-- Structure for view `v_audit_sistem`
--
DROP TABLE IF EXISTS `v_audit_sistem`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_audit_sistem`  AS SELECT `l`.`LogID` AS `LogID`, `u`.`Username` AS `Username`, `l`.`TipeAktivitas` AS `TipeAktivitas`, `l`.`DetailAktivitas` AS `DetailAktivitas`, `l`.`WaktuLog` AS `WaktuLog`, `b`.`StatusBackup` AS `StatusBackup` FROM ((`tr_logaktivitassistem` `l` join `tr_pengguna` `u` on(`l`.`PenggunaID` = `u`.`PenggunaID`)) left join `ms_backuplog` `b` on(`u`.`PenggunaID` = `b`.`AdminID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_cek_sertifikat`
--
DROP TABLE IF EXISTS `v_cek_sertifikat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_cek_sertifikat`  AS SELECT `u`.`NamaLengkap` AS `NamaLengkap`, `e`.`NamaEvent` AS `NamaEvent`, `s`.`NomorSertifikat` AS `NomorSertifikat`, `s`.`FilePathPdf` AS `FilePathPdf`, `h`.`WaktuFinish` AS `WaktuFinish` FROM (((((`tr_sertifikat` `s` join `tr_pendaftaran` `p` on(`s`.`PendaftaranID` = `p`.`PendaftaranID`)) join `tr_pengguna` `u` on(`p`.`PenggunaID` = `u`.`PenggunaID`)) join `tr_hasillomba` `h` on(`p`.`PendaftaranID` = `h`.`PendaftaranID`)) join `ms_kategorilomba` `k` on(`p`.`KategoriID` = `k`.`KategoriID`)) join `ms_event` `e` on(`k`.`EventID` = `e`.`EventID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_data_pendaftaran`
--
DROP TABLE IF EXISTS `v_data_pendaftaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_data_pendaftaran`  AS SELECT `p`.`PendaftaranID` AS `PendaftaranID`, `u`.`NamaLengkap` AS `NamaLengkap`, `e`.`NamaEvent` AS `NamaEvent`, `k`.`NamaKategori` AS `NamaKategori`, `p`.`StatusPendaftaran` AS `StatusPendaftaran`, `p`.`TanggalPendaftaran` AS `TanggalPendaftaran` FROM (((`tr_pendaftaran` `p` join `tr_pengguna` `u` on(`p`.`PenggunaID` = `u`.`PenggunaID`)) join `ms_kategorilomba` `k` on(`p`.`KategoriID` = `k`.`KategoriID`)) join `ms_event` `e` on(`k`.`EventID` = `e`.`EventID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_identitas_event_medsos`
--
DROP TABLE IF EXISTS `v_identitas_event_medsos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_identitas_event_medsos`  AS SELECT `e`.`EventID` AS `EventID`, `e`.`NamaEvent` AS `NamaEvent`, `m`.`NamaPlatform` AS `NamaPlatform`, `m`.`URLAkun` AS `URLAkun` FROM (`ms_event` `e` left join `ms_mediasosialevent` `m` on(`e`.`EventID` = `m`.`EventID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_jadwal_slot_lengkap`
--
DROP TABLE IF EXISTS `v_jadwal_slot_lengkap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jadwal_slot_lengkap`  AS SELECT `e`.`NamaEvent` AS `NamaEvent`, `j`.`JenisJadwal` AS `JenisJadwal`, `j`.`WaktuJadwal` AS `WaktuJadwal`, `k`.`NamaKategori` AS `NamaKategori`, `s`.`KuotaTersisa` AS `KuotaTersisa`, `s`.`TanggalMulai` AS `TanggalMulai`, `s`.`TanggalSelesai` AS `TanggalSelesai` FROM (((`ms_event` `e` join `ms_jadwalevent` `j` on(`e`.`EventID` = `j`.`EventID`)) join `ms_kategorilomba` `k` on(`e`.`EventID` = `k`.`EventID`)) join `ms_slotkategori` `s` on(`k`.`KategoriID` = `s`.`KategoriID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_katalog_event`
--
DROP TABLE IF EXISTS `v_katalog_event`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_katalog_event`  AS SELECT `e`.`EventID` AS `EventID`, `e`.`NamaEvent` AS `NamaEvent`, `k`.`NamaKategori` AS `NamaKategori`, `k`.`Jarak` AS `Jarak`, `s`.`KuotaTersisa` AS `KuotaTersisa`, `b`.`Nominal` AS `Harga`, `s`.`LokasiEvent` AS `LokasiEvent` FROM (((`ms_event` `e` join `ms_kategorilomba` `k` on(`e`.`EventID` = `k`.`EventID`)) join `ms_slotkategori` `s` on(`k`.`KategoriID` = `s`.`KategoriID`)) join `ms_biayakategori` `b` on(`k`.`KategoriID` = `b`.`KategoriID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_keamanan_akses`
--
DROP TABLE IF EXISTS `v_keamanan_akses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_keamanan_akses`  AS SELECT `u`.`Username` AS `Username`, `al`.`IPAddress` AS `IPAddress`, `al`.`WaktuLogin` AS `WaktuLogin`, `t`.`WaktuExpired` AS `TokenExpired` FROM ((`tr_pengguna` `u` left join `tr_aktivitaslogin` `al` on(`u`.`PenggunaID` = `al`.`PenggunaID`)) left join `ms_resetpasswordtoken` `t` on(`u`.`PenggunaID` = `t`.`PenggunaID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_konfirmasi_pembayaran`
--
DROP TABLE IF EXISTS `v_konfirmasi_pembayaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_konfirmasi_pembayaran`  AS SELECT `py`.`PembayaranID` AS `PembayaranID`, `p`.`PendaftaranID` AS `PendaftaranID`, `u`.`NamaLengkap` AS `NamaLengkap`, `m`.`NamaMetode` AS `NamaMetode`, `py`.`NominalBayar` AS `NominalBayar`, `py`.`StatusPembayaran` AS `StatusPembayaran`, `v`.`StatusVerifikasi` AS `StatusVerifikasi` FROM ((((`tr_pembayaran` `py` join `tr_pendaftaran` `p` on(`py`.`PendaftaranID` = `p`.`PendaftaranID`)) join `tr_pengguna` `u` on(`p`.`PenggunaID` = `u`.`PenggunaID`)) join `ms_metodepembayaran` `m` on(`py`.`MetodeID` = `m`.`MetodeID`)) left join `tr_verifikasipembayaran` `v` on(`py`.`PembayaranID` = `v`.`PembayaranID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_leaderboard`
--
DROP TABLE IF EXISTS `v_leaderboard`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_leaderboard`  AS SELECT `h`.`PeringkatUmum` AS `PeringkatUmum`, `u`.`NamaLengkap` AS `NamaLengkap`, `k`.`NamaKategori` AS `NamaKategori`, `h`.`WaktuFinish` AS `WaktuFinish`, `pu`.`KelompokUsia` AS `KelompokUsia`, `pu`.`PeringkatKelompok` AS `PeringkatKelompok` FROM ((((`tr_hasillomba` `h` join `tr_pendaftaran` `p` on(`h`.`PendaftaranID` = `p`.`PendaftaranID`)) join `tr_pengguna` `u` on(`p`.`PenggunaID` = `u`.`PenggunaID`)) join `ms_kategorilomba` `k` on(`p`.`KategoriID` = `k`.`KategoriID`)) left join `tr_peringkatkelompokusia` `pu` on(`h`.`HasilID` = `pu`.`HasilID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_logistik_racepack`
--
DROP TABLE IF EXISTS `v_logistik_racepack`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_logistik_racepack`  AS SELECT `p`.`PendaftaranID` AS `PendaftaranID`, `u`.`NamaLengkap` AS `NamaLengkap`, `d`.`NomorBIB` AS `NomorBIB`, `d`.`ChipTimerID` AS `ChipTimerID`, `rs`.`StatusPengambilan` AS `StatusPengambilan` FROM (((`tr_pendaftaran` `p` join `tr_pengguna` `u` on(`p`.`PenggunaID` = `u`.`PenggunaID`)) join `tr_racepackdetailpeserta` `d` on(`p`.`PendaftaranID` = `d`.`PendaftaranID`)) left join `tr_racepackdistribusi` `rs` on(`p`.`PendaftaranID` = `rs`.`PendaftaranID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_monitoring_stok_rp`
--
DROP TABLE IF EXISTS `v_monitoring_stok_rp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_monitoring_stok_rp`  AS SELECT `i`.`NamaItem` AS `NamaItem`, `s`.`Ukuran` AS `Ukuran`, `s`.`JumlahStok` AS `JumlahStok` FROM (`ms_racepackitem` `i` join `ms_stokracepack` `s` on(`i`.`ItemID` = `s`.`ItemID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_profil_pengguna`
--
DROP TABLE IF EXISTS `v_profil_pengguna`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_profil_pengguna`  AS SELECT `p`.`PenggunaID` AS `PenggunaID`, `p`.`Username` AS `Username`, `p`.`Email` AS `Email`, `p`.`NamaLengkap` AS `NamaLengkap`, `r`.`NamaPeran` AS `NamaPeran` FROM (`tr_pengguna` `p` join `ms_peran` `r` on(`p`.`PeranID` = `r`.`PeranID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_rekap_keuangan_event`
--
DROP TABLE IF EXISTS `v_rekap_keuangan_event`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_rekap_keuangan_event`  AS SELECT `e`.`NamaEvent` AS `NamaEvent`, count(`p`.`PendaftaranID`) AS `Total_Pendaftar`, sum(`py`.`NominalBayar`) AS `Total_Pendapatan`, count(case when `py`.`StatusPembayaran` = 'Lunas' then 1 end) AS `Jumlah_Lunas` FROM (((`ms_event` `e` join `ms_kategorilomba` `k` on(`e`.`EventID` = `k`.`EventID`)) join `tr_pendaftaran` `p` on(`k`.`KategoriID` = `p`.`KategoriID`)) left join `tr_pembayaran` `py` on(`p`.`PendaftaranID` = `py`.`PendaftaranID`)) GROUP BY `e`.`EventID` ;

-- --------------------------------------------------------

--
-- Structure for view `v_rekap_sponsor_peserta`
--
DROP TABLE IF EXISTS `v_rekap_sponsor_peserta`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_rekap_sponsor_peserta`  AS SELECT `s`.`NamaSponsor` AS `NamaSponsor`, `s`.`TingkatSponsor` AS `TingkatSponsor`, `u`.`NamaLengkap` AS `NamaPeserta`, `dp`.`JenisPilihan` AS `JenisPilihan`, `dp`.`NilaiPilihan` AS `NilaiPilihan` FROM (((`tr_sponsor` `s` join `tr_detailpilihanpeserta` `dp` on(`s`.`SponsorID` = `dp`.`SponsorID`)) join `tr_pendaftaran` `p` on(`dp`.`PendaftaranID` = `p`.`PendaftaranID`)) join `tr_pengguna` `u` on(`p`.`PenggunaID` = `u`.`PenggunaID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_riwayat_notifikasi`
--
DROP TABLE IF EXISTS `v_riwayat_notifikasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_riwayat_notifikasi`  AS SELECT `kn`.`KirimID` AS `KirimID`, `u`.`NamaLengkap` AS `Penerima`, `n`.`JudulNotifikasi` AS `JudulNotifikasi`, `n`.`TipeNotifikasi` AS `TipeNotifikasi`, `kn`.`WaktuKirim` AS `WaktuKirim`, `kn`.`StatusKirim` AS `StatusKirim` FROM ((`tr_pengirimannotifikasi` `kn` join `ms_notifikasi` `n` on(`kn`.`NotifikasiID` = `n`.`NotifikasiID`)) join `tr_pengguna` `u` on(`kn`.`PenggunaTargetID` = `u`.`PenggunaID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_statistik_admin`
--
DROP TABLE IF EXISTS `v_statistik_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_statistik_admin`  AS SELECT (select count(0) from `ms_event`) AS `Total_Event`, (select count(0) from `tr_pendaftaran`) AS `Total_Pendaftar`, (select sum(`tr_pembayaran`.`NominalBayar`) from `tr_pembayaran` where `tr_pembayaran`.`StatusPembayaran` = 'Lunas') AS `Total_Pendapatan`, (select count(0) from `tr_pengguna`) AS `Total_User` ;

-- --------------------------------------------------------

--
-- Structure for view `v_timeline_aktivitas`
--
DROP TABLE IF EXISTS `v_timeline_aktivitas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_timeline_aktivitas`  AS SELECT `u`.`NamaLengkap` AS `NamaLengkap`, 'Pendaftaran Baru' AS `Tipe_Aktivitas`, `p`.`TanggalPendaftaran` AS `Waktu` FROM (`tr_pendaftaran` `p` join `tr_pengguna` `u` on(`p`.`PenggunaID` = `u`.`PenggunaID`))union all select `u`.`NamaLengkap` AS `NamaLengkap`,'Login' AS `Tipe_Aktivitas`,`l`.`WaktuLogin` AS `Waktu` from (`tr_aktivitaslogin` `l` join `tr_pengguna` `u` on(`l`.`PenggunaID` = `u`.`PenggunaID`)) order by `Waktu` desc  ;

-- --------------------------------------------------------

--
-- Structure for view `v_verifikasi_dokumen`
--
DROP TABLE IF EXISTS `v_verifikasi_dokumen`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_verifikasi_dokumen`  AS SELECT `d`.`DokumenID` AS `DokumenID`, `p`.`PendaftaranID` AS `PendaftaranID`, `u`.`NamaLengkap` AS `NamaLengkap`, `d`.`NamaDokumen` AS `NamaDokumen`, `d`.`Wajib` AS `Wajib` FROM ((`ms_dokumenpendukung` `d` join `tr_pendaftaran` `p` on(`d`.`PendaftaranID` = `p`.`PendaftaranID`)) join `tr_pengguna` `u` on(`p`.`PenggunaID` = `u`.`PenggunaID`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ms_backuplog`
--
ALTER TABLE `ms_backuplog`
  ADD PRIMARY KEY (`BackupID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `ms_biayakategori`
--
ALTER TABLE `ms_biayakategori`
  ADD PRIMARY KEY (`BiayaID`),
  ADD KEY `KategoriID` (`KategoriID`);

--
-- Indexes for table `ms_dokumenpendukung`
--
ALTER TABLE `ms_dokumenpendukung`
  ADD PRIMARY KEY (`DokumenID`),
  ADD KEY `PendaftaranID` (`PendaftaranID`);

--
-- Indexes for table `ms_event`
--
ALTER TABLE `ms_event`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `ms_faq`
--
ALTER TABLE `ms_faq`
  ADD PRIMARY KEY (`FaqID`);

--
-- Indexes for table `ms_halamanweb`
--
ALTER TABLE `ms_halamanweb`
  ADD PRIMARY KEY (`HalamanID`),
  ADD UNIQUE KEY `Slug` (`Slug`);

--
-- Indexes for table `ms_jadwalevent`
--
ALTER TABLE `ms_jadwalevent`
  ADD PRIMARY KEY (`JadwalID`),
  ADD KEY `EventID` (`EventID`);

--
-- Indexes for table `ms_kategorilomba`
--
ALTER TABLE `ms_kategorilomba`
  ADD PRIMARY KEY (`KategoriID`),
  ADD KEY `EventID` (`EventID`);

--
-- Indexes for table `ms_mediasosialevent`
--
ALTER TABLE `ms_mediasosialevent`
  ADD PRIMARY KEY (`MedsosID`),
  ADD KEY `EventID` (`EventID`);

--
-- Indexes for table `ms_metodepembayaran`
--
ALTER TABLE `ms_metodepembayaran`
  ADD PRIMARY KEY (`MetodeID`);

--
-- Indexes for table `ms_notifikasi`
--
ALTER TABLE `ms_notifikasi`
  ADD PRIMARY KEY (`NotifikasiID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `ms_pengaturanuser`
--
ALTER TABLE `ms_pengaturanuser`
  ADD PRIMARY KEY (`PengaturanID`);

--
-- Indexes for table `ms_peran`
--
ALTER TABLE `ms_peran`
  ADD PRIMARY KEY (`PeranID`);

--
-- Indexes for table `ms_racepackitem`
--
ALTER TABLE `ms_racepackitem`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `ms_resetpasswordtoken`
--
ALTER TABLE `ms_resetpasswordtoken`
  ADD PRIMARY KEY (`TokenID`),
  ADD KEY `PenggunaID` (`PenggunaID`);

--
-- Indexes for table `ms_slotkategori`
--
ALTER TABLE `ms_slotkategori`
  ADD PRIMARY KEY (`SlotID`),
  ADD KEY `KategoriID` (`KategoriID`);

--
-- Indexes for table `ms_stokracepack`
--
ALTER TABLE `ms_stokracepack`
  ADD PRIMARY KEY (`StokID`),
  ADD KEY `ItemID` (`ItemID`);

--
-- Indexes for table `tr_aktivitaslogin`
--
ALTER TABLE `tr_aktivitaslogin`
  ADD PRIMARY KEY (`LoginID`),
  ADD KEY `PenggunaID` (`PenggunaID`);

--
-- Indexes for table `tr_detailpilihanpeserta`
--
ALTER TABLE `tr_detailpilihanpeserta`
  ADD PRIMARY KEY (`PilihanID`),
  ADD KEY `PendaftaranID` (`PendaftaranID`),
  ADD KEY `SponsorID` (`SponsorID`);

--
-- Indexes for table `tr_galleryevent`
--
ALTER TABLE `tr_galleryevent`
  ADD PRIMARY KEY (`PhotoID`),
  ADD KEY `EventID` (`EventID`);

--
-- Indexes for table `tr_hasillomba`
--
ALTER TABLE `tr_hasillomba`
  ADD PRIMARY KEY (`HasilID`),
  ADD KEY `PendaftaranID` (`PendaftaranID`);

--
-- Indexes for table `tr_logaktivitassistem`
--
ALTER TABLE `tr_logaktivitassistem`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `PenggunaID` (`PenggunaID`);

--
-- Indexes for table `tr_pembayaran`
--
ALTER TABLE `tr_pembayaran`
  ADD PRIMARY KEY (`PembayaranID`),
  ADD KEY `PendaftaranID` (`PendaftaranID`),
  ADD KEY `MetodeID` (`MetodeID`);

--
-- Indexes for table `tr_pendaftaran`
--
ALTER TABLE `tr_pendaftaran`
  ADD PRIMARY KEY (`PendaftaranID`),
  ADD KEY `PenggunaID` (`PenggunaID`),
  ADD KEY `KategoriID` (`KategoriID`);

--
-- Indexes for table `tr_pengguna`
--
ALTER TABLE `tr_pengguna`
  ADD PRIMARY KEY (`PenggunaID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `PeranID` (`PeranID`);

--
-- Indexes for table `tr_pengirimannotifikasi`
--
ALTER TABLE `tr_pengirimannotifikasi`
  ADD PRIMARY KEY (`KirimID`),
  ADD KEY `NotifikasiID` (`NotifikasiID`),
  ADD KEY `PenggunaTargetID` (`PenggunaTargetID`);

--
-- Indexes for table `tr_peringkatkelompokusia`
--
ALTER TABLE `tr_peringkatkelompokusia`
  ADD PRIMARY KEY (`PeringkatUsiaID`),
  ADD KEY `EventID` (`EventID`),
  ADD KEY `HasilID` (`HasilID`);

--
-- Indexes for table `tr_pesankontak`
--
ALTER TABLE `tr_pesankontak`
  ADD PRIMARY KEY (`PesanID`);

--
-- Indexes for table `tr_peserta`
--
ALTER TABLE `tr_peserta`
  ADD PRIMARY KEY (`PesertaID`),
  ADD KEY `PendaftaranID` (`PendaftaranID`);

--
-- Indexes for table `tr_racepackdetailpeserta`
--
ALTER TABLE `tr_racepackdetailpeserta`
  ADD PRIMARY KEY (`RacePackPesertaID`),
  ADD KEY `PendaftaranID` (`PendaftaranID`);

--
-- Indexes for table `tr_racepackdistribusi`
--
ALTER TABLE `tr_racepackdistribusi`
  ADD PRIMARY KEY (`DistribusiID`),
  ADD KEY `PendaftaranID` (`PendaftaranID`),
  ADD KEY `PetugasID` (`PetugasID`);

--
-- Indexes for table `tr_sertifikat`
--
ALTER TABLE `tr_sertifikat`
  ADD PRIMARY KEY (`SertifikatID`),
  ADD KEY `PendaftaranID` (`PendaftaranID`);

--
-- Indexes for table `tr_sponsor`
--
ALTER TABLE `tr_sponsor`
  ADD PRIMARY KEY (`SponsorID`),
  ADD KEY `EventID` (`EventID`);

--
-- Indexes for table `tr_verifikasipembayaran`
--
ALTER TABLE `tr_verifikasipembayaran`
  ADD PRIMARY KEY (`VerifikasiID`),
  ADD KEY `PembayaranID` (`PembayaranID`),
  ADD KEY `PanitiaID` (`PanitiaID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ms_backuplog`
--
ALTER TABLE `ms_backuplog`
  MODIFY `BackupID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ms_biayakategori`
--
ALTER TABLE `ms_biayakategori`
  MODIFY `BiayaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ms_dokumenpendukung`
--
ALTER TABLE `ms_dokumenpendukung`
  MODIFY `DokumenID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ms_event`
--
ALTER TABLE `ms_event`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ms_faq`
--
ALTER TABLE `ms_faq`
  MODIFY `FaqID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ms_halamanweb`
--
ALTER TABLE `ms_halamanweb`
  MODIFY `HalamanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ms_jadwalevent`
--
ALTER TABLE `ms_jadwalevent`
  MODIFY `JadwalID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ms_kategorilomba`
--
ALTER TABLE `ms_kategorilomba`
  MODIFY `KategoriID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ms_mediasosialevent`
--
ALTER TABLE `ms_mediasosialevent`
  MODIFY `MedsosID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ms_metodepembayaran`
--
ALTER TABLE `ms_metodepembayaran`
  MODIFY `MetodeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ms_notifikasi`
--
ALTER TABLE `ms_notifikasi`
  MODIFY `NotifikasiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ms_pengaturanuser`
--
ALTER TABLE `ms_pengaturanuser`
  MODIFY `PengaturanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ms_peran`
--
ALTER TABLE `ms_peran`
  MODIFY `PeranID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ms_racepackitem`
--
ALTER TABLE `ms_racepackitem`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ms_resetpasswordtoken`
--
ALTER TABLE `ms_resetpasswordtoken`
  MODIFY `TokenID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ms_slotkategori`
--
ALTER TABLE `ms_slotkategori`
  MODIFY `SlotID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ms_stokracepack`
--
ALTER TABLE `ms_stokracepack`
  MODIFY `StokID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tr_aktivitaslogin`
--
ALTER TABLE `tr_aktivitaslogin`
  MODIFY `LoginID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_detailpilihanpeserta`
--
ALTER TABLE `tr_detailpilihanpeserta`
  MODIFY `PilihanID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_galleryevent`
--
ALTER TABLE `tr_galleryevent`
  MODIFY `PhotoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_hasillomba`
--
ALTER TABLE `tr_hasillomba`
  MODIFY `HasilID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_logaktivitassistem`
--
ALTER TABLE `tr_logaktivitassistem`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_pembayaran`
--
ALTER TABLE `tr_pembayaran`
  MODIFY `PembayaranID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_pendaftaran`
--
ALTER TABLE `tr_pendaftaran`
  MODIFY `PendaftaranID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_pengguna`
--
ALTER TABLE `tr_pengguna`
  MODIFY `PenggunaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tr_pengirimannotifikasi`
--
ALTER TABLE `tr_pengirimannotifikasi`
  MODIFY `KirimID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_peringkatkelompokusia`
--
ALTER TABLE `tr_peringkatkelompokusia`
  MODIFY `PeringkatUsiaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_pesankontak`
--
ALTER TABLE `tr_pesankontak`
  MODIFY `PesanID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_peserta`
--
ALTER TABLE `tr_peserta`
  MODIFY `PesertaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_racepackdetailpeserta`
--
ALTER TABLE `tr_racepackdetailpeserta`
  MODIFY `RacePackPesertaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_racepackdistribusi`
--
ALTER TABLE `tr_racepackdistribusi`
  MODIFY `DistribusiID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_sertifikat`
--
ALTER TABLE `tr_sertifikat`
  MODIFY `SertifikatID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_sponsor`
--
ALTER TABLE `tr_sponsor`
  MODIFY `SponsorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tr_verifikasipembayaran`
--
ALTER TABLE `tr_verifikasipembayaran`
  MODIFY `VerifikasiID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ms_backuplog`
--
ALTER TABLE `ms_backuplog`
  ADD CONSTRAINT `ms_backuplog_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `tr_pengguna` (`PenggunaID`);

--
-- Constraints for table `ms_biayakategori`
--
ALTER TABLE `ms_biayakategori`
  ADD CONSTRAINT `ms_biayakategori_ibfk_1` FOREIGN KEY (`KategoriID`) REFERENCES `ms_kategorilomba` (`KategoriID`);

--
-- Constraints for table `ms_dokumenpendukung`
--
ALTER TABLE `ms_dokumenpendukung`
  ADD CONSTRAINT `ms_dokumenpendukung_ibfk_1` FOREIGN KEY (`PendaftaranID`) REFERENCES `tr_pendaftaran` (`PendaftaranID`);

--
-- Constraints for table `ms_jadwalevent`
--
ALTER TABLE `ms_jadwalevent`
  ADD CONSTRAINT `ms_jadwalevent_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `ms_event` (`EventID`);

--
-- Constraints for table `ms_kategorilomba`
--
ALTER TABLE `ms_kategorilomba`
  ADD CONSTRAINT `ms_kategorilomba_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `ms_event` (`EventID`);

--
-- Constraints for table `ms_mediasosialevent`
--
ALTER TABLE `ms_mediasosialevent`
  ADD CONSTRAINT `ms_mediasosialevent_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `ms_event` (`EventID`);

--
-- Constraints for table `ms_notifikasi`
--
ALTER TABLE `ms_notifikasi`
  ADD CONSTRAINT `ms_notifikasi_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `tr_pengguna` (`PenggunaID`);

--
-- Constraints for table `ms_resetpasswordtoken`
--
ALTER TABLE `ms_resetpasswordtoken`
  ADD CONSTRAINT `ms_resetpasswordtoken_ibfk_1` FOREIGN KEY (`PenggunaID`) REFERENCES `tr_pengguna` (`PenggunaID`);

--
-- Constraints for table `ms_slotkategori`
--
ALTER TABLE `ms_slotkategori`
  ADD CONSTRAINT `ms_slotkategori_ibfk_1` FOREIGN KEY (`KategoriID`) REFERENCES `ms_kategorilomba` (`KategoriID`);

--
-- Constraints for table `ms_stokracepack`
--
ALTER TABLE `ms_stokracepack`
  ADD CONSTRAINT `ms_stokracepack_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `ms_racepackitem` (`ItemID`);

--
-- Constraints for table `tr_aktivitaslogin`
--
ALTER TABLE `tr_aktivitaslogin`
  ADD CONSTRAINT `tr_aktivitaslogin_ibfk_1` FOREIGN KEY (`PenggunaID`) REFERENCES `tr_pengguna` (`PenggunaID`);

--
-- Constraints for table `tr_detailpilihanpeserta`
--
ALTER TABLE `tr_detailpilihanpeserta`
  ADD CONSTRAINT `tr_detailpilihanpeserta_ibfk_1` FOREIGN KEY (`PendaftaranID`) REFERENCES `tr_pendaftaran` (`PendaftaranID`),
  ADD CONSTRAINT `tr_detailpilihanpeserta_ibfk_2` FOREIGN KEY (`SponsorID`) REFERENCES `tr_sponsor` (`SponsorID`);

--
-- Constraints for table `tr_galleryevent`
--
ALTER TABLE `tr_galleryevent`
  ADD CONSTRAINT `tr_galleryevent_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `ms_event` (`EventID`);

--
-- Constraints for table `tr_hasillomba`
--
ALTER TABLE `tr_hasillomba`
  ADD CONSTRAINT `tr_hasillomba_ibfk_1` FOREIGN KEY (`PendaftaranID`) REFERENCES `tr_pendaftaran` (`PendaftaranID`);

--
-- Constraints for table `tr_logaktivitassistem`
--
ALTER TABLE `tr_logaktivitassistem`
  ADD CONSTRAINT `tr_logaktivitassistem_ibfk_1` FOREIGN KEY (`PenggunaID`) REFERENCES `tr_pengguna` (`PenggunaID`);

--
-- Constraints for table `tr_pembayaran`
--
ALTER TABLE `tr_pembayaran`
  ADD CONSTRAINT `tr_pembayaran_ibfk_1` FOREIGN KEY (`PendaftaranID`) REFERENCES `tr_pendaftaran` (`PendaftaranID`),
  ADD CONSTRAINT `tr_pembayaran_ibfk_2` FOREIGN KEY (`MetodeID`) REFERENCES `ms_metodepembayaran` (`MetodeID`);

--
-- Constraints for table `tr_pendaftaran`
--
ALTER TABLE `tr_pendaftaran`
  ADD CONSTRAINT `tr_pendaftaran_ibfk_1` FOREIGN KEY (`PenggunaID`) REFERENCES `tr_pengguna` (`PenggunaID`),
  ADD CONSTRAINT `tr_pendaftaran_ibfk_2` FOREIGN KEY (`KategoriID`) REFERENCES `ms_kategorilomba` (`KategoriID`);

--
-- Constraints for table `tr_pengguna`
--
ALTER TABLE `tr_pengguna`
  ADD CONSTRAINT `tr_pengguna_ibfk_1` FOREIGN KEY (`PeranID`) REFERENCES `ms_peran` (`PeranID`);

--
-- Constraints for table `tr_pengirimannotifikasi`
--
ALTER TABLE `tr_pengirimannotifikasi`
  ADD CONSTRAINT `tr_pengirimannotifikasi_ibfk_1` FOREIGN KEY (`NotifikasiID`) REFERENCES `ms_notifikasi` (`NotifikasiID`),
  ADD CONSTRAINT `tr_pengirimannotifikasi_ibfk_2` FOREIGN KEY (`PenggunaTargetID`) REFERENCES `tr_pengguna` (`PenggunaID`);

--
-- Constraints for table `tr_peringkatkelompokusia`
--
ALTER TABLE `tr_peringkatkelompokusia`
  ADD CONSTRAINT `tr_peringkatkelompokusia_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `ms_event` (`EventID`),
  ADD CONSTRAINT `tr_peringkatkelompokusia_ibfk_2` FOREIGN KEY (`HasilID`) REFERENCES `tr_hasillomba` (`HasilID`);

--
-- Constraints for table `tr_peserta`
--
ALTER TABLE `tr_peserta`
  ADD CONSTRAINT `tr_peserta_ibfk_1` FOREIGN KEY (`PendaftaranID`) REFERENCES `tr_pendaftaran` (`PendaftaranID`);

--
-- Constraints for table `tr_racepackdetailpeserta`
--
ALTER TABLE `tr_racepackdetailpeserta`
  ADD CONSTRAINT `tr_racepackdetailpeserta_ibfk_1` FOREIGN KEY (`PendaftaranID`) REFERENCES `tr_pendaftaran` (`PendaftaranID`);

--
-- Constraints for table `tr_racepackdistribusi`
--
ALTER TABLE `tr_racepackdistribusi`
  ADD CONSTRAINT `tr_racepackdistribusi_ibfk_1` FOREIGN KEY (`PendaftaranID`) REFERENCES `tr_pendaftaran` (`PendaftaranID`),
  ADD CONSTRAINT `tr_racepackdistribusi_ibfk_2` FOREIGN KEY (`PetugasID`) REFERENCES `tr_pengguna` (`PenggunaID`);

--
-- Constraints for table `tr_sertifikat`
--
ALTER TABLE `tr_sertifikat`
  ADD CONSTRAINT `tr_sertifikat_ibfk_1` FOREIGN KEY (`PendaftaranID`) REFERENCES `tr_pendaftaran` (`PendaftaranID`);

--
-- Constraints for table `tr_sponsor`
--
ALTER TABLE `tr_sponsor`
  ADD CONSTRAINT `tr_sponsor_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `ms_event` (`EventID`);

--
-- Constraints for table `tr_verifikasipembayaran`
--
ALTER TABLE `tr_verifikasipembayaran`
  ADD CONSTRAINT `tr_verifikasipembayaran_ibfk_1` FOREIGN KEY (`PembayaranID`) REFERENCES `tr_pembayaran` (`PembayaranID`),
  ADD CONSTRAINT `tr_verifikasipembayaran_ibfk_2` FOREIGN KEY (`PanitiaID`) REFERENCES `tr_pengguna` (`PenggunaID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
