<?php

require_once('src/models/SteamTopGames.php');

class TopGamesController extends AppController {

    private $gamesRepository;

    public function __construct()
    {
        parent::__construct();
        $this->gamesRepository = new GameRepository();
    }

    public function topGames()
    {
        $games = $this->gamesRepository->getTopGames();
        $this->render('topGames', ['games' => $games]);
    }
}