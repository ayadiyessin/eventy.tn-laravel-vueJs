<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restauration extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_rest','usersID','categorieRestID',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,"usersID");
    }
    public function categorieRest()
    {
    return $this->belongsTo(CategorieRest::class,"categorieRestID");
    }
    public function publications()
    {
    return $this->hasMany(Publication::class ,"organisateursID");
    }
}
