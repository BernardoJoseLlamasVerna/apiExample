<?php
/**
 * Created by PhpStorm.
 * User: berni
 * Date: 30/03/18
 * Time: 20:21
 */

namespace App\Http\Transformers;


abstract class Transformer
{

    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($item);

}