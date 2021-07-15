<?php

namespace App\Imports;

use App\Models\Modelo;
use Maatwebsite\Excel\Concerns\ToModel;

class ModelosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Modelo([
            'id'     => $row[0],
            'nome'    => $row[2],
            'marca_id' => $row[1]
        ]);
    }
}
