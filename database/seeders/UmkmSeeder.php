<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('umkm')->insert([
            [
                'user_id' => 1,
                'short_desc' => 'Nasi uduk kampung',
                'logo' => 'https://img.freepik.com/premium-vector/cute-funny-nasi-uduk-traditional-rice-food-from-jakarta-indonesia_292879-141.jpg?w=2000',
                'kategori_umkm' => 2
            ],
            [
                'user_id' => 2,
                'short_desc' => 'Penjahit baju spesialis baju pernikahan',
                'logo' => 'https://static.vecteezy.com/system/resources/previews/006/863/869/original/vintage-tailor-shop-logo-icon-symbol-textile-or-industrial-illustration-concept-free-vector.jpg',
                'kategori_umkm' => 3
            ],
            [
                'user_id' => 3,
                'short_desc' => 'Penyedia kurus bagi siswa nasional maupun internasional',
                'logo' => 'https://t3.ftcdn.net/jpg/01/02/51/70/360_F_102517057_4Tedp0gKwCkWwu54kKni0GZ0DqIWe5MY.jpg',
                'kategori_umkm' => 1
            ],
        ]);
    }
}
