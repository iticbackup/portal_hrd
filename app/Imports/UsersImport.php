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
        $user = new User([
            'id_generate'       => Str::uuid()->toString(),
            'nik'               => $row[0],
            'name'              => $row[1],
            'departemen'        => $row[2],
            'password'          => Hash::make($row[3]),
        ]);
        $user->assignRole($row[4]);
        return $user;
        // return new User([
        //     'id_generate'       => Str::uuid()->toString(),
        //     'nik'               => $row[0],
        //     'name'              => $row[1],
        //     'departemen'        => $row[2],
        //     'password'          => Hash::make($row[3]),
        // ]);
    }

    // public function headingRow(): int
    // {
    //     return 2;
    // }
}
