<?php

namespace Database\Seeders;

use App\Models\AuthorModel;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'J.R.R Tolkien',
            'George Orwell',
            'Jane Austen',
            'J.K. Rowling',
            'Stephen King',
            'Agatha Christie',
            'Ernest Hemingway',
            'Leo Tolstoy',
            'Mark Twain',
            'F. Scott Fitzgerald',
            'Charles Dickens',
        ];

        foreach ($names as $name) {
            AuthorModel::create(['name' => $name]);
        }
    }
}
