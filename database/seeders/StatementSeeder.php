<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load statements data from generated file
        $statements = require __DIR__ . '/StatementsData.php';
        
        // Insert in chunks for better performance
        foreach (array_chunk($statements, 50) as $chunk) {
            DB::table('statements')->insert($chunk);
        }
    }
}
