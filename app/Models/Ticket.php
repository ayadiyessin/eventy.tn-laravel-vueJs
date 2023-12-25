<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'evenementsID','participantsID','nb_Tick',
    ];
    public function Participant()
    {
        return $this->belongsTo(Participant::class,"participantsID");
    }
    public function evenement()
    {
    return $this->belongsTo(Evenement::class,"evenementsID");
    }
}
