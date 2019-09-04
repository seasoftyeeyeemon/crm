<?php

use Illuminate\Database\Seeder;
use App\Prospect;

class ProspectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 30;
        factory(Prospect::class, $count)->create();
       
    }
    
}
