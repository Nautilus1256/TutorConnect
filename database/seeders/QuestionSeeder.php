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
            'user_id' => 2,
            'title' => '生徒の家庭環境について',
            'body' => '私の担当している生徒さんは、親の仕事が不規則なので生活リズムが整いにくく、勉強にも集中できないようです。同じような生徒さんを抱えている方はいらっしゃいますか。',
            'status' => '解決済み',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
