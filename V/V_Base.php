<!--TODO сдлеать кнопку сворачивания панели авторизации -->

<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?=$GLOBALS['__css']?>main.css">
        <link rel="stylesheet" href="<?=$GLOBALS['__css']?>login-overlay.css">
        <script type="text/javascript" src="<?=$GLOBALS['__js']?>jquery.js"></script>
        <script type="text/javascript" src="<?=$GLOBALS['__js']?>jquery-ui.js"></script>
        <script type="text/javascript" src="<?=$GLOBALS['__js']?>Classes.js"></script>
        <script type="text/javascript" src="<?=$GLOBALS['__js']?>md5.js"></script>
        <script type="text/javascript" src="<?=$GLOBALS['__js']?>ajax.js"></script>
        <script type="text/javascript" src="<?=$GLOBALS['__js']?>common.js"></script>
    </head>
    <body>
        <div id="login-overlay-placeholder" class="top">
            <?=$overlay?>
        </div>
        <?=$header?>
        <div id="Content-Main">
            <?=$content?>
        </div>
        <div class="wrng-placeholder"></div>
        <?=$footer?>
    </body>
</html>