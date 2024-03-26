<?php

namespace Database\Seeders;

use App\Models\ProgramActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgramActivity::factory(150)->create();
    }
}
