<?php

require_once 'AppController.php';

class FavoriteGamesController extends AppController {

    public function favoriteGames()
    {
        $this->render('favoriteGames');
    }
}