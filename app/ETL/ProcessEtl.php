<?php
/**
 * Created by PhpStorm.
 * User: andean
 * Date: 23/07/18
 * Time: 15:58
 */

namespace App\ETL;

use App\ETL\Transformer\OnlyTransformer;
use App\ETL\Transformer\UnionTransformer;
use App\ETL\Transformer\FloatTransformer;
use App\ETL\Transformer\TolowerTransformer;
use App\ETL\Transformer\ToUpperCaseTransformer;
use App\ETL\Transformer\StringTransformer;
use App\ETL\Transformer\IntegerTransformer;
use BenTools\ETL\Extractor\KeyValueExtractor;
use BenTools\ETL\Runner\ETLRunner;
use BenTools\ETL\Loader\ArrayLoader;
use Illuminate\Support\Facades\Cache;


class ProcessEtl {

     /**
     * @var ArrayLoader
     */
    static protected $loader;

    /**
     * @var KeyValueExtractor
     */
    static protected $extractor;

    static protected $transformer;

    /**
     * @var ETLRunner
     */
    static protected $runner;

    /**
     * @param array $data
     * @param string $operation
     * @param array $fields
     * @return array
     */
    public static function Transformer(array $data ,string $operation,array $fields){
         $extractor = new  KeyValueExtractor();
         $loader    = new  ArrayLoader();
         $runner    = new  ETLRunner();
         $transformer = self::GetTransformer($operation,$fields);
         $runner($data,$extractor,$transformer,$loader);
         return $loader->getArray();
    }

    private  static function GetTransformer($operation,$columns){
        switch ($operation){
            case 'ONLY':
                       return new OnlyTransformer($columns);
                       break;
            case  'FLOAT':
                       return new FloatTransformer($columns);
                       break;
            case  'INTEGER':
                       return new IntegerTransformer($columns);
                       break;
            case  'UNION':
                       return new UnionTransformer($columns);
                       break;
            case  'TO_LOWER':
                       return new TolowerTransformer($columns);
                        break;
            case  'TO_UPPER':
                return new ToUpperCaseTransformer($columns);
                break;
            case  'STRING':
                       return new StringTransformer($columns);
                       break;
        }
    }

}