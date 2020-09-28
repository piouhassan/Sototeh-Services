<?php


namespace Akuren\Query;



use AkConfig\Config;
use Foolz\SphinxQL\Drivers\Pdo\Connection;
use Foolz\SphinxQL\Percolate;
use Foolz\SphinxQL\SphinxQL;

class Query
{
    /**
     * @return SphinxQL
     */
    public static function SphinxQL ()
    {
        $conn = new Connection();
        $conn->setParams(array(Config::DB()));
        return (new SphinxQL($conn));
    }

    /**
     * @return Percolate
     */
    public static function Percolate ()
    {
        $conn = new Connection();
        $conn->setParams(array(Config::DB()));
        return (new Percolate($conn));
    }
    }