<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 28.01.2016
 * Time: 16:58
 */
//todo сделать класс пользователя User
class User{
    private $data = array();

    public function Get_id(){
        return $this->id;
    }

    public function __construct( array $data = array())
    {
        foreach ($data as $key => $param){
            $this->data[$key] = $param;
        }
    }

    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
    }

    /**
     * @param $name
     * @return array
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        $trace = debug_backtrace();
        trigger_error(
            'Неопределенное свойство в __get(): ' . $name .
            ' в файле ' . $trace[0]['file'] .
            ' на строке ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }

}