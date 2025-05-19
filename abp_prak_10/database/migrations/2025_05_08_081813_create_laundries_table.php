<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up()
    {
        Schema::create('laundries', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->string('jenis_layanan');
            $table->integer('berat');
            $table->integer('harga');
            $table->timestamps(); // created_at dan updated_at
        });
        Schema::table('laundries', function (Blueprint $table) {
            $table->date('tanggal_transaksi')->nullable(); // Tambah kolom tanggal
        });        
    }

    public function down()
    {
        Schema::table('laundries', function (Blueprint $table) {
            // Pastikan hanya menghapus kalau memang ada
            if (Schema::hasColumn('laundries', 'tanggal_transaksi')) {
                $table->dropColumn('tanggal_transaksi');
            }
        });
    }
};

