<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/GameRepository.php';

class DefaultController extends AppController {

    private $gamesRepository;

    public function __construct()
    {
        parent::__construct();
        $this->gamesRepository = new GameRepository();
    }

    public function index()
    {
        $games = $this->gamesRepository->getGames();
        $this->render('index', ['games' => $games]);
    }

    public function search()
    {
        $games = $this->gamesRepository->getGameByTitle($_POST['key']);
        $this->render('index', ['games' => $games]);
    }
}