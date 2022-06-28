<?php

class TopGamesController extends AppController {

    public function topGames()
    {
        $games = $this->gameRepository->getTopGames();
        $this->render('topGames', ['games' => $games]);
    }
}