<?php

namespace Database\Seeders;

use App\Models\Batch;
use Illuminate\Database\Seeder;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1948 থেকে 2026 পর্যন্ত loop
        for ($year = 1948; $year <= 2026; $year++) {
            Batch::create([
                'name' => $year,
            ]);
        }
    }
}
