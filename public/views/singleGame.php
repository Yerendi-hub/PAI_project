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
                        <h1>' . $g->getName() . '</h1>
                        <img id="base64ImageForDisplay" alt="Preview Image" src='.$g->getImage().' class="img game-img">
                        <h3> Votes: ' . (int)($g->getVotes() * 100) . '%</h3>
                        ');

                    if($g->getUserVote() !== -2)
                    {
                       if($g->getUserVote() == -1)
                       {
                           echo '
                            <h5>You didn`t vote for game the game. You can select your vote here.</h5>
                           <form action="voteUp" method="post">                      
                        <input type="hidden" name="gameId" id="gameId" value='.$g->getDbId().'>
                        <button type="submit" class="btn btn-block">
                            like
                        </button>
                        </form>
                        <br/>
                        <form action="voteDown" method="post">                      
                        <input type="hidden" name="gameId" id="gameId" value='.$g->getDbId().'>
                        <button type="submit" class="btn btn-block">
                            dislike
                        </button>
                        </form>'
                           ;
                       }

                        if($g->getUserVote() == 0)
                        {
                            echo '
                            <h5>You disliked the game. You can change your vote here</h5>.
                           <form action="voteUp" method="post">                      
                        <input type="hidden" name="gameId" id="gameId" value='.$g->getDbId().'>
                        <button type="submit" class="btn btn-block">
                            like
                        </button>
                        </form>';
                        }

                        if($g->getUserVote() == 1)
                        {
                            echo '
                            <h5>You liked the game. You can change your vote here</h5>.
                           <form action="voteDown" method="post">                      
                        <input type="hidden" name="gameId" id="gameId" value='.$g->getDbId().'>
                        <button type="submit" class="btn btn-block">
                            dislike
                        </button>
                        </form>';
                        }
                    }

                    if($g->getCanUserDeleteGame())
                    {
                        echo '
                        <br/>
                        <br/>
                        <br/>
                            <form action="deleteGame" method="post">                      
                        <input type="hidden" name="gameId" id="gameId" value='.$g->getDbId().'>
                        <button type="submit" class="btn btn-delete">
                            Delete game
                        </button>
                        </form>
                        ';
                    }
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