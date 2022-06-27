<?php

require_once __DIR__ . '/../repository/GameRepository.php';
require_once __DIR__ . '/../utils/SessionManager.php';

class UserGamesController extends AppController {

    private $message = [];
    private $gamesRepository;

    public function __construct()
    {
        parent::__construct();
        $this->gamesRepository = new GameRepository();
    }

    public function userGames()
    {
        if($this->sessionManager->validateSession())
        {
            $games = $this->gamesRepository->getPlayerGames($_SESSION['user']);
            $this->render('userGames', ['games' => $games]);
        }
        else{
            $this->render('userGames');
        }
    }

    public function addGame()
    {
        if ($this->isPost()) {

            $game = new Game($_POST['name'], $_POST['description'], $_POST['steamId']);
            $this->gamesRepository->addGame($game);

            return $this->render('userGames', [
                'messages' => $this->message,
                'games' => $this->gamesRepository->getGames()
            ]);
        }

        return $this->render('add-project', ['messages' => $this->message]);
    }

    public function search()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->gamesRepository->getProjectByTitle($decoded['search']));
        }
    }

    public function like(int $id) {
        $this->gamesRepository->like($id);
        http_response_code(200);
    }

    public function dislike(int $id) {
        $this->gamesRepository->dislike($id);
        http_response_code(200);
    }
}