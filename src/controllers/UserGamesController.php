<?php

require_once __DIR__ . '/../repository/GameRepository.php';
require_once __DIR__ . '/../utils/SessionManager.php';

class UserGamesController extends AppController {

    private $message = [];
    private $gamesRepository;

    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

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
            return $this->render('userGames', ['games' => $games]);
        }
        return $this->render('userGames');
    }

    public function addGame()
    {
        if($this->sessionManager->validateSession() && $this->isPost()
            && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
        {
            $dir = $_FILES['file']['tmp_name'];
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                $dir
            );

            $path = $_FILES['file']['tmp_name'];
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $assignedById = $_SESSION['user'];

            $game = new Game($_POST['name'], $_POST['description'], $_POST['steamId'],$assignedById, $base64);

            $this->gamesRepository->addGame($game);

            return $this->render('userGames', [
                'messages' => $this->message,
                'games' => $this->gamesRepository->getPlayerGames($assignedById)
            ]);
        }
        return $this->render('userGames');
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

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
    }
}