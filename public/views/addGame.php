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
            <section class="add-game-container">
                <form class="form" action="addGame" method="post">
                    <h3>Add game</h3>

                    <div class="messages">
                        <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo '<div class="alert alert-danger">'.$message.'</div>';
                            }
                        }
                        ?>
                    </div>

                    <div class="form-row">
                        <label html="text" class="form-label">Game name</label>
                        <input type="text" name="game-name" id="game-name" class="form-input" />
                    </div>
                    <div class="form-row">
                        <label html="text" class="form-label">Description</label>
                        <input type="text" name="game-description" id="game-description" class="form-textarea" />
                    </div>
                    <div class="form-row">
                        <label html="number" class="form-label">SteamID</label>
                        <input type="number" name="steam-id" id="steam-id" class="form-input" />
                    </div>
                    <button type="submit" class="btn btn-block">
                        Add game
                    </button>
                </form>
            </section>
        </main>
        <?
        include("public/templates/footer.php")
        ?>
        <script src="public/js/app.js"></script>
    </body>
</html>