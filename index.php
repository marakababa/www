<?php
//TODO Сделать считывание настроек из файла в виде json. Там будут указаны пути до скрипитов и т.д.
//TODO Подключить проект к GitHub

//
//Подключение классов include перед созданием класса
//
setlocale(LC_ALL, 'ru_RU.CP1251');
function __autoload($classname){
    $t=explode('_',$classname);
    include("{$t[0]}\\$classname.php");
}

if(isset($_GET['c'])){
    $controller=$_GET['c']::GetInstance();
    $controller->Request();
    }
//else
//Сюда страницупо умолчанию когда пользователь приходит на сайт
?>