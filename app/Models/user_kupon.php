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
<<<<<<< HEAD
        return $this->belongsTo(kupon::class);
    }

    public function user()
    {
=======
>>>>>>> f43447d66b09b37873a1d8fcdecf03a71bec4562
        return $this->belongsTo(user::class);
    }
}
