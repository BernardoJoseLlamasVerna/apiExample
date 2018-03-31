<?php
/**
 * Created by PhpStorm.
 * User: berni
 * Date: 31/03/18
 * Time: 18:01
 */

namespace Tests\Feature;


use Tests\TestCase;
use Faker\Factory as Faker;
use BadMethodCallException;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class ApiTester extends TestCase
{
    protected $fake;
    protected $times =1;

    function __construct()
    {
        $this->fake = Faker::create();
    }

    public function setUp()
    {
        parent::setUp();

        $this->app['artisan']->call('migrate');
    }

    protected function getJson($uri, $method ='GET', $parameters= [])
    {
        return json_decode($this->call($method, $uri, $parameters)->getContent());
    }


    protected function assertObjectHasAttributes()
    {
        $args = func_get_args();
        $object = array_shift($args);

        foreach ($args as $attribute)
        {
            $this->assertObjectHasAttribute($attribute, $object);
        }

    }

    protected function getStub()
    {
        throw new BadMethodCallException('Create your own getStub method to declare your fields.');
    }

}