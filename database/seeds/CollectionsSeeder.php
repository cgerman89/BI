<?php

use Illuminate\Database\Seeder;

class CollectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        App\Collection::create([
            'type_id' => 1,
            'name' => 'MYSQL'
        ]);
        App\Collection::create([
            'type_id' => 1,
            'name' => 'POSTGRES'
        ]);
        App\Collection::create([
            'type_id' => 1,
            'name' => 'SQL SERVER'
        ]);
    }
}
