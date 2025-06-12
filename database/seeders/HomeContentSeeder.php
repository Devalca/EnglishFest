<?php

namespace Database\Seeders;

use App\Models\HomeContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeContent::create([
            'title' => 'English Fest 2024',
            'description' => 'English Fest adalah program kerja tahunan dari English Club Nusa Putra University yang diadakan sebagai wadah minat dan bakat siswa/i di seluruh Indonesia dalam berbahasa Inggris.',
            'hero_image' => 'assets/img/team.png',
            'logo_image' => 'assets/img/logo.png', // contoh path logo, sesuaikan

            'quote' => '"Set Your Dream Alight, Let Your Imagination Take Flight."',

            'contact_paragraph' => 'English Fest merupakan hasil rancangan English Club Nusa Putra University, dibantu oleh pihak kampus sebagai support utama dalam pembinaan kegiatan ini. Klik tombol dibawah ini untuk gabung di group whatsapp. Semua cabang lomba tersebut diperuntukkan untuk siswa/i tingkat SMA/SMK/Sederajat.',

            'whatsapp_link' => 'https://api.whatsapp.com/send?phone=6285720978940',
            'email' => 'englishclub@nusaputra.ac.id',
            'instagram' => 'https://www.instagram.com/englishfest_nsp/',

            'payment_title' => '(Dana/OVO)',
            'payment_number' => '087857123785',
            'payment_owner' => 'Handrini Helmayanti',

            'fees' => [
                [
                    'title' => 'Lomba Individu (English Singing, English Speech, Poetry Reading, Storytelling)',
                    'price' => 'Rp.150.000/orang',
                ],
                [
                    'title' => 'Lomba Tim (Debate)',
                    'price' => 'Rp.350.000/tim',
                ],
                [
                    'title' => 'English Camp',
                    'price' => 'Rp.450.000/orang',
                ],
            ],

            'about_paragraph' => "English Club yang berada di Universitas Nusa Putra adalah sebuah kelompok atau organisasi di kampus tersebut di mana mahasiswa dan mungkin juga staf akademik berkumpul untuk belajar, berlatih, dan meningkatkan kemampuan berbahasa Inggris mereka secara bersama-sama. Klub ini terbuka untuk siapa saja yang terdaftar di universitas tersebut dan tertarik untuk meningkatkan kemampuan berbahasa Inggris mereka.
            English Club Universitas Nusa Putra bertujuan untuk menciptakan lingkungan yang mendukung dan menyenangkan bagi anggotanya dalam usaha mereka untuk meningkatkan kemampuan bahasa Inggris dan memahami budaya berbahasa Inggris.",

            'cs' => [
                [
                    'name' => 'Cindy Amelia',
                    'wa_number' => '085720978940',
                    'wa_link' => 'https://wa.me/6285720978940',
                ],
                [
                    'name' => 'Ridha Khairunnisa',
                    'wa_number' => '085863102497',
                    'wa_link' => 'https://wa.me/6285863102497',
                ],
            ],
        ]);
    }
}
