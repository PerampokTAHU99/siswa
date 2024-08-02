<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed the 'siswa' table with 50 fake records
        \App\Models\Siswa::factory(50)->create();
    }
}

