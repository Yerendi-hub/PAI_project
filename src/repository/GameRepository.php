<?php

require_once 'Repository.php';
require_once 'UserRepository.php';
require_once __DIR__.'/../models/Game.php';

class GameRepository extends Repository
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function getGame(int $id): ?Game
    {
        $stmt = $this->database->connect()->prepare('
            SELECT (CAST(SUM(vtg.value) AS float)/COUNT(*)) as votes, g.id as id, g.name as name, g.description as description, g.owner as owner, g.steamid as steamid, i.binary_data as binary_data FROM games g LEFT JOIN vote_to_game vtg ON g.id = vtg.game JOIN images i ON g.image = i.id WHERE g.id = :id GROUP BY g.id, i.id;
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $game = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$game) {
            return null;
        }

        $userVote = -2;
        $userRole = 'none';
        $user = 0;

        if($this->sessionManager->validateSession())
        {
            $userVote = -1;
            $user = $_SESSION['user'];
            $stmt = $this->database->connect()->prepare('
            SELECT "value" FROM vote_to_game WHERE game = :gameId AND player = :playerId;
        ');

            $stmt->bindParam(':gameId', $id, PDO::PARAM_INT);
            $stmt->bindParam(':playerId', $user, PDO::PARAM_INT);
            $stmt->execute();

            $vote = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($vote) {
                $userVote = $vote['value'];
            }

            $userRole = $this->userRepository->getById($user)->getRole();
        }

        $game = new Game(
            $game['name'],
            $game['description'],
            $game['steamid'],
            $game['owner'],
            $game['binary_data'],
            $game['votes'],
            $game['id']
        );

        $game->setUserVote($userVote);
        $game->setCanUserDeleteGame($game->getOwner() == $user || $userRole === 'admin');

        return $game;
    }

    public function addImage($image): string
    {
        $connection = $this->database->connect();
        $stmt = $connection->prepare($this->insertImageSql());

        $stmt->execute([$image]);

        return $connection->lastInsertId();
    }

    public function addVote($vote, $game)
    {
        if($this->sessionManager->validateSession())
        {
            $connection = $this->database->connect();
            $stmt = $connection->prepare($this->addVoteSql());

            $stmt->execute([$_SESSION['user'], $vote, $game]);
        }
    }

    public function addGame(Game $game): void
    {
        $id = $this->addImage($game->getImage());
        $stmt = $this->database->connect()->prepare($this->insertGameSql());

        $stmt->execute([
            $game->getName(),
            $game->getDescription(),
            $game->getSteamId(),
            $game->getOwner(),
            $id
        ]);
    }

    public function getGames(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
           SELECT  (CAST(SUM(vtg.value) AS float)/COUNT(*)) as votes, g.id as id, g.name as name, g.description as description, g.owner as owner, g.steamid as steamid, i.binary_data as binary_data FROM games g LEFT JOIN vote_to_game vtg ON g.id = vtg.game JOIN images i ON g.image = i.id GROUP BY g.id, i.id;
        ');

        return $this->fetch_games($stmt, $result);
    }

    public function getTopGames(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM (SELECT (CAST(SUM(vtg.value) AS float)/COUNT( * )) as votes, g.id as id, g.name as name, g.description as description, g.owner as owner, g.steamid as steamid, i.binary_data as binary_data FROM games g LEFT JOIN vote_to_game vtg ON g.id = vtg.game JOIN images i ON g.image = i.id group by i.id, g.id) as A ORDER BY NULLIF(A.votes,0) asc LIMIT 1
        ');

        return $this->fetch_games($stmt, $result);
    }

    public function getPlayerGames(int $userId): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT (CAST(SUM(vtg.value) AS float)/COUNT(*)) as votes, g.id as id, g.name as name, g.description as description, g.owner as owner, g.steamid as steamid, i.binary_data as binary_data FROM games g LEFT JOIN vote_to_game vtg ON g.id = vtg.game JOIN images i ON g.image = i.id WHERE g.owner = :id GROUP BY g.id, i.id;

        ');

        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        return $this->fetch_games($stmt, $result);
    }

    public function getGameByTitle(string $searchString): array
    {
        $result = [];
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT (CAST(SUM(vtg.value) AS float)/COUNT(*)) as votes, g.id as id, g.name as name, g.description as description, g.owner as owner, g.steamid as steamid, i.binary_data as binary_data FROM games g LEFT JOIN vote_to_game vtg ON g.id = vtg.game JOIN images i ON g.image = i.id WHERE LOWER(g.name) LIKE :search GROUP BY g.id, i.id;
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);

        return $this->fetch_games($stmt, $result);
    }

    public function insertGameSql()
    {
        return '
            INSERT INTO games (name, description, steamid, owner, image)
            VALUES (?, ?, ?, ?, ?)
        ';
    }

    public function insertImageSql()
    {
        return '
            INSERT INTO images (binary_data)
            VALUES (?)
        ';
    }

    public function addVoteSql()
    {
        return '
            INSERT INTO vote_to_game (player, value, game) 
        VALUES (?, ?, ?)
        ON CONFLICT (player, game) DO UPDATE 
        SET value = excluded.value 
        ';
    }

    public function fetch_games($stmt, array $result): array
    {
        $stmt->execute();
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($games as $game) {
            $result[] = new Game(
                $game['name'],
                $game['description'],
                $game['steamid'],
                $game['owner'],
                $game['binary_data'],
                $game['votes'],
                $game['id']
            );
        }

        return $result;
    }
}