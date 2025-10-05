<?php

namespace Database\Seeders;

use App\Models\BeamerAccess;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeamerAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BeamerAccess::factory()->count(20)->create();
    }
}
