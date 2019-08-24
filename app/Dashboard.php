<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model{
    protected $table = 'dashboard';
    protected $fillable = ['name','description','user_id'];
    protected $hidden = ['created_at','updated_at'];

    public function user(){
      return $this->belongsTo(User::class,'user_id');
    }

    public function graphic(){
        return $this->hasMany(Grafico::class);
    }

}
