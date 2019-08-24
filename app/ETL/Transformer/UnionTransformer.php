<?php
/**
 * Created by PhpStorm.
 * User: andean
 * Date: 23/07/18
 * Time: 15:23
 */

namespace App\ETL\Transformer;

use BenTools\ETL\Context\ContextElementInterface;
use BenTools\ETL\Transformer\TransformerInterface;

class UnionTransformer implements  TransformerInterface{
    /**
     * @var array
     */
    protected $array;

    /**
     * @var string
     */
    protected $name;

    public function __construct(array &$array = [],$name = 'unionField')
    {
        $this->array = $array;
        $this->name  = $name;
    }
    public function __invoke(ContextElementInterface $element): void
    {
        $data = (Array) $element->getData();
        foreach ($this->array as $key):
            $union[] = data_get($data,$key);
        endforeach;
        foreach($this->array as $key){
            unset($data[$key]);
        }
        $res = implode($union);
        $element->setData(array_add($data,$this->name,$res));
    }

}