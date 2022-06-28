<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Single game</title>
        <?
        include("public/templates/head.php")
        ?>
    </head>
    <body>
        <?
        include("public/templates/navbar.php")
        ?>

        <main class="page">
            <?
            if(isset($game)) {
                foreach ($game as $g) {
                    echo('
                        <h1>' . $g->getName() . '
                        ');
                }
            }
            ?>
        </main>
        <?
        include("public/templates/footer.php")
        ?>
        <script src="public/js/app.js"></script>
    </body>
</html>