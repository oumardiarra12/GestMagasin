<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    use HasFactory;
    protected $fillable = ["id","num_achat","status_achat_reception","total_achat","date_achat", "fournisseur_id","description_achat","user_id"];
    public $timestamps = false;
    public function fournisseur(){
        return $this->belongsTo(Fournisseur::class,"fournisseur_id","id");
    }
}
