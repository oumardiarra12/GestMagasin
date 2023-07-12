<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneRetourAchat extends Model
{
    use HasFactory;
    protected $fillable = ["id","quantite_retourligneAchat","prixachat_retourligneAchat","soustotal_retourligneAchat","produit_id", "retour_achat_id"];
    public $timestamps = false;
    public function produit(){
        return $this->belongsTo(Produit::class,"produit_id","id");
    }
    public function retourachat(){
        return $this->belongsTo(RetourAchat::class,"retour_achat_id","id");
    }
}
