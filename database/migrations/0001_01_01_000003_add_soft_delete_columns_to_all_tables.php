<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Core user tables
        Schema::table('user', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('password');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
            $table->index('deleted_at');
            $table->foreign('deleted_by')->references('iduser')->on('user')->onDelete('set null');
        });

        Schema::table('dokter', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('iduser');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
            $table->index('deleted_at');
            $table->foreign('deleted_by')->references('iduser')->on('user')->onDelete('set null');
        });

        Schema::table('perawat', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('iduser');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
            $table->index('deleted_at');
            $table->foreign('deleted_by')->references('iduser')->on('user')->onDelete('set null');
        });

        Schema::table('pemilik', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('iduser');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
            $table->index('deleted_at');
            $table->foreign('deleted_by')->references('iduser')->on('user')->onDelete('set null');
        });

        Schema::table('role_user', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('status');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
            $table->index('deleted_at');
            $table->foreign('deleted_by')->references('iduser')->on('user')->onDelete('set null');
        });

        // Pet and medical records
        Schema::table('pet', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('idras_hewan');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
            $table->index('deleted_at');
            $table->foreign('deleted_by')->references('iduser')->on('user')->onDelete('set null');
        });

        Schema::table('rekam_medis', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('dokter_pemeriksa');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
            $table->index('deleted_at');
            $table->foreign('deleted_by')->references('iduser')->on('user')->onDelete('set null');
        });

        Schema::table('detail_rekam_medis', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('detail');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
            $table->index('deleted_at');
            $table->foreign('deleted_by')->references('iduser')->on('user')->onDelete('set null');
        });

        Schema::table('temu_dokter', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('idrekam_medis');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
            $table->index('deleted_at');
            $table->foreign('deleted_by')->references('iduser')->on('user')->onDelete('set null');
        });

        // Lookup tables
        Schema::table('jenis_hewan', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('nama_jenis_hewan');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
            $table->index('deleted_at');
            $table->foreign('deleted_by')->references('iduser')->on('user')->onDelete('set null');
        });

        Schema::table('ras_hewan', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('idjenis_hewan');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
            $table->index('deleted_at');
            $table->foreign('deleted_by')->references('iduser')->on('user')->onDelete('set null');
        });

        Schema::table('kategori', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('nama_kategori');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
            $table->index('deleted_at');
            $table->foreign('deleted_by')->references('iduser')->on('user')->onDelete('set null');
        });

        Schema::table('kategori_klinis', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('nama_kategori_klinis');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
            $table->index('deleted_at');
            $table->foreign('deleted_by')->references('iduser')->on('user')->onDelete('set null');
        });

        Schema::table('kode_tindakan_terapi', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('idkategori_klinis');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
            $table->index('deleted_at');
            $table->foreign('deleted_by')->references('iduser')->on('user')->onDelete('set null');
        });

        Schema::table('role', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('nama_role');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
            $table->index('deleted_at');
            $table->foreign('deleted_by')->references('iduser')->on('user')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'user', 'dokter', 'perawat', 'pemilik', 'role_user',
            'pet', 'rekam_medis', 'detail_rekam_medis', 'temu_dokter',
            'jenis_hewan', 'ras_hewan', 'kategori', 'kategori_klinis',
            'kode_tindakan_terapi', 'role'
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropForeign(['deleted_by']);
                $table->dropIndex(['deleted_at']);
                $table->dropColumn(['deleted_at', 'deleted_by']);
            });
        }
    }
};
