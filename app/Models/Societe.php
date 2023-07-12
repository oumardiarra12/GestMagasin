<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societe extends Model
{
    use HasFactory;
    protected $fillable = ["id","nom_societe", "activite_societe","tel_societe","logo_societe","nif_societe","bp_societe","adresse"];
    public $timestamps = false;
}
