<!DOCTYPE html>
<html lang="en">
    <head>
        <title>User games</title>
        <?
        include("public/templates/head.php")
        ?>
    </head>
    <body>
        <?
        include("public/templates/navbar.php")
        ?>
        <main class="page">
            <div>
                <?php
                if(isset($games)){
                    foreach($games as $game) {
                        echo '<h1>'.$game->getName().'</h1>';
                    }
                }
                else{
                    echo '<h1> please log in </h1>';
                }
                ?>
            </div>
        </main>
        <?
        include("public/templates/footer.php")
        ?>
        <script src="public/js/app.js"></script>
    </body>
</html>