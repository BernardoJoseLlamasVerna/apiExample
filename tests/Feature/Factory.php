<?php
/**
 * Created by PhpStorm.
 * User: berni
 * Date: 31/03/18
 * Time: 20:13
 */

namespace Tests\Feature;


trait Factory
{
    protected $times = 1;

    protected function times($count)
    {
        $this->times = $count;

        return $this;
    }

    protected function make($type, array $fields =[])
    {
        while($this->times--)
        {
            $stub = array_merge($this->getStub(), $fields);
            $type::create($stub);
        }


    }

}