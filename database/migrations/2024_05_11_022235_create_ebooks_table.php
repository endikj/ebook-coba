<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 100);
            $table->unsignedBigInteger('id_kategori');
            $table->string('pengarang', 100)->nullable();
            $table->text('tentang_pengarang')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('halaman', 5)->nullable();
            $table->string('sumber',100)->nullable();
            $table->string('penerbit', 100)->nullable();
            $table->string('bahasa', 25)->nullable();
            $table->string('isbn', 20)->nullable();
            $table->date('tanggal')->nullable();
            $table->boolean('rekomendasi')->default(false); 
            $table->boolean('publish')->default(false); 
            $table->string('cover', 50)->nullable();
            $table->string('file', 50)->nullable();
            $table->longText('jumlah_baca')->nullable();
            $table->foreign('id_kategori')->references('id')->on('kategoris')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ebooks');
    }
};
