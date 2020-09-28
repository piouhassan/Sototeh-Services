<?php
namespace AkConfig\config;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;


class Eloquent
{

    public static function load()
    {
        $capsule = new Capsule;


        $capsule->addConnection(
            Config::DB()
        );

// Set the event dispatcher used by Eloquent models... (optional)


        $capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }
}