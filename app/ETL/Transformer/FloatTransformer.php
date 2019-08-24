<?php
/**
 * Created by PhpStorm.
 * User: andean
 * Date: 23/07/18
 * Time: 14:34
 */

namespace App\ETL\Transformer;

use BenTools\ETL\Context\ContextElementInterface;
use BenTools\ETL\Transformer\TransformerInterface;

class FloatTransformer implements TransformerInterface{
     /**
     * @var array
     */
     protected $items;

     public function __construct(array &$items = [])
     {
         $this->items  = $items;
     }

    public function __invoke(ContextElementInterface $element): void
    {
        $data = $element->getData();
        foreach ($data as $key => $value)
        {
            $rows[$key] = $this->Convert($key,$value);
        }
        $element->setData($rows);
     }

    private  function  Convert($key,$value)
    {
       if ( !in_array($key, $this->items) )
       {
         return $value;
       }
       $float_number = (float) $value;
       return $float_number;
    }
}