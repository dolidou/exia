<?php

namespace App\Imports;

use App\Models\Etudiant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EtudiantsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Etudiant([
            'nom' => $row['nom'],
            'prenom' => $row['prenom'],
            'matricule' => $row['matricule'],
            'promo' => $row['promo']
        ]);
    }
}
