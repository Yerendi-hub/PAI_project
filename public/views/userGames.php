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
                    include("public/templates/games.php");
                }
                else{
                    echo '<h1> please log in </h1>';
                }
                ?>
            </div>

            <h1>UPLOAD</h1>
            <form action="addGame" method="POST" ENCTYPE="multipart/form-data">
                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="name" type="text" placeholder="name">
                <textarea name="description" rows=5 placeholder="description"></textarea>
                <input name="steamId" type="number" placeholder="id">
                <input type="file" name="file"/><br/>
                <button type="submit">send</button>
            </form>

        </main>
        <?
        include("public/templates/footer.php")
        ?>
        <script src="public/js/app.js"></script>
    </body>
</html>