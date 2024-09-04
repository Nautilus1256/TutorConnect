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
            'category_type_id' => 1,
            'name' => '国語',
        ]);
        DB::table('categories')->insert([
            'category_type_id' => 1,
            'name' => '算数',
        ]);
        DB::table('categories')->insert([
            'category_type_id' => 1,
            'name' => '理科',
        ]);
        DB::table('categories')->insert([
            'category_type_id' => 1,
            'name' => '社会',
        ]);
        DB::table('categories')->insert([
            'category_type_id' => 2,
            'name' => '小学生',
        ]);
        DB::table('categories')->insert([
            'category_type_id' => 2,
            'name' => '中学生',
        ]);
        DB::table('categories')->insert([
            'category_type_id' => 2,
            'name' => '高校生',
        ]);
    }
}
