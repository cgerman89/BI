<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Collecciones extends Eloquent
{

    protected $connection = 'mongodb';

    protected $fillable = [];

    protected $guarded = [];

    protected $collection;

    public $timestamps = false;

    public function setCollection( string $collection )
    {
        $this->collection = $collection;
    }

    public  function getCollection():string
    {
        return  $this->collection;
    }

}
