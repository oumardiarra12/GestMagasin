<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = ["id","ref_produit", "codebarre","nom_produit","stockmin","stockactuel","prixvente_produit","prixachat_produit","description_produit","categorie_id","unite_id"];
    public $timestamps = false;
    public function categorie(){
        return $this->belongsTo(Categorie::class,"categorie_id","id");
    }
    public function unite(){
        return $this->belongsTo(Unite::class,"unite_id","id");
    }
}
