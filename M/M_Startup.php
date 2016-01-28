<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 09.10.2015
 * Time: 20:36
 */
include('M_Generic_Classes.php');
include('M_Generic_Functions.php');
class M_Startup{
    private static $instance;

    public static function GetInstance()
    {
        if (self::$instance == null)
            self::$instance =new M_Startup();
        return self::$instance;
    }
    /**
     * Получает и обрабатывает настройки из settings.json если не задан другой путь
     * @param $path (String) = 'settings.json' - путь к файлу настроек формата json
     * @return a_array
    */
    public static function GetSettings($path = 'settings.json'){
        $settings_json=file_get_contents($path);
        $settings= json_decode($settings_json, true);
        return $settings;
    }

    /**
     * Функция выполняет стандартные настройки
    */
    public static  function StartUp(){
        session_start();
        setlocale(LC_ALL,"utf-8");
        header('Content-Type: text/html; charset=utf-8');
        $settings = M_Startup::GetSettings();
        foreach($settings as $elem){
            foreach($elem as $key => $value){
                $GLOBALS["$key"]=$value;
            }
        }
    }
}