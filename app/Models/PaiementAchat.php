<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementAchat extends Model
{
    use HasFactory;
    protected $fillable = ["id","total_achat","total_payer","total_reste","date_paiement_achat","description_paiement", "reception_id","user_id"];
    public $timestamps = false;
    public function reception(){
        return $this->belongsTo(Reception::class,"reception_id","id");
    }
}
