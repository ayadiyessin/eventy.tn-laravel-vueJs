<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_tell','usersID',
    ];

    public function user()
    {
    return $this->belongsTo(User::class,"usersID");
    }
}
