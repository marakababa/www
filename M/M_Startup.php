<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 09.10.2015
 * Time: 20:36
 */
class M_Startup{
    private static $instance;

    public static function GetInstance()
    {
        if (self::$instance == null)
            self::$instance =new self();
        return self::$instance;
    }
    public static function GetPaths(){
        $settings_json=file_get_contents("settings.json");
        $settings= json_decode($settings_json, true);
        return $settings['paths'];
    }
    public static  function StartUp(){
        setlocale(LC_ALL,"utf-8");
        header('Content-Type: text/html; charset=utf-8');
        $paths=M_Startup::GetPaths();
        foreach($paths as $key => $value){
            $GLOBALS["$key"]=$value;
        }
    }
}