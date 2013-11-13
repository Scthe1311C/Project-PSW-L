<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="Galeria internetowa umożliwiająca dzieleni się zdjęciami poprzez dysk sieciowy &quot;dropbox&quot;">
        <meta name="keywords" content="galeria, zdjęcia, galeria online, galeria multimedialna, dropbox" >
        <link rel="stylesheet" type="text/css" href="vendor/dist/css/bootstrap.css"/>
         <link rel="stylesheet" type="text/css" href="src/css/carousel.css"/>
        <link rel="stylesheet" type="text/css" href="src/css/photo_style.css"/>
<!--        <link rel="stylesheet" type="text/css" href="/vendor/dist/css/bootstrap-theme.min.css"/>-->

    </head>

    <body>
        <div>

            <?php include 'nav_bar.php' ?>
            <div class="content">
                        <?php include $content; ?>                       
                </div>
            </div>

        </div>
        <script src="vendor/dist/js/jquery.js"></script>
    <script src="vendor/dist/js/bootstrap.min.js"></script>
    <script src="vendor/dist/js/holder.js"></script>
    </body>
</html>