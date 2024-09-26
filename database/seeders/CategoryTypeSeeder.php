<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_types')->insert([
            'name' => '教科',
        ]);
        DB::table('category_types')->insert([
            'name' => '学年',
        ]);
        DB::table('category_types')->insert([
            'name' => '環境',
        ]);
    }
}