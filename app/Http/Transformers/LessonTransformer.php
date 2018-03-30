<?php
/**
 * Created by PhpStorm.
 * User: berni
 * Date: 30/03/18
 * Time: 20:25
 */

namespace App\Http\Transformers;


class LessonTransformer extends Transformer
{
    public function transform($lesson)
    {
        return [
            'title'  => $lesson['title'],
            'body'   => $lesson['body'],
            'active' => (boolean) $lesson['some_bool']
        ];

    }



}