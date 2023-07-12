<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetourVente extends Model
{
    use HasFactory;
    protected $fillable = ["id","ref_retourvente","num_retourvente","total_retourvente","date_retourvente", "client_id","description_retourvente","user_id"];
    public $timestamps = false;
    public function client(){
        return $this->belongsTo(Client::class,"client_id","id");
    }
}
