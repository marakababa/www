/**
 * Created by Alexey on 01.10.2015.
 */
var API={};

/* ����������� ��� ������� ��� ���������� ������ bbbbbb
API.LogIn=function( _command, _username, _password, _html, _onerrmsg){
    var htmlvar= _html||"no";
    var onerrormsgvar=_onerrmsg||"������ �����������";
    $.post('/index.php?c=C_API',
        {
            command: _command,
            username: _username,
            password: _password,
            html: htmlvar,
            errmsg: onerrormsgvar
        },
        function(data,status){
            var result=$.parseJSON(data);
            if(result.LogIn==true)
                $(location).attr('href','/index.php');
            else{
                $(".wrng-placeholder").html(result.ErrorHtml);
                if(!$(".wrng-box").hasClass("FadeIn"))
                    $(".wrng-box").toggleClass("FadeIn");

                $(".wrng-box").click(function(){
                    DeleteMessage();
                });
            }
        }
    );
};*/

//������ ����������� �� �������
API.LogIn=function( command, username, password, html, onerrmsg, onresult){
    var htmlvar= html||"no";
    var onerrormsgvar=onerrmsg||"������ �����������";
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
};