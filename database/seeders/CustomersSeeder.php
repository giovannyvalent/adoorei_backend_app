<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            [
                'id' => 1,
                'name' => 'Giovanny Valente (Cliente)',
                'email' => 'giovanny@adoorei.com.br',
                'created_at' => Carbon::now()
            ]
        ]);

        $this->command->info('Customers table seeded!');
    }
}
