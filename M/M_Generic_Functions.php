<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 28.01.2016
 * Time: 17:12
 */

/**
 * Является ли переменная типа User
 * @param $obj - переменная
 * @return bool
*/
function is_user(&$obj ){
    return $obj == new User() ? true : false;
}