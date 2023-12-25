<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvisEven extends Model
{
    use HasFactory;
    protected $fillable = [
        'evenementsID','participantsID','commentaire_Event'//,'note_pub'
    ];
}
