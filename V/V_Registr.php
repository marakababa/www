<html>
    <head>
        <link rel="stylesheet" href="css/registration.css">
        <script type="text/javascript" src="js/jquery-2.1.4.js"></script>
        <script>
            $("document").ready(function(){
                $("input.btn-style").mousedown(function(){
                    $("input.btn-style").toggleClass("btn-style-pushed");
                }) ;
                $("input.btn-style").mouseup(function(){
                    $("input.btn-style").toggleClass("btn-style-pushed");
                }) ;
                $("input.btn-style").hover(function(){
                    $("input.btn-style").toggleClass("btn-hovered");
                }) ;
            });
        </script>
    </head>
    <body>
        <form action="index.php" method="POST">

            <table class="Registration_form">
                <tr>
                    <td colspan="2">
                        <center>
                            <h1>Регистрация</h1>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="MyDefaultText Important">
                            Логин:
                        </span>
                    </td>
                    <td>
                        <input type="text" name="login"class="MyDefaultInputText ">
                    </td>
                </tr>

                <tr>
                    <td>
                        <span class="MyDefaultText Important">
                            Пароль:
                        </span>
                    </td>
                    <td>
                        <input type="password"name="pass" class="MyDefaultInputText" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="MyDefaultText Important">
                            Повторите пароль:
                        </span>
                    </td>
                    <td>
                        <input type="password" name="passretr"class="MyDefaultInputText">
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="MyDefaultText Important">
                            Адрес электронной почты:
                        </span>
                    </td>
                    <td>
                        <input type="text" name="passretr"class="MyDefaultInputText">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="MyDefaultText">
                            Имя:
                        </span>
                    </td>
                    <td>
                        <input type="text" name="passretr"class="MyDefaultInputText">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center>
                            <input  type="button" name="btn" class="btn-style " value="Подтвердить" />
                        </center>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>