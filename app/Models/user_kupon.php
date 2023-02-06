<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_kupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kupons()
    {
        return $this->belongsTo(kupon::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
