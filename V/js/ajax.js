/**
 * Created by Alexey on 07.10.2015.
 */
/**
 * Описание LogIn
 * ---
 * Delay - задержка перед вызовом DeleteMessage().
 * ---
 * LogIn() - авторизирует пользователя на сайте, в случае ошибки выводит
 * на экран ошибку в виде html-кода
 * */
var Delay;
function LogIn() {
    $(document).ready(function () {
        if (Delay != null)
            clearTimeout(Delay);
        if (!$(".wrng-box").hasClass("FadeOut") && $(".wrng-box").hasClass("FadeIn"))
            DeleteMessage();
        var _username = $("input[name='username']").val();
        var _password = $("input[name='password']").val();
        var onresult = function (data, status) {
            var result = $.parseJSON(data);
            /*                alert("Login status is: " + result.LogIn + "\nRequest  status is: " + status);*/
            if (result.LogIn == true)
                $(location).attr('href', '/index.php');
            else {
                $(".wrng-placeholder").html(result.ErrorHtml);
                if (!$(".wrng-box").hasClass("FadeIn"))
                    $(".wrng-box").toggleClass("FadeIn");
                $(".wrng-box").click(function () {
                    DeleteMessage();
                });
            }
        };
        API.LogIn("LogIn", _username, _password, "yes", null, onresult);
        Delay = window.setTimeout(DeleteMessage, 5000);
    });
}
function DeleteMessage() {
    $(document).ready(function () {
        if ($(".wrng-box").hasClass("FadeIn") && !$(".wrng-box").hasClass("FadeOut")) {
            $(".wrng-box").toggleClass("FadeOut");
            window.setTimeout(function () {
                $(".wrng-box").remove();
            }, 1000);
        }
    });
}
