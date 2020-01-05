<?php

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Categorie::class, 20)->create();
    }
}
