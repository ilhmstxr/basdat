<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\kupon;

class kuponseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        kupon::create([
            // 'nama_kupon' => 'kupon a',
            'stok' => '50',
            'harga_ketentuan' => '200000',
            'diskon' => '0.20'
        ]);

        // kupon::create([
        //     'nama_kupon' => 'kupon b',
        //     'stok' => '50',
        //     'harga_ketentuan' => '300000',
        //     'diskon' => '0.30'
        // ]);
    }
}
