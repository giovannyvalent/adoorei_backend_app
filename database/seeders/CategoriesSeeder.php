<?php

namespace Database\Seeders;

use App\Models\Categories;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            [
                'id' => 1,
                'name' => 'Smartphones',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'name' => 'TVs',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'name' => 'Eletrodomésticos',
                'created_at' => Carbon::now()
            ]
        ]);

        $this->command->info('Categories table seeded!');
    }
}
