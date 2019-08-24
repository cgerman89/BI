<?php

use App\User;
use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){


        App\User::create([
            'name' => 'Cristian Gérman',
            'email' => 'cgerman.fs@gmail.com',
            'password' => bcrypt('german')
        ]);

        App\User::create([
            'name' => 'Diego Condor',
            'email' => 'dcondor@andeantrade.com',
            'password' => bcrypt('12345')
        ]);
        App\User::create([
            'name' => 'Edison Heredia',
            'email' => 'eheredia@andeantrade.com',
            'password' => bcrypt('12345')
        ]);

        App\User::create([
            'name' => 'Nelio',
            'email' => 'rciguencia@andeantrade.com',
            'password' => bcrypt('12345')
        ]);

        App\User::create([
            'name' => 'Defensoria Publica',
            'email' => 'dpublica@email.com',
            'password' => bcrypt('12345')
        ]);

        Role::create([
            'name' => 'ADMIN',
            'slug' => 'admin',
            'description' =>'aceso a todo',
            'special' => 'all-access'
        ]);

    }
}
