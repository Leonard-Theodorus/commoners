<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->insert([
            ['nama_kategori' => 'Pendidikan'],
            ['nama_kategori' => 'Food and Drinks'],
            ['nama_kategori' => 'Fashion'],
            ['nama_kategori' => 'Teknologi'],
            ['nama_kategori' => 'Design'],
            ['nama_kategori' => 'Tour and Travel'],
            ['nama_kategori' => 'Event Organizer'],
        ]);
    }
}
