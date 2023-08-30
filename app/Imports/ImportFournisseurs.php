<?php

namespace App\Imports;

use App\Models\Fournisseur;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportFournisseurs implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Fournisseur([
            'nom_fournisseur'=>$row[0],
            'prenom_fournisseur'=>$row[1],
            'email_fournisseur'=>$row[2],
            'tel_fournisseur'=>$row[3],
            'adresse_fournisseur'=>$row[4],
            'description_fournisseur'=>$row[5]
        ]);
    }
}
