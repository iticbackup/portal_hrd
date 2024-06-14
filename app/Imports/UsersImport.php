<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User;

use Hash;

class UsersImport implements ToModel
{
    public function model(array $row)
    {
        return new User([
            'id_generate'       => Str::uuid()->toString(),
            'nik'               => $row[0],
            'name'              => $row[1],
            'departemen'        => $row[2],
            'password'          => Hash::make($row[3]),
        ]);
    }
}
