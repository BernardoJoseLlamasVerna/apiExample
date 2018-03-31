<?php
/**
 * Created by PhpStorm.
 * User: berni
 * Date: 31/03/18
 * Time: 17:00
 */

namespace App\Http\Transformers;


class TagTransformer extends Transformer
{
    public function transform($tag)
    {
        return [
            'name'  => $tag['name']
        ];

    }
}