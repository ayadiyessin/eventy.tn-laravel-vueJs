<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;
    protected $fillable = [
        'categorieEventID','organisateursID','nbPlace_Event','date_Event','prix_Event','adresse_Event','nom_Event',
    ];

    public function categorieEvent()
    {
    return $this->belongsTo(CategorieEvent::class,"categorieEventID");
    }
    public function organisateurs()
    {
    return $this->belongsTo(Organisateur::class,"organisateursID");
    }

    public function tickets()
    {
    return $this->hasMany(Ticket::class ,"evenementsID");
    }
    public function photos()
    {
    return $this->hasMany(Photo::class ,"evenementsID");
    }
    public function participants()// classe assosation pluseur plusieur
    {
        return $this->belongsToMany(Participant::class);
    }
}
