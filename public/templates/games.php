<div class="games-container">
    <?php
    if(isset($games)){
        foreach($games as $game) {
            echo('
                        <div class="game-container">
                        <img id="base64ImageForDisplay" alt="Preview Image" src='.$game->getImage().' class="img game-img">
                        <form action="getSingleGame" method="post">                      
                        <input type="hidden" name="gameId" id="gameId" value='.$game->getDbId().'/>
                        <button type="submit" class="btn btn-link">
                            '.$game->getName().'
                        </button>
                        </form>
                        
                        </div>');
        }
    }
    else{
        echo '<h3>No games found.</h3>';
    }
    ?>
</div>