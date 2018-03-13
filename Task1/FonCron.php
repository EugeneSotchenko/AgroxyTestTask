<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 12.03.2018
 * Time: 0:35
 */

namespace tastTask\task1;
/*
 * Задача_1:
Реализовать генератор времен выполнения скрипта, исходя из заданных количества раз и количества часов. Хранить где-то эти времена.

Задача_2:
Работа после закрытия браузера

Задача_3:
Отказоустойчивость(не вылетать после окончания ограничения времени выполнения скрипта)

Задача_4:
Выполнять в нужное время какой-то скрипт.
 */

class FonCron {


public static function myConf()
{
    session_start();  // Старт сессии
    $num_starts = 120; // Количество запусков скрипта за промежуток времени
    $hours = 1; // Количество часов, в течение которых нужно запускать скрипт $num_starts раз.
    $time_sec = $hours*3600; // Количество секунд в цикле запусков
    $time_to_start = array(); // Собственно, массив с временами запусков
    ignore_user_abort(1);   // Игнорировать обрыв связи с браузером
}
//
    /******
     * @desc  Генерируем интервал между запусками.
     */
    function add_time2start() {
        global $time_sec, $time_to_start;
        $new_time = time()+rand(0, $time_sec);
        if (!in_array($new_time, $time_to_start)) {   // Если такого времени в массиве нет - добавим
            $time_to_start[] = $new_time;
        } else {
            add_time2start(); // Если такое время уже есть - генерируем заново.
        }
    }
    //
    public static function set_time_startrecords($num_starts)
    {

        $k = 1;
        if ($_SESSION["num_st"] == "" || $_SESSION["num_st"][$num_starts-1] < time()) {   // проверка, что в сессию не записаны данные и что эти данные не устарели.
            do {
                add_time2start($k);
                $k++;
            } while ($k <= $num_starts);
            sort($time_to_start, SORT_NUMERIC);
            $_SESSION["num_st"] = $time_to_start;
        }
    }
    public static function readstartValue($exec_time)
    {
        $start_time = microtime(); // Узнаем время запуска скрипта
        $start_array = explode(" ", $start_time); // Разделяем секунды и миллисекунды
        $start_time = $start_array[1]; // получаем стартовое время скрипта
        $max_exec = ini_get("max_execution_time"); //Получаем максимально возможное время работы скрипта

        do {
            $nowtime = time();  // Текущее время
            //// Если текущее время есть в массиве с временами выполнения скрипта......
            if (in_array($nowtime, $_SESSION["num_st"])) {
                // Сокетом цепляемся к файлу с основным содержанием действий
                $http = fsockopen('test.loc', 80);
                /// заодно передаем ему данные сессии и время когда он должен сработать
                fputs($http, "GET http://test.loc/exec.php?" . session_name() . "=" . session_id() . "&nowtime=$nowtime HTTP/1.0\r\n");
                fputs($http, "Host: test.loc\r\n");
                fputs($http, "\r\n");
                fclose($http);
            } //// выполнили заданное действие
            // Узнаем текущее время чтобы проверить, дальше ли вести цикл или перезапустить
            $now_time = microtime();
            $now_array = explode(" ", $now_time);
            $now_time = $now_array[1];
            // вычитаем из текущего времени начальное начальное
            $exec_time = $now_time - $start_time + $exec_time;
            /// тормозимся на секунду
            usleep(1000000);
            //Остановка скрипта, работающего в фоновом режиме. Я другого способа не придумал.
            if (file_exists("stop.txt")) exit;
            //Проверяем время работы, если до конца работы скрипта
            //осталось менее6 секунд, завершаем работу цикла.
        } while ($exec_time < ($max_exec - 6));
    }

    public static function runscript($max_exec)
{
    // Запускаем этот же скрипт новым процессом и завершаем работу текущего
$http = fsockopen('test.loc',80);
fputs($http, "GET http://test.loc/index.php?".session_name()."=".session_id()."&bu=$max_exec HTTP/1.0\r\n");
fputs($http, "Host: test.loc\r\n");
fputs($http, "\r\n");
fclose($http);
}

}

