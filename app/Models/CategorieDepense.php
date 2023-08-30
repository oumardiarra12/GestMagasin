<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieDepense extends Model
{
    use HasFactory;
    protected $fillable = ["id","nom_categorie_depense", "description_categorie_depense"];
    public $timestamps = false;
}
