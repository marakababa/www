<!--TODO Переписать пути в настройки -->
<?header('Content-Type: text/html; charset=utf-8');?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="V\css\main.css">
        <script type="text/javascript" src="V\js\jquery.js"></script>
        <script type="text/javascript" src="V\js\Classes.js"></script>
        <script type="text/javascript" src="V\js\md5.js"></script>
        <script type="text/javascript" src="V\js\ajax.js"></script>
    </head>
    <body>
        <?=$header?>
        <div id="Content-Main">
            <?=$content?>
        </div>
        <div class="wrng-placeholder"></div>
        <?=$footer?>
    </body>
</html>