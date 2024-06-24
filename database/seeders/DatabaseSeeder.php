<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    private $permissions = [
        'usermanagement-list',
        'usermanagement-detail',
        'usermanagement-store',
        'usermanagement-edit',
        'usermanagement-update',
        'usermanagement-delete',
        'antrian-list',
        'antrian-detail',
        'antrian-verifikasi',
        'antrian-store',
        'antrian-edit',
        'antrian-update',
        'antrian-delete',
        'ijinkeluarmasuk-list',
        'ijinkeluarmasuk-detail',
        'ijinkeluarmasuk-verifikasi',
        'ijinkeluarmasuk-store',
        'ijinkeluarmasuk-edit',
        'ijinkeluarmasuk-update',
        'ijinkeluarmasuk-delete',
        'ijinabsen-list',
        'ijinabsen-detail',
        'ijinabsen-verifikasi',
        'ijinabsen-store',
        'ijinabsen-edit',
        'ijinabsen-update',
        'ijinabsen-delete',
        'user-list',
        'user-detail',
        'user-store',
        'user-edit',
        'user-update',
        'user-delete',
        'role-list',
        'role-detail',
        'role-store',
        'role-edit',
        'role-update',
        'role-delete',
        'permission-list',
        'permission-detail',
        'permission-store',
        'permission-edit',
        'permission-update',
        'permission-delete',
    ];

    private $roles = [
        'Administrator',
        'Direktur',
        'HRGA Admin',
        'Finance Admin',
        'Marketing Admin',
        'Purchasing Admin',
        'IT Admin',
        'Corsec Admin',
        'PPIC Admin',
        'Produksi Admin',
        'QC Admin',
        'Satpam',
        'HRGA Operator',
        'PPIC Operator',
        'Produksi Operator',
        'QC Operator',
    ];

    public function run()
    {
        // User::factory(10)->create();
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        foreach ($this->roles as $role) {
            $dataRole = Role::create(['name' => $role]);
        }
    }
}
