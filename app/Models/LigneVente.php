<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneVente extends Model
{
    use HasFactory;
    protected $fillable = ["id","quantite_lignevente","prixvente_lignevente","soustotal_lignevente","produit_id", "vente_id"];
    public $timestamps = false;
    public function produit(){
        return $this->belongsTo(Produit::class,"produit_id","id");
    }
    public function vente(){
        return $this->belongsTo(Vente::class,"vente_id","id");
    }
}
