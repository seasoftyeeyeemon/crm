<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name'=>'Marketing',
            'description'=>'This is marketing channel',
        ]);
        Tag::create([
            'name'=>'Programming',
            'description'=>'This is programming channel',
        ]);
        Tag::create([
            'name'=>'Language',
            'description'=>'This is language channel',
        ]);
    }
}
