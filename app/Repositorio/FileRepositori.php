<?php


namespace App\Repositorio;

use App\Connect\Mongodb;
use App\Mongo_Collection;
use App\file_upload;
use App\Helpers\ExtractHelper;

class FileRepositori {

    public static function ClearFileUpload(){
        return file_upload::query()->delete();
    }

    public static function storeExtractFile(string $nameKey, array $fields ){
        $res = file_upload::get($fields)->toArray();

            foreach ( $res as $item):

                unset( $item['_id'] );

                Mongodb::InsertMongo( $nameKey , (Array) $item );

            endforeach;

        ExtractHelper::InsertTableMongoCollection( $nameKey );

    }

    public static function existKey( string $nameKey)
    {
        return Mongo_Collection::where('key',$nameKey)
                                ->count();
    }



}