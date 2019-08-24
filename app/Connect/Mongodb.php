<?php
/**
 * Created by PhpStorm.
 * User: andean
 * Date: 28/08/18
 * Time: 10:38
 */

namespace App\Connect;


use Illuminate\Support\Facades\DB;


class Mongodb  {

    /**
     * @param string $key
     * @param array $columns
     * @return array
     */
    public static function  getDataCollection( string $key, Array $columns){
        $data = DB::connection('mongodb')
                  ->table($key)
                  ->get($columns)
                  ->toArray();
        return $data;
    }

    /**
     * @param string $key
     * @return \Illuminate\Support\Collection
     */
    public static function  getAllDataCollection(string $key){
        return DB::connection('mongodb')
               ->table($key)
               ->get();
    }

    /**
     * @param $collection string
     * @param $dimension
     * @param $medida
     * @return \Illuminate\Database\Query\Expression
     */
    public static function getSum($collection, $dimension, $medida){
          $cursor = DB::connection('mongodb')->table($collection)
                  ->raw(function ($collection) use ($dimension,$medida){
                        return $collection->aggregate([
                                   [ '$group' =>
                                       [  '_id' => [
                                           $dimension =>'$'.$dimension],
                                           $medida =>['$sum' => [ '$toDecimal' => '$'.$medida] ] ]
                                   ],
                                   [ '$project' =>
                                       [
                                           $dimension => '$_id.'.$dimension,
                                           $medida => '$'.$medida,
                                           '_id' => 0
                                       ]
                                   ],
                                   [ '$sort' => [ $dimension => -1 ]]
                               ]);
                  });
          foreach ( $cursor->toArray() as $item ):
                   $aux[] = [ $dimension => $item->getArrayCopy()[$dimension], $medida => $item->getArrayCopy()[$medida]->__toString()];
          endforeach;
          return $aux;
    }


    /**
     * @param $collection string
     * @param $dimension
     * @param $medida
     * @return \Illuminate\Database\Query\Expression
     */
    public static function getCount($collection, $dimension, $medida){
        return  DB::connection('mongodb')
            ->table($collection)->raw(function ($collection) use ($dimension,$medida){
                return $collection->aggregate([
                    ['$match' => [$dimension => [ '$ne' => null ] ]  ],
                    ['$group' => ['_id' => [ $dimension => '$'.$dimension ], 'Count('.$medida.')' => ['$sum' => 1] ] ],
                    ['$project' => [ $dimension => '$_id.'.$dimension, $medida =>'$Count('.$medida.')','_id' => 0 ]],
                    ['$sort' => ['_id'=> -1 ] ],
                    ['$limit' => 100]
                ])->toArray();
            });
    }

    public static function getAvg($collection, $dimension, $medida){
        return  DB::connection('mongodb')
            ->table($collection)->raw(function ($collection) use ($dimension,$medida){
                return $collection->aggregate([
                    ['$match' => [$dimension => [ '$ne' => null ]]  ],
                    ['$group' => ['_id' => [ $dimension => '$'.$dimension ], 'AVG('.$medida.')' => ['$avg' => '$'.$medida] ] ],
                    ['$project' => [$dimension => '$_id.'.$dimension, $medida =>'$AVG('.$medida.')','_id' => 0 ]],
                    ['$sort' => ['_id'=> -1 ] ],
                    ['$limit' => 100]
                ])->toArray();
            });
    }


    /**
     * @param string $key
     * @param array $rows
     * @return bool
     */
    public static function InsertMongo(string $key, $rows){
       return DB::connection('mongodb')->table($key)->insert($rows);
    }

    /**
     * @param string $key
     * @param array $rows
     * @return int
     */
    public static function UpdateDataCollection(string $key, Array $rows){
         $id = $rows['_id'];
         unset($rows['_id']);
         return DB::connection('mongodb')->table($key)
               ->where('_id',$id)
               ->update($rows);
    }

    /**
     * @param string $key
     * @return array
     */
    public static function getColumnsCollection(string $key){
           $col = DB::connection('mongodb')->table($key)->first();
           unset($col['_id']);
           return (Array) $col;
    }

    public function CheckKey($key){
        $count = DB::connection('mongodb')->table($key)->count();
        return $count;
    }

    public function getInfo($key){
         $obj_base_mg = DB::connection('mongodb')->getMongoDB();
         $cursor =  $obj_base_mg->command(['collStats' => $key ,'scale' => 1024]);
         $info  = $cursor->toArray()[0]->jsonSerialize();
         return [ 'name' => $info->ns,'count' => $info->count,'size' => $info->size ];
    }

    public function Exist($Key){
        $obj_base_mg = DB::connection('mongodb')->getMongoDB();
        $cursor =  $obj_base_mg->command(['listCollections' => 1 , 'nameOnly' => true]);
        $name   =   array_pluck($cursor->toArray(),'name');
        return   in_array($Key,$name) ? true : false ;
    }


    public function Drop($key){
        $obj_base_mg = DB::connection('mongodb')->getMongoDB();
        $resp = $obj_base_mg->dropCollection($key);
        return $resp->ok;
    }



}