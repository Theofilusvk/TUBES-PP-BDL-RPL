-- =============================================
-- Admin Controls: Stored Procedures & Views (SQL Server / T-SQL)
-- =============================================

-- 1. VIEW: Dashboard Overview (Admin)
-- Aggregates total registrations, verified payments, and remaining slots per category.
CREATE OR ALTER VIEW vw_AdminDashboardStats AS
SELECT 
    e.nama_event,
    k.nama_kategori,
    k.jarak,
    sk.kuota_total,
    sk.kuota_terisi,
    (sk.kuota_total - sk.kuota_terisi) AS sisa_kuota,
    COUNT(p.pendaftaran_id) AS total_pendaftar,
    SUM(CASE WHEN byr.status_pembayaran = 'LUNAS' THEN 1 ELSE 0 END) AS total_lunas,
    SUM(CASE WHEN byr.status_pembayaran = 'MENUNGGU_VERIFIKASI' THEN 1 ELSE 0 END) AS perlu_verifikasi
FROM ms_event e
JOIN ms_kategori k ON e.event_id = k.event_id
JOIN ms_slot_kategori sk ON k.kategori_id = sk.kategori_id
LEFT JOIN tr_pendaftaran p ON k.kategori_id = p.kategori_id
LEFT JOIN tr_pembayaran byr ON p.pendaftaran_id = byr.pendaftaran_id
GROUP BY e.nama_event, k.nama_kategori, k.jarak, sk.kuota_total, sk.kuota_terisi;
GO

-- 2. PROCEDURE: Verify Payment (Admin Action)
-- Updates payment status, creates verification log, and updates registration status.
CREATE OR ALTER PROCEDURE sp_AdminVerifyPayment
    @PembayaranID UNIQUEIDENTIFIER,
    @AdminID UNIQUEIDENTIFIER,
    @StatusVerifikasi VARCHAR(50), -- 'VALID' or 'INVALID'
    @Catatan VARCHAR(MAX)
AS
BEGIN
    SET NOCOUNT ON;
    BEGIN TRANSACTION;

    BEGIN TRY
        -- 1. Insert Verification Log
        INSERT INTO tr_verifikasi (pembayaran_id, panitia_id, tanggal_verifikasi, status_verifikasi, catatan_verifikasi)
        VALUES (@PembayaranID, @AdminID, GETDATE(), @StatusVerifikasi, @Catatan);

        -- 2. Update Payment Status
        IF @StatusVerifikasi = 'VALID'
        BEGIN
            UPDATE tr_pembayaran 
            SET status_pembayaran = 'LUNAS' 
            WHERE pembayaran_id = @PembayaranID;

            -- 3. Update Registration Status
            DECLARE @PendaftaranID UNIQUEIDENTIFIER;
            SELECT @PendaftaranID = pendaftaran_id FROM tr_pembayaran WHERE pembayaran_id = @PembayaranID;

            UPDATE tr_pendaftaran
            SET status_pendaftaran = 'TERDAFTAR'
            WHERE pendaftaran_id = @PendaftaranID;
        END
        ELSE
        BEGIN
            UPDATE tr_pembayaran 
            SET status_pembayaran = 'DITOLAK' 
            WHERE pembayaran_id = @PembayaranID;
        END

        COMMIT TRANSACTION;
    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        THROW;
    END CATCH
END;
GO

-- 3. PROCEDURE: Generate Race Results (Committee Action)
-- Bulk insert race results or update a single runner's result.
CREATE OR ALTER PROCEDURE sp_InputRaceResult
    @NomorBIB VARCHAR(50),
    @WaktuFinish TIME,
    @StatusHasil VARCHAR(50) = 'FINISHER'
AS
BEGIN
    SET NOCOUNT ON;
    
    DECLARE @PendaftaranID UNIQUEIDENTIFIER;
    
    -- Find Pendaftaran based on BIB
    SELECT @PendaftaranID = pendaftaran_id 
    FROM tr_race_pack_detail_peserta 
    WHERE nomor_bib = @NomorBIB;

    IF @PendaftaranID IS NULL
    BEGIN
        THROW 51000, 'BIB Number not found.', 1;
    END

    -- Insert or Update Result
    IF EXISTS (SELECT 1 FROM tr_hasil WHERE pendaftaran_id = @PendaftaranID)
    BEGIN
        UPDATE tr_hasil
        SET waktu_finish = @WaktuFinish, status_hasil = @StatusHasil
        WHERE pendaftaran_id = @PendaftaranID;
    END
    ELSE
    BEGIN
        INSERT INTO tr_hasil (pendaftaran_id, waktu_finish, status_hasil)
        VALUES (@PendaftaranID, @WaktuFinish, @StatusHasil);
    END
END;
GO
