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
        'nom_user',
        'prenom_user',
        'photo_user',
        'adresse_user',
        'telephone_user',
        'email',
        'password',
        'categorie_id'
    ];

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
    public function categorie(){
        return $this->belongsTo(Categorie::class,'categorie_id','id');
    }
    public function estCategorie($categorie){
        return $this->categorie()->where("nom_categorie",$categorie)->first()!==null;
    }

    public function tousCategorie($categories){
        return $this->categorie()->whereIn("nom_categorie",$categories)->first()!==null;
    }

}
