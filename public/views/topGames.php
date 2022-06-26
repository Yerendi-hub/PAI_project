<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Top games</title>
        <?
        include("public/templates/head.php")
        ?>
    </head>
    <body>
        <?
        include("public/templates/navbar.php")
        ?>
        <main class="page">
            <?php
            if(isset($topGames)){
                foreach($topGames as $game) {
                    echo '<div class="alert alert-danger">'.$game.'</div>';
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