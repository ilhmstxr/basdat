<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\item;

class itemseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        item::create([
            'name' => 'nasi goreng',
            'price' => '16000',
            'stock' => '999921',
            'img' => '',
            'deskripsi' => 'Nasi goreng lezat sederhana yang lezat',
            'category_id' => '1'
        ]);

        item::create([
            'name' => 'mie goreng',
            'price' => '13000',
            'stock' => '99918',
            'img' => '',
            'deskripsi' => 'Mie goreng komplit yang menggugah selera',
            'category_id' => '1'
        ]);

        item::create([
            'name' => 'coca cola',
            'price' => '6000',
            'stock' => '99925',
            'img' => '',
            'deskripsi' => 'Minuman soda gembira klasik yang menyegarkan',
            'category_id' => '2'
        ]);

        item::create([
            'name' => 'ketoprak',
            'price' => '8000',
            'stock' => '99930',
            'img' => '',
            'deskripsi' => 'Makanan begitulah',
            'category_id' => '2'
        ]);
    }
}
