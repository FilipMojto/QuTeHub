<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DifficultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        
        DB::table('difficulties')->updateOrInsert(
            ['level' => 'Easy'],
            ['created_at' => $now, 'updated_at' => $now]
        );

        DB::table('difficulties')->updateOrInsert(
            ['level' => 'Moderate'],
            ['created_at' => $now, 'updated_at' => $now]
        );

        DB::table('difficulties')->updateOrInsert(
            ['level' => 'Hard'],
            ['created_at' => $now, 'updated_at' => $now]
        );
    }
}