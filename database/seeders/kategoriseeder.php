<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class kategoriseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        category::create([
            'nama' => 'makanan'
        ]);

        category::create([
            'nama' => 'minuman'
        ]);

        category::create([
            'nama' => 'jajan'
        ]);
    }
}
