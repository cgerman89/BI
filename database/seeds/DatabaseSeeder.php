<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
       $this->call(UsersSeeder::class);
       $this->call(TypesSeeder::class);
       $this->call(CollectionsSeeder::class);
       $this->call(OperationsSeeder::class);
       $this->call(ConnectionsSeeder::class);
       $this->call(PermissionTablesSeed::class);
    }
}
