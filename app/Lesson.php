<?php
/**
 * Created by PhpStorm.
 * User: berni
 * Date: 30/03/18
 * Time: 16:59
 */

namespace App;


class Lesson extends \Eloquent
{
    protected $fillable = ['title', 'body'];
}