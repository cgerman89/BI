<?php
/**
 * Created by PhpStorm.
 * User: Asus-PC
 * Date: 16/1/2019
 * Time: 17:07
 */

namespace App\Helpers;

use App\Connect\Mongodb;
use App\file_upload;
use BenTools\ETL\Extractor\KeyValueExtractor;
use BenTools\ETL\Runner\ETLRunner;
use BenTools\ETL\Loader\ArrayLoader;
use App\ETL\Transformer\TitleDataTransformer;
use App\Connect\Base;
use Yajra\DataTables\Html\Builder;

class TableHelper {

    public static function getColumns($schema,$table){
           Base::GetRegister();
           $resp = Base::GetColumnsTable($schema,$table)->pluck('columns')->toArray();
           $title = self::ConvertirTitle($resp);
           return $title;
    }
    private static function ConvertirTitle( array &$items = [] ){
           foreach ( $items as $item):
              $data[] = ucwords( strtolower( $item) );
           endforeach;
        return $data;
    }

    public static function getColumnsData($key):array {
        $data =  Mongodb::getColumnsCollection($key);
        $title = array_keys(  $data );
        return  self::ConvertirTitle(  $title );
    }

    public static function ConvertirTitleData($data){
        $extractor = new  KeyValueExtractor();
        $loader    = new  ArrayLoader();
        $runner    = new  ETLRunner();
        $transformer = new TitleDataTransformer();
        $runner($data,$extractor,$transformer,$loader);
        return  $loader->getArray();
    }


    public static function getAllData($key){
        $resp = Mongodb::getAllDataCollection($key);
        return  collect( self::ConvertirTitleData($resp) );
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public static function generateHmtlJsFile(Builder $builder){

        $first = file_upload::first()->toArray();

        unset( $first['_id'] );

        $columns =  array_keys( $first );

        $html = $builder->parameters(["destroy" => true, "paging" => false, "searching" => false, "ordering" => false , "autoWidth" => true, "scrollCollapse" => true, "scrollX" => true, "responsive" => true, "processing" => true, "serverSide" => true])
                        ->columns( $columns )
                        ->Ajax('file/getData')
                        ->addTableClass('table small table-responsive table-hover table-bordered');
        return $html;
    }

    /**
     * @return array
     */
    public static function getColumnsFile(){
        $first = file_upload::first()->toArray();

        unset( $first['_id'] );

        return array_keys( $first );
    }

}