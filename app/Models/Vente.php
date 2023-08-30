<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;
    protected $fillable = ["id","num_vente","status_vente_paiement","total_vente","date_vente", "client_id","description_vente","user_id"];
    public $timestamps = false;
    public function client(){
        return $this->belongsTo(Client::class,"client_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function paiementventes(){
        return $this->hasMany(PaiementVente::class);
    }
    public function retourventes(){
        return $this->hasMany(RetourVente::class);
    }
}
