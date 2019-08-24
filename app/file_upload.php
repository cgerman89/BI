<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class file_upload extends Eloquent {

    protected $connection = 'mongodb';

    protected $fillable = [];

    protected $guarded = [];

    public $timestamps = false;

}
