<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_part','prenom_part','usersID',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,"usersID");
    }
    public function tickets()
    {
        return $this->hasOne(ticket::class);
    }
    // *________* plusieur classe assotation
    public function publications()
    {
        return $this->belongsToMany(Publication::class);
    }
    public function evenements()
    {
        return $this->belongsToMany(Evenement::class);
    }
    public function notePubs()
    {
        return $this->belongsToMany(NotePub::class);
    }
}
