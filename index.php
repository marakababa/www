<?php
//TODO ������� ���������� �������� �� ����� � ���� json. ��� ����� ������� ���� �� ��������� � �.�.
//TODO ���������� ������ � GitHub

//
//����������� ������� include ����� ��������� ������
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
//���� ���������� ��������� ����� ������������ �������� �� ����
?>