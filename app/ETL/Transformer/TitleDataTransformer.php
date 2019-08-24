<?php
/**
 * Created by PhpStorm.
 * User: Asus-PC
 * Date: 17/1/2019
 * Time: 14:56
 */

namespace App\ETL\Transformer;

use BenTools\ETL\Context\ContextElementInterface;
use BenTools\ETL\Transformer\TransformerInterface;
use Illuminate\Support\Str;

class TitleDataTransformer implements TransformerInterface{


    /**
     * Transforms data and hydrates element (should call $element->setData())
     *
     * @param ContextElementInterface $element
     */
    public function __invoke(ContextElementInterface $element): void {
              foreach ($element->getData() as $key => $value):
                  $data[  ucwords( strtolower( $key) ) ] = $value ;
              endforeach;
            $element->setData($data);
    }
}
