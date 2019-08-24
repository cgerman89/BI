<?php
/**
 * Created by PhpStorm.
 * User: andean
 * Date: 31/08/18
 * Time: 14:34
 */

namespace App\Repositorio;

use App\Mongo_Collection;


class ETLHelper {

    public static function getColl(){
        $id = auth()->id();
        $res = Mongo_Collection::with(['connection.collection'=>function($query){
                 $query->select('id','name');
               },'connection:id,collecction_id,dbname'])
               ->where('user_id','=',$id)->get(['id','key','mongo_etl_id','connection_id']);
        return  $res;
    }

    public static function getCollectionsRegisters()
    {
        $user_id  = auth()->id();
        $mongo_collection = Mongo_Collection::where('user_id',$user_id);
        return $mongo_collection;
    }

    public static function  DeleteMongoCollection_pg($id){
        $resp = Mongo_Collection::destroy($id);
        return $resp;
    }
}