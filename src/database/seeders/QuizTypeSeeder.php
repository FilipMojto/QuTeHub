<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuizTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Quiz',
            'Test',
            'Questionnaire'
        ];

        $now = Carbon::now();

        for ($i = 0; $i < count($types); $i++){
            DB::table('quiz_types')->updateOrInsert(
                ['type' => $types[$i]],
                ['created_at' => $now, 'updated_at' => $now]
            );
        }
    }
}
