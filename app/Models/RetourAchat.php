<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetourAchat extends Model
{
    use HasFactory;
    protected $fillable = ["id","num_retour_achat","refreception_retour_achat","total_retour_achat","date_retour_achat", "fournisseur_id","description_retour_achat","user_id"];
    public $timestamps = false;
    public function fournisseur(){
        return $this->belongsTo(Fournisseur::class,"fournisseur_id","id");
    }
}
