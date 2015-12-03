﻿<?php

/**
 * __autoload - пояснение
 * __autoload() получает название класса
 * разделяет его знаком "_" и ищет файл
 * с названием класса в папке перед знаком "_"
 */
function __autoload($classname){
    $t=explode('_',$classname);
    include("{$t[0]}\\$classname.php");
}
//Настройка локализации, присваивание глобальных переменных и т.д.
M_Startup::StartUp();

if(isset($_GET['c'])){
    $controller=$_GET['c']::GetInstance();
    $controller->Request();
    }
//else
//Страница по дефолту
?>