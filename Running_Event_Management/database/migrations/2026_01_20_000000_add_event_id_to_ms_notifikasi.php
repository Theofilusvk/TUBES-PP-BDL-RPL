<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ms_notifikasi', function (Blueprint $table) {
            $table->integer('EventID')->nullable()->after('TipeNotifikasi');
            // Check if foreign key should be added (optional, but good practice if tables exist)
            // $table->foreign('EventID')->references('EventID')->on('ms_event')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('ms_notifikasi', function (Blueprint $table) {
            $table->dropColumn('EventID');
        });
    }
};
