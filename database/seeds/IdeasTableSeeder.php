<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdeasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ideas')->insert([
            [
                'title' => '新規アイデア',
                'description' => '説明説明これがカードに表示される',
                'body' => '本文本文本文本文本文本文本文本文本文本文本文本文',
                'category_id' => '1',
                'user_id' => '1',
                'img' => null,
                'price' => '500',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => '新規アイデア',
                'description' => '説明説明これがカードに表示される',
                'body' => '本文本文本文本文本文本文本文本文本文本文本文本文',
                'category_id' => '1',
                'user_id' => '1',
                'img' => null,
                'price' => '500',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
