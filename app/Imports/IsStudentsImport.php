<?php

namespace App\Imports;

use App\Models\is_students;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;

class IsStudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new is_students([
            'fname' => $row[0],
            'lname' => $row[1],
            'campus' => $row[2],
            'ismis' => $row[3],
            //
        ]);
    }
}
