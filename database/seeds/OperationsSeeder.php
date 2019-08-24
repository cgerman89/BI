<?php

use Illuminate\Database\Seeder;

class OperationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Collection::create([
            'type_id' => 2,
            'name' => 'ONLY'
        ]);
        App\Collection::create([
            'type_id' => 2,
            'name' => 'FLOAT'
        ]);
        App\Collection::create([
            'type_id' => 2,
            'name' => 'STRING'
        ]);
        App\Collection::create([
            'type_id' => 2,
            'name' => 'INTEGER'
        ]);
        App\Collection::create([
            'type_id' => 2,
            'name' => 'TO_LOWER'
        ]);
        App\Collection::create([
            'type_id' => 2,
            'name' => 'TO_UPPER'
        ]);
        App\Collection::create([
            'type_id' => 2,
            'name' => 'UNION'
        ]);
        App\Collection::create([
            'type_id' => 2,
            'name' => 'DATE'
        ]);

        App\Collection::create([
            'type_id' => 3,
            'name' => 'SUM'
        ]);

        App\Collection::create([
            'type_id' => 3,
            'name' => 'COUNT'
        ]);

        App\Collection::create([
            'type_id' => 3,
            'name' => 'AVG'
        ]);
    }
}
