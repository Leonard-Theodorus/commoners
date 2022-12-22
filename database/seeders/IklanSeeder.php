<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IklanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('iklan')->insert([
            [
                'id_umkm' => 1,
                'kategori_iklan' => 4,
                'gaji' => 4500000,
                'judul_iklan' => 'Full-Stack Web Developer',
                'banner' => 'https://cdn2.vectorstock.com/i/1000x1000/04/36/web-site-development-programming-or-coding-banner-vector-35750436.jpg',
                'kota_lokasi' => 'Jakarta',
                'alamat' => 'Jalan Nanas No.3, Kebon Jeruk, Jakarta Barat',
                'durasi' => 'Part-time',
                'shortdesc' => 'Dibutuhkan Full-stack web developer dengan minimal 2 tahun pengalaman. Gaji akan dibayarkan diakhir proyek',
                'is_available' => true
            ],
            [
                'id_umkm' => 2,
                'kategori_iklan' => 3,
                'gaji' => 5000000,
                'judul_iklan' => 'Tenaga Penjahit',
                'banner' => 'https://img.freepik.com/free-vector/banner-template-with-sewing-concept-design-watercolor-illustration_83728-4981.jpg?w=2000',
                'kota_lokasi' => 'Bandung',
                'alamat' => 'Jalan Riau No.5B, Mekarwangi, Bandung',
                'durasi' => 'Full-time',
                'shortdesc' => 'Dibutuhkan tenaga ekstra penjahit, minimal sudah pernah bekerja sebagai penjahit sebelumnya, atau aktif menjahit',
                'is_available' => true
            ],
            [
                'id_umkm' => 3,
                'kategori_iklan' => 1,
                'gaji' => 6500000,
                'judul_iklan' => 'Guru Privat Koding',
                'banner' => 'https://cdn3.vectorstock.com/i/1000x1000/14/32/we-are-hiring-programmer-recruitment-poster-ads-vector-28451432.jpg',
                'kota_lokasi' => 'Jakarta',
                'alamat' => 'Jalan Sedayu No.22, Kelapa Gading, Jakarta Utara',
                'durasi' => 'Full-time',
                'shortdesc' => 'Dibutuhkan Guru privat koding, diperuntukan untuk mengajar pemula, minimal pengalaman mengajar 2 tahun',
                'is_available' => true
            ],
        ]);
    }
}
