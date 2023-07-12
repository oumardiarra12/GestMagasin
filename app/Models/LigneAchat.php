<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneAchat extends Model
{
    use HasFactory;
    protected $fillable = ["id","quantite_ligneAchat","quantite_recu_ligneAchat","prixachat_ligneAchat","soustotal_ligneAchat","produit_id", "achat_id"];
    public $timestamps = false;
    public function produit(){
        return $this->belongsTo(Produit::class,"produit_id","id");
    }
    public function achat(){
        return $this->belongsTo(Achat::class,"achat_id","id");
    }
}
