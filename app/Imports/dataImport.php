<?php

namespace App\Imports;

use App\data;
use Maatwebsite\Excel\Concerns\ToModel;

class dataImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new data([
            'kota' => $row[0],
            'siswa' => $row[1],
            'sekolah' => $row[2],
            'TI' => $row[3],
            'DKV' => $row[4],
            'PBM' => $row[5],
            'Akuntansi' => $row[6],
            'tahun' => $row[7],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    
}
