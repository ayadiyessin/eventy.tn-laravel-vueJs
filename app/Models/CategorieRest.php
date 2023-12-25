<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieRest extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomcategorie',
    ];
    // relation 1--*
    public function restaurations()
    {
    return $this->hasMany(Restauration::class ,"categorieRestID");
    }


}
