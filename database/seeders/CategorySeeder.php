<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('primary_categories')->insert([
            [
                'name' => 'パソコン',
                'sort_order' => 1,
            ],
            [
                'name' => 'プリンタ',
                'sort_order' => 2,
            ],
            [
                'name' => 'PCアクセサリー',
                'sort_order' => 2,
            ],
        ]);

        DB::table('secondary_categories')->insert([
            [
                'primary_category_id' => 1,
                'name' => 'ノートパソコン',
                'sort_order' => 1,
            ],
            [
                'primary_category_id' => 1,
                'name' => 'ディスクトップパソコン',
                'sort_order' => 2,
            ],
            [
                'primary_category_id' => 1,
                'name' => 'ステックPC',
                'sort_order' => 3,
            ],
            [
                'primary_category_id' => 2,
                'name' => 'インクジェットプリンタ',
                'sort_order' => 4,
            ],
            [
                'primary_category_id' => 2,
                'name' => 'レーザープリンタ',
                'sort_order' => 5,
            ],
            [
                'primary_category_id' => 2,
                'name' => 'フォトプリンタ',
                'sort_order' => 6,
            ],
            [
                'primary_category_id' => 3,
                'name' => 'マウス',
                'sort_order' => 7,
            ],
            [
                'primary_category_id' => 3,
                'name' => 'キーボード',
                'sort_order' => 8,
            ],
            [
                'primary_category_id' => 3,
                'name' => 'webカメラ',
                'sort_order' => 9,
            ],
        ]);
    }
}
