<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisateur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_org','usersID'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,"usersID");
    }
    public function evenements()
    {
    return $this->hasMany(Evenement::class ,"organisateursID");
    }
    
}
