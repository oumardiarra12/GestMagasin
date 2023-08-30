<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementAchat extends Model
{
    use HasFactory;
    protected $fillable = ["id","num_paiement_achats","total_achat","total_payer","total_reste","date_paiement_achat","description_paiement", "achat_id","user_id"];
    public $timestamps = false;
    public function achat(){
        return $this->belongsTo(Achat::class,"achat_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }

}
