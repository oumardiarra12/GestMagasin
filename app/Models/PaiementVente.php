<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementVente extends Model
{
    use HasFactory;
    protected $fillable = ["id","total_vente","total_payer","total_reste","date_paiement_vente","description_paiement", "vente_id","user_id"];
    public $timestamps = false;
    public function vente(){
        return $this->belongsTo(Vente::class,"vente_id","id");
    }
}
