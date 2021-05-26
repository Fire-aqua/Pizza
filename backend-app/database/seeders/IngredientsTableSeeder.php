<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('ingredients')->insert([
            [
                'name' => 'olives',
                'display_name_ru' => 'Оливки',
                'display_name_en' => 'Olives',
                'is_topping' => true,
                'price' => 1,
            ],
            [
                'name' => 'jalapeno',
                'display_name_ru' => 'Халапеньо',
                'display_name_en' => 'Jalapeno',
                'is_topping' => true,
                'price' => 2,
            ],
            [
                'name' => 'meat',
                'display_name_ru' => 'Мясо',
                'display_name_en' => 'Meat',
                'is_topping' => false,
                'price' => 1,
            ],
            [
                'name' => 'tomato',
                'display_name_ru' => 'Помидоры',
                'display_name_en' => 'Tomato',
                'is_topping' => false,
                'price' => 1,
            ],
            [
                'name' => 'potato',
                'display_name_ru' => 'Картофель',
                'display_name_en' => 'Potato',
                'is_topping' => false,
                'price' => 1,
            ],
        ]);		
    }
}
