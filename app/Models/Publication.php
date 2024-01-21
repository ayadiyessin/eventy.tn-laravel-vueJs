<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
    protected $fillable = [
        'archive_pub','restaurationID','dersc_pub','photo_pub',
    ];
    public function restauration()
    {
    return $this->belongsTo(Restauration::class,"restaurationID");
    }
    public function participants() // plusieur plusier
    {
        return $this->belongsToMany(Participant::class);
    }
    public function notePubs()
    {
        return $this->belongsToMany(NotePub::class);
    }
    
}
