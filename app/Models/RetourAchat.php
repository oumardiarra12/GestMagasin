<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetourAchat extends Model
{
    use HasFactory;
    protected $fillable = ["id","num_retour_achat","achat_id","total_retour_achat","date_retour_achat", "description_retour_achat","user_id"];
    public $timestamps = false;
    public function achat(){
        return $this->belongsTo(Achat::class,"achat_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
}
