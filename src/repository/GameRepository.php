<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Game.php';

class GameRepository extends Repository
{
    public function getGame(int $id): ?Game
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM games JOIN images ON games.image = images.id WHERE games.id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $game = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$game) {
            return null;
        }

        return new Game(
            $game['name'],
            $game['description'],
            $game['steamid'],
            $game['owner'],
            $game['binary_data'],
            $game['likes'],
            $game['dislikes'],
            $game['id']
        );
    }
    public function addImage($image): string
    {
        $connection = $this->database->connect();
        $stmt = $connection->prepare($this->insertImageSql());

        $stmt->execute([$image]);

        return $connection->lastInsertId();
    }

    public function addGame(Game $game): void
    {
        $id = $this->addImage($game->getImage());
        $stmt = $this->database->connect()->prepare($this->insertGameSql());

        $assignedById = $_SESSION['user'];

        $stmt->execute([
            $game->getName(),
            $game->getLikes(),
            $game->getDislikes(),
            $game->getDescription(),
            $game->getSteamId(),
            $assignedById,
            $id
        ]);
    }

    public function getGames(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM games JOIN images ON games.image = images.id;
        ');

        return $this->fetch_games($stmt, $result);
    }

    public function getTopGames(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM games JOIN images ON games.image = images.id ORDER BY likes/NULLIF(likes+dislikes,0) desc LIMIT 1;
        ');

        return $this->fetch_games($stmt, $result);
    }

    public function getPlayerGames(int $userId): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM games JOIN images ON games.image = images.id WHERE games.owner = :id;
        ');

        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        return $this->fetch_games($stmt, $result);
    }

    public function getGameByTitle(string $searchString)
    {
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM games WHERE LOWER(title) LIKE :search OR LOWER(description) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function like(int $id) {
        $stmt = $this->database->connect()->prepare('
            UPDATE games SET "like" = "like" + 1 WHERE id = :id
         ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function dislike(int $id) {
        $stmt = $this->database->connect()->prepare('
            UPDATE games SET dislike = dislike + 1 WHERE id = :id
         ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function insertGameSql()
    {
        return '
            INSERT INTO games (name, likes, dislikes, description, steamid, owner, image)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ';
    }

    public function insertImageSql()
    {
        return '
            INSERT INTO images (binary_data)
            VALUES (?)
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
                $game['likes'],
                $game['dislikes'],
                $game['id']
            );
        }

        return $result;
    }
}