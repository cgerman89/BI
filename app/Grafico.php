<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Grafico extends Model{

    protected $table = 'grafico';

    protected $fillable = [
        'key_data',
        'operation',
        'dimension',
        'medida',
        'title_graphic',
        'title_dataset',
        'type',
        'dashboard_id'];

    protected $hidden = ['created_at','updated_at'];


    public function dashboard(){
        return $this->belongsTo(Dashboard::class,'dashboard_id');
    }

    public static function getDashboard(){
        $user_id = auth()->id();
        $connection_id = Session('id_conn2');
        return DB::table('grafico')
                   ->join('dashboard','grafico.dashboard_id','=','dashboard.id')
                   ->where('dashboard.user_id','=',$user_id)
                   ->where('dashboard.connection_id','=',$connection_id)
                   ->get(['grafico.id','grafico.key_data','grafico.operation','grafico.dimension','grafico.medida','grafico.title_graphic','grafico.title_dataset','grafico.type','grafico.dashboard_id','dashboard.name as dashboard_name']);
    }


}
