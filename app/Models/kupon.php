<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kupons()
    {
        return $this->hasMany(user_kupon::class);
    }

    // public function item(){
    //     return $this->
    // }
}
