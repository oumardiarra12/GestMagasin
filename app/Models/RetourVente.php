<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetourVente extends Model
{
    use HasFactory;
    protected $fillable = ["id","ref_retourvente","num_retourvente","total_retourvente","date_retourvente", "vente_id","description_retourvente","user_id"];
    public $timestamps = false;

    public function vente(){
        return $this->belongsTo(Vente::class,"vente_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
}
