<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'id' => 1,
                'name' => RoleEnum::ADMIN,
                'guard_name' => 'api'
            ],
            [
                'id' => 2,
                'name' => RoleEnum::USER,
                'guard_name' => 'api'
            ],
        ];

        foreach ($roles as $role) {
            Role::query()
                ->updateOrCreate(['name' => $role['name']], $role);
        }
    }
}
