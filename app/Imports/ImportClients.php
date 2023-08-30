<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportClients implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Client([
            'nom_client'=>$row[0],
            'prenom_client'=>$row[1],
            'email_client'=>$row[2],
            'tel_client'=>$row[3],
            'adresse_client'=>$row[4],
            'description_client'=>$row[5]
        ]);
    }
}
