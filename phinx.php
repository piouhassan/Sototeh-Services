<?php


use AkConfig\config\Config;

return [
  'paths' => [
          'migrations' =>  __DIR__."/common/database/migrations",
          "seeds"   => __DIR__."/common/database/seeds"
  ] ,

  'environments'   => [
         'default_database'  => 'development',
      'development' => [
         "adapter" => "mysql" ,
        "host" =>  Config::DB_HOST,
        "name" => Config::DB_NAME,
        "user" => Config::DB_USER,
        "pass" => Config::DB_PASS,
        "port" => Config::DB_PORT,
        "charset" => Config::DB_CHARSET
      ]
  ]
];

