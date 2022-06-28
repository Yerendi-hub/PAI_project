<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard</title>
        <?
        include("public/templates/head.php")
        ?>
    </head>
    <body>
        <?
        include("public/templates/navbar.php")
        ?>
        <main class="page">
            <header class="hero">
                <div class="hero-container">
                    <div class="hero-text">
                        <h1>Steam Engine</h1>
                        <h4>One place for all games</h4>
                    </div>
                </div>
            </header>

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