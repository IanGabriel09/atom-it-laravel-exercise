<?php

namespace Database\Seeders;

use App\Models\AdminModel;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert data into the users table
        AdminModel::create([
            'username' => '001',
            'password' => Hash::make('admin_123'),
        ]);
    }
}
