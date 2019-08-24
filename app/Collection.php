<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model{
    protected $fillable = ['type_id','name','father_id','state'];

    protected $hidden = ['created_at','updated_at'];

    function Types(){
        return $this->belongsTo(Type::class);
    }


}
