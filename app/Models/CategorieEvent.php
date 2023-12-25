<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomcategorieEvent',
    ];
    public function evenements()
    {
    return $this->hasMany(Evenement::class ,"categorieEventID");
    }
}
