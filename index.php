<?php
//TODO Загружать настройки из файла

//
//����������� ������� include ����� ��������� ������
//
function __autoload($classname){
    $t=explode('_',$classname);
    include("{$t[0]}\\$classname.php");
}

if(isset($_GET['c'])){
    $controller=$_GET['c']::GetInstance();
    $controller->Request();
    }
//else
//���� ���������� ��������� ����� ������������ �������� �� ����
?>