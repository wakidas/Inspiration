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
                'title' => '新規アイデア1',
                'description' => '説明説明これがカードに表示される',
                'body' => '本文本文本文本文本文本文本文本文本文本文本文本文',
                'category_id' => '1',
                'user_id' => '1',
                'img' => null,
                'price' => '5000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => '新規アイデア2',
                'description' => '説明説明これがカードに表示される',
                'body' => '本文本文本文本文本文本文本文本文本文本文本文本文',
                'category_id' => '1',
                'user_id' => '1',
                'img' => null,
                'price' => '8000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => '新規アイデア3',
                'description' => '説明説明これがカードに表示される',
                'body' => '本文本文本文本文本文本文本文本文本文本文本文本文',
                'category_id' => '1',
                'user_id' => '1',
                'img' => null,
                'price' => '15000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => '新規アイデア4',
                'description' => '説明説明これがカードに表示される',
                'body' => '本文本文本文本文本文本文本文本文本文本文本文本文',
                'category_id' => '1',
                'user_id' => '1',
                'img' => null,
                'price' => '100000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => '新規アイデア5',
                'description' => '説明説明これがカードに表示される',
                'body' => '本文本文本文本文本文本文本文本文本文本文本文本文',
                'category_id' => '1',
                'user_id' => '1',
                'img' => null,
                'price' => '30000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => '新規アイデア6',
                'description' => '説明説明これがカードに表示される',
                'body' => '本文本文本文本文本文本文本文本文本文本文本文本文',
                'category_id' => '1',
                'user_id' => '1',
                'img' => null,
                'price' => '20000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => '新規アイデア7',
                'description' => '説明説明これがカードに表示される',
                'body' => '本文本文本文本文本文本文本文本文本文本文本文本文',
                'category_id' => '1',
                'user_id' => '1',
                'img' => null,
                'price' => '10000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => '新規アイデア8',
                'description' => '説明説明これがカードに表示される',
                'body' => '本文本文本文本文本文本文本文本文本文本文本文本文',
                'category_id' => '1',
                'user_id' => '1',
                'img' => null,
                'price' => '30000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => '新規アイデア9',
                'description' => '説明説明これがカードに表示される',
                'body' => '本文本文本文本文本文本文本文本文本文本文本文本文',
                'category_id' => '1',
                'user_id' => '1',
                'img' => null,
                'price' => '20000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => '新規アイデア10',
                'description' => '説明説明これがカードに表示される',
                'body' => '本文本文本文本文本文本文本文本文本文本文本文本文',
                'category_id' => '1',
                'user_id' => '1',
                'img' => null,
                'price' => '10000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
