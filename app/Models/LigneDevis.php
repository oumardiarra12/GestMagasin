<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneDevis extends Model
{
    use HasFactory;
    protected $fillable = ["id","quantite_lignedevis","prixvente_lignedevis","soustotal_lignedevis","produit_id", "devis_id"];
    public $timestamps = false;
    public function produit(){
        return $this->belongsTo(Produit::class,"produit_id","id");
    }
    public function devis(){
        return $this->belongsTo(Devis::class,"devis_id","id");
    }
}
