<?php


namespace Akuren\Mysql;


use AkConfig\App;
use Akuren\Mysql\Ifsnop\Mysqldump\Mysqldump;


class Dumps implements DumpsInterface
{


    private $database;


    private $filename;

    private  $myRoot ;



    public static function data(string $database)
    {
        return (new Dumps())->database($database);
    }

    /**
     * @return Mysqldump
     * @throws \Exception
     */
    public function start ()
    {
       try{
           $dump =  new Mysqldump("mysql:host=".App::DB_HOST.";dbname=".$this->database, App::DB_USER, App::DB_PASS);
           return $dump;
       }catch (\Exception $exception){
           throw new \Exception('Database Connection not set');
       }
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function dump ()
    {
         return   $this->start()->start($this->setMyRoot().'/'.$this->filename);
    }



    /**
     * @param string $DB
     * @return $this|mixed
     */
    public function database (string $DB)
    {
        $this->database = $DB;

        return $this;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function filename (string $name)
    {
        $this->filename =  $name.".sql";

        return $this;
    }

    /**
     */
    private function setMyRoot ()
    {
        $this->myRoot = __DIR__."/../../database/dumps";

        return $this->myRoot;
    }


}