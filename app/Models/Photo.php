<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'evenementsID','publicationsID','imagePhoto',
    ];
    public function evenement()
    {
    return $this->belongsTo(Evenement::class,"evenementsID");
    }
    public function publication()
    {
    return $this->belongsTo(Publication::class,"publicationsID");
    }
}
