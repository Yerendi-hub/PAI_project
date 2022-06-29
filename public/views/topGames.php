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
            <h3>Top 10 games by user votes</h3>
            <?
            include("public/templates/games.php")
            ?>
        </main>
        <?
        include("public/templates/footer.php")
        ?>
        <script src="public/js/app.js"></script>
    </body>
</html>