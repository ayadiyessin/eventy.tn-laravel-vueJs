<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvisPub extends Model
{
    use HasFactory;
    protected $fillable = [
        'publicationsID','participantsID','commentaire_pub'//,'note_pub'
    ];
}
