<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Mongo_Collection extends Model {

    protected $table ="mongo_collections";

    protected $fillable = ['key','user_id','connection_id'];

    protected $guarded = ['created_at','updated_at'];


    //se relaciona con un usuario
    function User(){
        return $this->belongsTo(User::class,'user_id');
    }



}
