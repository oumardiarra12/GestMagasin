<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementVente extends Model
{
    use HasFactory;
    protected $fillable = ["id","num_paiement_ventes","total_vente","total_payer","total_reste","date_paiement_vente","description_paiement", "vente_id","user_id"];
    public $timestamps = false;
    public function vente(){
        return $this->belongsTo(Vente::class,"vente_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
}
