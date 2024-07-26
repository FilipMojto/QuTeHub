<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $subjects = [
            'Math',
            'Geography',
            'Language',
            'History',
            'Science',
            'Biology',
            'Chemistry',
            'Physics'
        ];
    
        foreach ($subjects as $subject) {
            DB::table('subjects')->updateOrInsert(
                ['subject' => $subject], // Condition to find the record
                ['created_at' => $now, 'updated_at' => $now] // Values to update or insert
            );
        }


        
    }
}