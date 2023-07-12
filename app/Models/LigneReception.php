<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneReception extends Model
{
    use HasFactory;
    protected $fillable = ["id","quantite_achat_ligne_reception","quantite_ligne_reception","prixachat_ligne_reception","soustotal_ligne_lignereception","produit_id", "reception_id"];
    public $timestamps = false;
    public function produit(){
        return $this->belongsTo(Produit::class,"produit_id","id");
    }
    public function reception(){
        return $this->belongsTo(Reception::class,"reception_id","id");
    }
}
