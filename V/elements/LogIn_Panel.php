<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 08.10.2015
 * Time: 16:04
 */
?>
<body>
    <div id="top-login-overlay-container">
        <div id="overlay-menu-button" >

        </div>
        <div id="login-overlay-menu-container" class="WrappedOut main-font-style">
            <ul id="login-overlay-menu-content">
                <li class="menu-header"><span id="menu-header-content">Меню</span></li>
                <li>
                    <ul id="login-overlay-menu-body">
                        <li><span class="menu-item">Главная</span></li>
                        <li><span class="menu-item">Преподователи</span></li>
                        <li><span class="menu-item">Учащиеся</span></li>
                        <li><span class="menu-item">Предметы</span></li>
                        <li><span class="menu-item">Дополнительно</span>
                            <ul>
                                <li><span class="menu-item">1</li>
                                <li><span class="menu-item">2</li>
                                <li><span class="menu-item">3</li>
                                <li><span class="menu-item">4</li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div id="top-login-overlay-content" >
            <div id="overlay-login-link" class="right-float" onclick="LogIn();">
                <span id="overlay-login-link-text">войти</span>
            </div>
            <div id="overlay-password-textbox-container"  class="right-float">
                <input id="overlay-password-textbox" type="password" placeholder="Пароль" title="Пароль">
            </div>
            <div id="overlay-password-image"  class="right-float"></div>
            <div id="overlay-login-textbox-container"  class="right-float">
                <input id="overlay-login-textbox" type="text" placeholder="Логин\Email">
            </div>
            <div id="overlay-login-image" class="right-float"></div>
        </div>
    </div>




