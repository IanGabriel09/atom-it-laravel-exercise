<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 5; $i++) {
            DB::table('posts')->insert([
                'title' => "Sample Task $i",
                'content' => str::random(100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
