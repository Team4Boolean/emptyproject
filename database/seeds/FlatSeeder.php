<?php

use Illuminate\Database\Seeder;

use App\Flat;
use App\User;
use App\Service;

class FlatSeeder extends Seeder
{

    public function run()
    {
      factory(Flat::class, 100)
      -> make() // genera 100 istanze del model Flat
      -> each(function($flat) {
        $usr = User::inRandomOrder() -> first();
        $flat -> user() -> associate($usr);
        $flat -> save();

        $serv = Service::inRandomOrder()
            -> take(rand(0, 6))
            -> get();
        $flat -> services() -> attach($serv);
      });
    }

}
