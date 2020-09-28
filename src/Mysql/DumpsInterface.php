<?php


namespace Akuren\Mysql;


interface DumpsInterface
{

    /**
     * @return mixed
     */
    public function dump();



    /**
     * @param string $name
     * @return mixed
     */
    public function filename(string $name);

    /**
     * @param string $DB
     * @return mixed
     */
    public function database(string $DB);

    /**
     * @return mixed
     */
    public function start();

}