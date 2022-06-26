<?php

require_once('src/models/SteamTopGames.php');

class TopGamesController extends AppController {

    public function topGames()
    {
        var_dump(SteamTopGames::$games);
        $this->render('topGames', ['topGames' => [SteamTopGames::$games]]);
    }
}