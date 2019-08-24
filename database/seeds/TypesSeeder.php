<?php

use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        App\Type::create(['name' => 'DATABASE MANAGER SYSTEM']);
        App\Type::create(['name'=>'TRANSFORMATIONS']);
        App\Type::create(['name'=>'OPERACIONES GRAFICOS']);

    }
}
