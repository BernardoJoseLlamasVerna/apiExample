<?php
/**
 * Created by PhpStorm.
 * User: berni
 * Date: 31/03/18
 * Time: 12:25
 */

use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(){
        $faker = Faker::create();

        foreach (range(1, 1) as $index)
        {
            User::create([
                'name'=> $faker->sentence(5),
                'email' => $faker->paragraph(4),
                'password' => $faker->bcrypt(4)
            ]);
        }
    }


}