<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(productSeeder::class);
        $this->call(companySeeder::class);
        $this->call(contactSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
