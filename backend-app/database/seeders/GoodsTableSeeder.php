<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goods')->insert([
            [
                'name' => 'marg_b',
                'display_name_ru' => 'Маргарита',
                'display_name_en' => 'Margherita',
                'price' => 10,
                'size' => 'большой',
                'type' => 'pizza',
            ],
            [
                'name' => 'marg_m',
                'display_name_ru' => 'Маргарита',
                'display_name_en' => 'Margherita',
                'price' => 8,
                'size' => 'средний',
                'type' => 'pizza',
            ],
            [
                'name' => 'marg_s',
                'display_name_ru' => 'Маргарита',
                'display_name_en' => 'Margherita',
                'price' => 6,
                'size' => 'маленький',
                'type' => 'pizza',
            ],
            [
                'name' => 'meat_b',
                'display_name_ru' => 'Мясная',
                'display_name_en' => 'Meat',
                'price' => 12,
                'size' => 'большой',
                'type' => 'pizza',
            ],
            [
                'name' => 'meat_m',
                'display_name_ru' => 'Мясная',
                'display_name_en' => 'Meat',
                'price' => 10,
                'size' => 'средний',
                'type' => 'pizza',
            ],
            [
                'name' => 'meat_s',
                'display_name_ru' => 'Мясная',
                'display_name_en' => 'Meat',
                'price' => 8,
                'size' => 'маленький',
                'type' => 'pizza',
            ],
            [
                'name' => 'cheese_b',
                'display_name_ru' => 'Сырная',
                'display_name_en' => 'Cheese',
                'price' => 9,
                'size' => 'большой',
                'type' => 'pizza',
            ],
            [
                'name' => 'cheese_m',
                'display_name_ru' => 'Сырная',
                'display_name_en' => 'Cheese',
                'price' => 7,
                'size' => 'средний',
                'type' => 'pizza',
            ],
            [
                'name' => 'ffb',
                'display_name_ru' => 'Картошка фри',
                'display_name_en' => 'French fries',
                'price' => 6,
                'size' => 'большой',
                'type' => 'additional',
            ],
            [
                'name' => 'ffm',
                'display_name_ru' => 'Картошка фри',
                'display_name_en' => 'French fries',
                'price' => 4,
                'size' => 'средний',
                'type' => 'additional',
            ],
            [
                'name' => 'ffs',
                'display_name_ru' => 'Картошка фри',
                'display_name_en' => 'French fries',
                'price' => 2,
                'size' => 'маленький',
                'type' => 'additional',
            ],
            [
                'name' => 'caesar',
                'display_name_ru' => 'Салат "Цезарь"',
                'display_name_en' => 'French fries',
                'price' => 2,
                'size' => '-',
                'type' => 'additional',
            ],
            [
                'name' => 'ojb',
                'display_name_ru' => 'Апельсиновый сок, 1л',
                'display_name_en' => 'Orange juice, 1q',
                'price' => 4,
                'size' => '-',
                'type' => 'drink',
            ],
            [
                'name' => 'ojm',
                'display_name_ru' => 'Апельсиновый сок, 0,5л',
                'display_name_en' => 'Orange juice, 0,5q',
                'price' => 2,
                'size' => '-',
                'type' => 'drink',
            ],
            
        ]);
    }
}
