<?php
/**
 * Created by PhpStorm.
 * User: Asus-PC
 * Date: 23/1/2019
 * Time: 12:59
 */

namespace App\Helpers;

use App\Connect\Base;
use App\Connect\Mongodb;
use App\file_upload;
use App\ETL\ProcessEtl;
use App\ExcellFile\ExcellFile;
use App\Mongo_Collection;
use App\Collecciones;
use App\Type;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ExtractHelper  {

      public static function SelectData($schema,$table,$columns){
         Base::GetRegister();
         return Base::getRegistros($schema,$table,$columns);
      }

      public static function ProcessData($key,$operations,$columns){
          $data = Mongodb::getDataCollection($key,$columns);
          return  ProcessEtl::Transformer( $data ,$operations,$columns);
      }

    /**
     * @param  string $NameKey
     * @return bool
     */
      public static function InsertTableMongoCollection($NameKey)
      {
          $mongo_collection = new Mongo_Collection();

          $user_id = auth()->id();

          $mongo_collection->key = $NameKey;
          $mongo_collection->user_id = $user_id;
          //save
           return $mongo_collection->save();
      }

    /**
     * @param $nameCollection string
     * @param $data array
     */
      public static function InsertCollectionMongo($nameCollection, $data)
      {
          $obj_Coll = new Collecciones();

          $obj_Coll->setCollection($nameCollection);

          $obj_Coll->fill($data);

          $obj_Coll->save();

      }

    /**
     * @return Collection
     */
      public static function getListMongoCollection()
      {
          $user_id = auth()->id();

          return Mongo_Collection::where('user_id',$user_id)->get(['key']);

      }


      public static function ImportDataFile(ExcellFile $excellFile ,string $path, string $extension)
      {

              if($extension == "xlsx")
              {
                  $excellFile->import($path, null, \Maatwebsite\Excel\Excel::XLSX);
              }

              if ($extension == "csv")
              {
                  $excellFile->import($path, null, \Maatwebsite\Excel\Excel::CSV);
              }

              if ( $extension == "xls" )
              {
                  $excellFile->import($path, null, \Maatwebsite\Excel\Excel::XLS);
              }
      }

    /**
     * @return mixed
     */
      public static function getDataFile(){
          return file_upload::take(5)->get();
      }

    /**
     * @param $schema string
     * @param $table string
     * @param $columns array
     * @return Collection
     */
      public static function getTypeColumns($schema, $table, $columns)
      {
          Base::GetRegister();
          return Base::getColumnsType($schema, $table, $columns);
      }

      private static function convertType( $value, $type)
      {
            if ($type == 'int' )
            {
                return (int) $value;
            }
            if ( $type == 'decimal' )
            {
                return  number_format( floatval($value) , 4, '.','');
            }
            return $value;
      }




}