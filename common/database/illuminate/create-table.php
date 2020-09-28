<?php
       require_once  __DIR__.'/../vendor/autoload.php';


          use Illuminate\Database\Capsule\Manager;

           Manager::schema()->dropIfExists('users');
           Manager::schema()->create('users', function ($table){
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamps();
        });


