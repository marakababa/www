<html>
    <head>
        <link rel="stylesheet" href="V\css\css.css" />
    </head>
    <body>
        <form action=".\index.php?c=C_login" method='post' >
            <table>
                <tr>
                    <th colspan="2">
                        �����������
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
                        ������:
                    </td>
                    <td>
                        <input type="password" name='password' />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="checkbox" name="remember"/>
                        ��������� ����
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" class="GreyButton" value="����"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>