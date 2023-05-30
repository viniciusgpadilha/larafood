<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Felipe',
            'email' => 'felipe@f.com.br',
            'password' => bcrypt('123456'),
        ]);
    }
}
