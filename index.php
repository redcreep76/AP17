<?php
session_start();
include "./functions/autoLoader.php";
date_default_timezone_set("Europe/Paris");
spl_autoload_register("autoLoader");
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="UTF-8" />
        <title>CESI AP - Blog/e-commerce</title>
        <link rel="stylesheet" href="./assets/css/style.css" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    </head>
    <body>
        <div id="container">
            <?php
            include "./includes/header.php";

            PageLoader::load($_GET['page'] ?? "");

            include "./includes/footer.php";
            ?>
        </div>
    </body>
</html>
