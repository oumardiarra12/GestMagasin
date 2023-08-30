<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;
    protected $fillable = ["id","num_depense", "date_depense","total_depense","note_depense","categorie_depense_id","user_id"];
    public $timestamps = false;
    public function categoriedepense(){
        return $this->belongsTo(CategorieDepense::class,"categorie_depense_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
}
