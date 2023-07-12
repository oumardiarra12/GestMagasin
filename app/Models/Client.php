<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ["id","nom_client","prenom_client","email_client","tel_client","adresse_client", "description_client"];
    public $timestamps = false;
}
