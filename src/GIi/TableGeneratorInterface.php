<?php
/**
 * Created by PhpStorm.
 * User: Stephane De Jesus
 * Date: 19/12/2019
 * Time: 07:50
 */

namespace Akuren\GIi;


interface TableGeneratorInterface
{

    /**
     * @param string $table
     * @param array $data
     * @return mixed
     */
    public static function ArrayToTable(string $table , array  $data = []);

    /**
     * @param  $url
     * @return mixed
     */
    public static function JsonToArray($url);

}