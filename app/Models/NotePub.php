<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotePub extends Model
{
    use HasFactory;
    protected $fillable = [
        'publicationsID','participantsID','note_pub'
    ];
    public function participants()
    {
    return $this->belongsTo(Participant::class,"participantsID");
    }
    public function publication()
    {
    return $this->belongsTo(Publication::class,"publicationsID");
    }
}
