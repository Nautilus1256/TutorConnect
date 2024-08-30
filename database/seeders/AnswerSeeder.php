<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('answers')->insert([
            'user_id' => 2,
            'question_id' => 1,
            'comment' => 'やっぱり分かりませんでした。',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
