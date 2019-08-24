<?php

use Illuminate\Database\Seeder;
use App\Connection;

class ConnectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
      Connection::create([
        'collecction_id' => 3,
        'host' => '179.49.7.197',
        'username'  => 'sa',
        'dbpassword' => 'Andean1234.',
        'dbname' => 'atm',
        'port' => '1433',
        'user_id' => 1
      ]);
    }
}
