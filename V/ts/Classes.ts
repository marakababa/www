/**
 * Created by Alexey on 07.10.2015.
 */
    declare var $;
class API{
    public static LogIn( command, username, password, html, onerrmsg, onresult){
        var htmlvar= html||"no";
        var onerrormsgvar=onerrmsg||"Ошибка авторизации";
        var onresult= onresult||function(){};
        $.post('/index.php?c=C_API',
            {
                command: command,
                username: username,
                password: password,
                html: htmlvar,
                errmsg: onerrormsgvar
            },
            function(data,status){
                onresult(data,status);
            }
        );
    }
}
