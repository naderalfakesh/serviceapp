<?php

use Illuminate\Database\Seeder;

class companySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\company::class, 50)->create();
    }
}
