<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()
            ->create([
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password')
            ]);

        $user->assignRole(RoleEnum::USER);
    }
}
