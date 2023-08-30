<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;
    protected $fillable = ["id","num_devis","status_devis","total_devis","date_devis", "client_id","description_devis","user_id"];
    public $timestamps = false;
    public function client(){
        return $this->belongsTo(Client::class,"client_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
}
