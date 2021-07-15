<?php

namespace App\Imports;

use App\Models\Marca;
use Maatwebsite\Excel\Concerns\ToModel;

class MarcasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Marca([
            'id'     => $row[0],
            'nome'    => $row[1]
        ]);
    }
}
