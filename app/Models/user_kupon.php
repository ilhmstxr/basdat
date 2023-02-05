<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_kupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kupon()
    {
        return $this->belongsTo(kupon::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
