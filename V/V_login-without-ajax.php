<html>
    <head>
        <link rel="stylesheet" href="V\css\css.css" />
    </head>
    <body>
        <form action=".\index.php?c=C_login" method='post' >
            <table>
                <tr>
                    <th colspan="2">
                        Авторизация
                    </th>
                </tr>
                <tr>
                    <td>
                        Email:
                    </td>
                    <td>
                        <input type="text" placeholder="example@examplesite.ru" name='login'/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Пароль:
                    </td>
                    <td>
                        <input type="password" name='password' />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="checkbox" name="remember"/>
                        Запомнить меня
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" class="GreyButton" value="Вход"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>