<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'category_type_id' => 3,
            'name' => '保護者/家庭',
        ]);
        DB::table('categories')->insert([
            'category_type_id' => 3,
            'name' => '時間管理',
        ]);
        DB::table('categories')->insert([
            'category_type_id' => 3,
            'name' => '教材',
        ]);
        DB::table('categories')->insert([
            'category_type_id' => 3,
            'name' => 'メンタルケア',
        ]);
    }
}
