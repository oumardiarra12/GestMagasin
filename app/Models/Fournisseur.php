<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected $fillable = ["id","nom_fournisseur","prenom_fournisseur","email_fournisseur","tel_fournisseur","adresse_fournisseur", "description_fournisseur"];
    public $timestamps = false;
}
