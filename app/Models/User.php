<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email','password','image_user','type_user','ville_user','adresse_user',
    ];
    // relation 1--0..1
    public function participant()
    {
        return $this->hasOne(Participant::class);
    }

    public function organisateur()
    {
        return $this->hasOne(Organisateur::class);
    }

    public function restauration()
    {
        return $this->hasOne(Restauration::class);
    }
    // relation 1--*
    public function telephones()
    {
    return $this->hasMany(Telephone::class ,"usersID");
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
