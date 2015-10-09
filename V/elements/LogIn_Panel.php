<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 08.10.2015
 * Time: 16:04
 */
header('Content-Type: text/html; charset=utf-8');
?>
<html>
    <head>
        <link rel="stylesheet" href="V/css/login-overlay.css">
    </head>
    <body>
        <div id="top-login-overlay-container">
            <div id="top-login-overlay-content" >
                <div id="overlay-menu-button" class="left-float">

                </div>
                <div id="overlay-login-link" class="right-float" onclick="LogIn();">
                    <span id="overlay-login-link-text">войти</span>
                </div>
                <div id="overlay-password-image" class="right-float">

                </div>
                <div id="overlay-password-textbox-container"  class="right-float">
                    <input id="overlay-password-textbox" type="password" placeholder="Пароль" title="Пароль">
                </div>
                <div id="overlay-login-image" class="right-float">

                </div>
                <div id="overlay-login-textbox-container"  class="right-float">
                    <input id="overlay-login-textbox" type="text" placeholder="Логин\Email">
                </div>
            </div>
        </div>
    </body>
</html>




