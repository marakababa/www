var API = (function () {
    function API() {
    }
    API.LogIn = function (command, username, password, html, onerrmsg, onresult) {
        var htmlvar = html || "no";
        var onerrormsgvar = onerrmsg || "Ошибка авторизации";
        alert("Ошибка авторизации");
        var onresult = onresult || function () {
        };
        $.post('/index.php?c=C_API', {
            command: command,
            username: username,
            password: password,
            html: htmlvar,
            errmsg: onerrormsgvar
        }, function (data, status) {
            onresult(data, status);
        });
    };
    return API;
})();
