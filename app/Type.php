<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model{
    protected  $fillable = ['name'];

    // un typo tiene muchas colecciones
    function Collections(){
        return $this->hasMany(Collection::class);
    }
}
