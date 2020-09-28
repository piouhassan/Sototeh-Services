<?php


namespace Akuren\Gli;


use Akuren\GIi\TableGeneratorInterface;
use Akuren\Query\ConnectionSQL;

class TableGenerator implements TableGeneratorInterface
{

    /**
     * @param string $table
     * @param array $data
     * @return string
     */
    private function make(string $table , array $data = [])
    {
        $createTableStatement = "CREATE TABLE ".$table;
        $createTableStatement .= '(';
        $createTableStatement .= '`id` INT NOT NULL AUTO_INCREMENT,';

        foreach($data as $dataKey => $dataValues)
        {
            $getDataType = gettype($dataValues);

            if($getDataType == 'integer')
            {
                $createTableStatement .= '`'.$dataKey.'` int(11) DEFAULT NULL, ';
            }
            elseif($getDataType == 'double')
            {
                $createTableStatement .= '`'.$dataKey.'` float DEFAULT NULL, ';
            }
            elseif($getDataType == 'boolean')
            {
                $createTableStatement .= '`'.$dataKey.'` tinyint(2) DEFAULT NULL, ';
            }
            else
            {
                $createTableStatement .= '`'.$dataKey.'` varchar(255) DEFAULT NULL, ';
            }

        }

        $createTableStatement .= 'PRIMARY KEY (`id`)';
        $createTableStatement .= ')';

        $createTableStatement .= "COLLATE='latin1_swedish_ci' ENGINE=InnoDB";

        return $createTableStatement;
    }

    /**
     * @param string $table
     * @param array $data
     * @return bool
     */
    public static function ArrayToTable(string $table , array  $data = []){
       $sql = (new TableGenerator())->make($table,$data);
       $pdo = new ConnectionSQL();
       if( (new TableGenerator())->tableExist($table)){
         return false;
       }else{
           $pdo->getPDO()->query($sql);
           return true;
       }
    }

    /**
     * @param url $url
     * @return array
     */
    public static function JsonToArray($url)
    {
        $strJsonFileContents = file_get_contents($url);

        $array = json_decode($strJsonFileContents, true);

        $this_array = [];

        foreach ($array as $ar){
         $this_array = $ar[0];
        }

   return $this_array;
    }

    /**
     * @param $tableName
     * @return bool
     */
    private function tableExist($tableName)
    {

        $pdo = new ConnectionSQL();

        $rsponse = $pdo->getPDO()->query('show tables');

        while($data = $rsponse -> fetch())

        {

            if($data[0] == $tableName)
            {
              return true;
            }else{
             return false;
            }

        }



    }
}