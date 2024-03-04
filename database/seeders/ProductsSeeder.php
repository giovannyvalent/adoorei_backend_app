<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'Iphone X',
                'price' => 4000,
                'store_id' => 1,
                'category_id' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'name' => 'Iphone 12 Pró',
                'price' => 6000,
                'store_id' => 1,
                'category_id' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'name' => 'Iphone 15 Titanium',
                'price' => 8000,
                'store_id' => 1,
                'category_id' => 1,
                'created_at' => Carbon::now()
            ]
        ]);

        $this->command->info('Products table seeded!');
    }
}
