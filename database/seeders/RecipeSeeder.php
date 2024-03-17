<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Models\Recipe::factory(5)->create();
    }
}
