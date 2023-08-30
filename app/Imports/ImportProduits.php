<?php

namespace App\Imports;

use App\Models\Produit;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportProduits implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Produit([
            'codebarre'     => $row[0],
            'nom_produit'    => $row[1],
            'stockmin'    => $row[2],
            'prixvente_produit'    => $row[3],
            'prixachat_produit'    => $row[4],
            'description_produit'    => $row[5],
            'famille_id'    => $row[6],
            'unite_id'    => $row[7],
            'user_id'    => $row[8],
            'stockactuel' => $row[9],
        ]);
    }
}
