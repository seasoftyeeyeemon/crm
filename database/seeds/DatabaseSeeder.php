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
        $this->call(UsersTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(ProspectsTableSeeder::class);
        $this->call(ArticlesSeeder::class);
        $this->call(TagsTableSeeder::class);
        factory(App\User::class,50)->create();
    }
}
