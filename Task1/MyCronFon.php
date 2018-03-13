#!/usr/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 12.03.2018
 * Time: 0:16
 */

namespace tastTask\task1;

define('SCRIPT_FILENAME','YoursScriptPath');
define('DIRNAME','RunScriptDirectory');
class MyCronFon {
   const SCRIPT_FILENAME='NULL';// определяем директорию скрипта
    const DIRNAME='NULL';//задаем директорию выполнение скрипта
    public static  function getSCRIPT_FILENAME()
    {
return self::SCRIPT_FILENAME;
    }
    public static  function DIRNAME()
    {
return self::DIRNAME;
    }


}
$path_parts = pathinfo($_SERVER['SCRIPT_FILENAME']);
chdir($path_parts['DIRNAME']);