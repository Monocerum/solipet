<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class DemoAccountsSeeder extends Seeder
{
    public function run(): void
    {
        $adminPassword = env('DEMO_ADMIN_PASSWORD');
        $customerPassword = env('DEMO_CUSTOMER_PASSWORD');

        if (empty($adminPassword) || empty($customerPassword)) {
            throw new RuntimeException(
                'Demo account passwords are missing from environment variables.'
            );
        }

        $accounts = [
            [
                'name' => 'Solipet Administrator',
                'username' => 'solipetadmin',
                'email' => 'admin@solipet.demo',
                'password' => $adminPassword,
                'is_admin' => 1,
            ],
            [
                'name' => 'Demo Customer',
                'username' => 'democustomer',
                'email' => 'customer@solipet.demo',
                'password' => $customerPassword,
                'is_admin' => 0,
            ],
        ];

        foreach ($accounts as $account) {
            DB::table('users')->updateOrInsert(
                ['email' => $account['email']],
                [
                    'name' => $account['name'],
                    'username' => $account['username'],
                    'password' => Hash::make($account['password']),
                    'is_admin' => $account['is_admin'],
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}