<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('questions')->insert([
            'user_id' => 1,
            'title' => '質問のタイトル3',
            'body' => '質問の内容3',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
