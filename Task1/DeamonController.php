<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 11.03.2018
 * Time: 23:54
 */
namespace console\controllers;

use Yii;
use yii\helpers\Url;
use models\Mycron;
class DeamonController extends Controller{
    public  function actionIndex()
    {
        echo "My cron services is running!!!";
    }
    public  function actionFrequent()
    {
        $time_start=microtime(true);
        $x=new models\Mycron();
        $time_end = microtime(true);
        echo 'processing for'.($time_end-$time_start).'seconds';
    }
    public  function actionQuarter()
    {
        $xxx=new models\Mycron();
        $xxx->loadProfiles();
    }
    public static function actionSecondly()
    {
        $mycurrent_time= date('s');
        if($mycurrent_time%6)
        {
            //every six seconds
        }
    }


}