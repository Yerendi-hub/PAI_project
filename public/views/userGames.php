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
                    echo '
                    <form class="form" action="addGame" method="POST" ENCTYPE="multipart/form-data">
                <h1>Add game</h1>
                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>

                <div class="form-row">
                    <label html="name" class="form-label">Name</label>
                    <input name="name" id="name" type="text" class="form-input" />
                </div>
                <div class="form-row">
                    <label html="password" class="form-label">Description</label>
                    <textarea name="description" rows=5 id="description" class="form-input"></textarea>
                </div>
                <div class="form-row">
                    <label html="steamId" class="form-label">Steam ID</label>
                    <input name="steamId" id="steamId" type="number" class="form-input" />
                </div>
                <div class="form-row">
                    <label html="steamId" class="form-label">Email</label>
                    <input type="file" name="file" class="btn"/><br/>
                </div>
                <button type="submit" class="btn btn-block">
                    Add
                </button>
            </form>
                    ';
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