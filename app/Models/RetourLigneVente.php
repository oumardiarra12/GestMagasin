<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetourLigneVente extends Model
{
    use HasFactory;
    protected $fillable = ["id","quantite_ligneretourvente","prixvente_ligneretourvente","soustotal_ligneretourvente","produit_id", "retour_vente_id"];
    public $timestamps = false;
    public function produit(){
        return $this->belongsTo(Produit::class,"produit_id","id");
    }
    public function retourvente(){
        return $this->belongsTo(RetourVente::class,"retour_vente_id","id");
    }
}
