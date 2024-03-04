<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
            [
                'id' => 1,
                'company_name' => 'ZetaByte e-commerce',
                'company_document' => '00000000000/00',
                'status' => 'active',
                'plan_name' => 'escala',
                'plan_price' => '497.00',
                'plan_tax' => '1.5',
                'created_at' => Carbon::now()
            ]
        ]);

        $this->command->info('Stores table seeded!');
    }
}
