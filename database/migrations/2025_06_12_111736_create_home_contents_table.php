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
         Schema::create('home_contents', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();                 // Judul utama hero
            $table->longText('description')->nullable();             // Deskripsi hero
            $table->string('hero_image')->nullable();             // Gambar hero

            $table->string('logo_image')->nullable();             // Logo tambahan

            $table->text('quote')->nullable();                    // Quote

            $table->longText('contact_paragraph')->nullable();       // Gabungan paragraf kontak

            $table->string('whatsapp_link')->nullable();          // Link WA
            $table->string('email')->nullable();                   // Email
            $table->string('instagram')->nullable();               // Instagram

            $table->string('payment_title')->nullable();         // Nomor pembayaran (Dana/OVO)
            $table->string('payment_number')->nullable();         // Nomor pembayaran (Dana/OVO)
            $table->string('payment_owner')->nullable();          // Nama pemilik pembayaran

            $table->json('fees')->nullable();                      // Repeater biaya (json)

            $table->longText('about_paragraph')->nullable();          // Tentang kami gabungan paragraf

            $table->json('cs')->nullable();                        // Customer Service (json repeater)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_contents');
    }
};
