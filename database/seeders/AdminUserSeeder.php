<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'musabgaili@gmail.com'],
            [
                'name' => 'Musab Gaili',
                'email' => 'musabgaili@gmail.com',
                'password' => '12345678',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ Admin user created: musabgaili@gmail.com');
    }
}

