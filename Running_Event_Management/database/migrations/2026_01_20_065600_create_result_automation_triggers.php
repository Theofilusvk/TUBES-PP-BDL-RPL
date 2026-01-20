<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop triggers if they exist
        DB::unprepared('DROP TRIGGER IF EXISTS tr_calculate_pace_on_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS tr_calculate_pace_on_update');
        DB::unprepared('DROP TRIGGER IF EXISTS tr_update_age_group_ranking');
        DB::unprepared('DROP TRIGGER IF EXISTS tr_recalculate_rankings');

        // Trigger 1: Calculate pace on INSERT
        DB::unprepared('
            CREATE TRIGGER tr_calculate_pace_on_insert
            BEFORE INSERT ON tr_hasillomba
            FOR EACH ROW
            BEGIN
                DECLARE race_distance VARCHAR(50);
                DECLARE distance_km DECIMAL(10,4);
                DECLARE total_minutes DECIMAL(10,4);
                DECLARE pace_decimal DECIMAL(10,4);
                DECLARE pace_min INT;
                DECLARE pace_sec INT;
                
                -- Get race distance from category
                SELECT k.Jarak INTO race_distance
                FROM tr_pendaftaran p
                JOIN ms_kategorilomba k ON p.KategoriID = k.KategoriID
                WHERE p.PendaftaranID = NEW.PendaftaranID;
                
                -- Calculate pace if finish time is provided
                IF NEW.WaktuFinish IS NOT NULL AND race_distance IS NOT NULL THEN
                    -- Parse distance to kilometers
                    SET distance_km = CASE
                        WHEN UPPER(race_distance) LIKE \'%K%\' THEN 
                            CAST(REGEXP_REPLACE(race_distance, \'[^0-9.]\', \'\') AS DECIMAL(10,4))
                        WHEN UPPER(race_distance) IN (\'HM\', \'HALF MARATHON\') THEN 21.0975
                        WHEN UPPER(race_distance) IN (\'FM\', \'FULL MARATHON\', \'MARATHON\') THEN 42.195
                        ELSE NULL
                    END;
                    
                    IF distance_km > 0 THEN
                        -- Convert time to total minutes
                        SET total_minutes = 
                            HOUR(NEW.WaktuFinish) * 60 + 
                            MINUTE(NEW.WaktuFinish) + 
                            SECOND(NEW.WaktuFinish) / 60;
                        
                        -- Calculate pace (min/km)
                        SET pace_decimal = total_minutes / distance_km;
                        SET pace_min = FLOOR(pace_decimal);
                        SET pace_sec = ROUND((pace_decimal - pace_min) * 60);
                        
                        -- Format pace as "X\'YY\" /km"
                        SET NEW.Pace = CONCAT(pace_min, "\'", LPAD(pace_sec, 2, "0"), \'" /km\');
                    END IF;
                END IF;
            END
        ');

        // Trigger 2: Calculate pace on UPDATE
        DB::unprepared('
            CREATE TRIGGER tr_calculate_pace_on_update
            BEFORE UPDATE ON tr_hasillomba
            FOR EACH ROW
            BEGIN
                DECLARE race_distance VARCHAR(50);
                DECLARE distance_km DECIMAL(10,4);
                DECLARE total_minutes DECIMAL(10,4);
                DECLARE pace_decimal DECIMAL(10,4);
                DECLARE pace_min INT;
                DECLARE pace_sec INT;
                
                -- Get race distance from category
                SELECT k.Jarak INTO race_distance
                FROM tr_pendaftaran p
                JOIN ms_kategorilomba k ON p.KategoriID = k.KategoriID
                WHERE p.PendaftaranID = NEW.PendaftaranID;
                
                -- Calculate pace if finish time is provided
                IF NEW.WaktuFinish IS NOT NULL AND race_distance IS NOT NULL THEN
                    -- Parse distance to kilometers
                    SET distance_km = CASE
                        WHEN UPPER(race_distance) LIKE \'%K%\' THEN 
                            CAST(REGEXP_REPLACE(race_distance, \'[^0-9.]\', \'\') AS DECIMAL(10,4))
                        WHEN UPPER(race_distance) IN (\'HM\', \'HALF MARATHON\') THEN 21.0975
                        WHEN UPPER(race_distance) IN (\'FM\', \'FULL MARATHON\', \'MARATHON\') THEN 42.195
                        ELSE NULL
                    END;
                    
                    IF distance_km > 0 THEN
                        -- Convert time to total minutes
                        SET total_minutes = 
                            HOUR(NEW.WaktuFinish) * 60 + 
                            MINUTE(NEW.WaktuFinish) + 
                            SECOND(NEW.WaktuFinish) / 60;
                        
                        -- Calculate pace (min/km)
                        SET pace_decimal = total_minutes / distance_km;
                        SET pace_min = FLOOR(pace_decimal);
                        SET pace_sec = ROUND((pace_decimal - pace_min) * 60);
                        
                        -- Format pace as "X\'YY\" /km"
                        SET NEW.Pace = CONCAT(pace_min, "\'", LPAD(pace_sec, 2, "0"), \'" /km\');
                    END IF;
                END IF;
            END
        ');

        // Trigger 3: Update age group ranking AFTER insert/update
        // Note: Skipped because TanggalLahir column doesn't exist in tr_pengguna
        // Age group ranking can be added later if birth date data becomes available
        DB::unprepared('
            CREATE TRIGGER tr_update_age_group_ranking
            AFTER INSERT ON tr_hasillomba
            FOR EACH ROW
            BEGIN
                -- Placeholder trigger for future age group functionality
                -- Currently skipped due to missing birth date data
                SET @dummy = 1;
            END
        ');

        // Note: Ranking recalculation is handled by application code
        // MySQL doesn't allow updating the same table in a trigger that's being updated
        // So we keep the ranking logic in AdminEventController->recalculateEventRankings()
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS tr_calculate_pace_on_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS tr_calculate_pace_on_update');
        DB::unprepared('DROP TRIGGER IF EXISTS tr_update_age_group_ranking');
    }
};
