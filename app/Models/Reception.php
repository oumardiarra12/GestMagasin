<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;
    protected $fillable = ["id","num_reception","num_piece","status_achat_paiement","date_reception","total_reception", "description_reception","achat_id","user_id"];
    public $timestamps = false;
    public function achat(){
        return $this->belongsTo(Achat::class,"achat_id","id");
    }

}
