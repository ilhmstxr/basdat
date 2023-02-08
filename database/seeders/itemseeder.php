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
            'stock' => '21',
            'img' => '',
            'category_id' => '1'
        ]);

        item::create([
            'name' => 'mie goreng',
            'price' => '13000',
            'stock' => '18',
            'img' => '',
            'category_id' => '1'
        ]);

        item::create([
            'name' => 'coca cola',
            'price' => '6000',
            'stock' => '25',
            'img' => '',
            'category_id' => '2'
        ]);

        item::create([
            'name' => 'nasi goreng',
            'price' => '5000',
            'stock' => '30',
            'img' => '',
            'category_id' => '2'
        ]);
    }
}
