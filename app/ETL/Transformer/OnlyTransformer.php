<?php
/**
 * Created by PhpStorm.
 * User: andean
 * Date: 23/07/18
 * Time: 14:28
 */

namespace App\ETL\Transformer;

use BenTools\ETL\Context\ContextElementInterface;
use BenTools\ETL\Transformer\TransformerInterface;

class OnlyTransformer implements TransformerInterface{

    /**
     * @var array
     */
    protected $items;


    public function __construct(array $items = []){
         $this->items  = $items;
    }

    public function __invoke(ContextElementInterface $element): void {

           $only = array_only($element->getData(), array_values( $this->items ));
           $element->setData($only);
    }








}