<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model{
    protected $fillable = ['collecction_id','host','username','dbpassword','dbname','port','user_id'];

    //se relaciona a un type de  una coleccion
    function Collection(){
        return $this->belongsTo(Collection::class,'collecction_id');
    }

    //se relaciona con un usuario
    function User(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function Mongo_Collection(){
        return $this->hasMany(Mongo_Collection::class);
    }

    public function Dashboard(){
        return $this->hasMany(Dashboard::class);
    }
}
