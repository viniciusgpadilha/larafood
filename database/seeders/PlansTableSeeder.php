<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name'          => 'Business',
            'url'           => 'Business',
            'price'         => 499.99,
            'description'   => 'Plano Empresarial',
        ]);
    }
}
