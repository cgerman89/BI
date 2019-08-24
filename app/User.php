<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;

class User extends Authenticatable {

    use Notifiable, HasRolesAndPermissions;

    /**
     * @var array
     */
      protected  $fillable = ['name','email','password'];

    /**
     * @var array
     */
      protected $hidden = ['password', 'remember_token'];

      //tiene muchas connexions
      public function Connection(){
          return $this->hasMany(Connection::class);
      }

     public function Mongo_Collection(){
        return $this->hasMany(Mongo_Collection::class);
     }

     public function Dashboard(){
         return $this->hasMany(Dashboard::class);
     }


}
