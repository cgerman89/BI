<?php
/**
 * Created by PhpStorm.
 * User: andean
 * Date: 21/08/18
 * Time: 16:45
 */

namespace App\ETL\Transformer;

use BenTools\ETL\Context\ContextElementInterface;
use BenTools\ETL\Transformer\TransformerInterface;

class DateTransformer implements TransformerInterface {
    /**
     * @var array
     */
    protected $items;

    public function __construct(array &$items = []){
        $this->items  = $items;
    }


    public function __invoke(ContextElementInterface $element): void {
        $data = $element->getData();
        foreach ($data as $key => $value){
            $rows[$key] = $this->Convert($key,$value);
        }
        $element->setData($rows);
    }

    private  function  Convert($key,$value){
        return in_array($key,$this->items)?
            is_numeric($value)?
                number_format(floatval($value), 2, '.', ',')
                :$value
            :$value;
    }
}