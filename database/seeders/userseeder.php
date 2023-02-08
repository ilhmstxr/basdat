<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\user_kupon;

class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345'),
        ]);

        User::create([
            'name' => 'ilham',
            'email' => 'ilham@gmail.com',
            'password' => bcrypt('12345'),
        ]);

        User::create([
            'name' => 'tsanny',
            'email' => 'tsanny@gmail.com',
            'password' => bcrypt('12345'),
        ]);
        
    }
    
}
