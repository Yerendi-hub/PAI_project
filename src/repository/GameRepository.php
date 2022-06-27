<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Game.php';

class GameRepository extends Repository
{
    public function getGame(int $id): ?Game
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.games WHERE id = :id
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
            $game['steamId']
        );
    }

    public function addGame(Game $game): void
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO games (name, likes, dislikes, description, steamId, owner)
            VALUES (?, ?, ?, ?, ?, ?)
        ');

        //TODO you should get this value from logged user session
        $assignedById = 1;

        $stmt->execute([
            $game->getName(),
            $game->getLikes(),
            $game->getDislikes(),
            $game->getDescription(),
            $game->getSteamId(),
            $assignedById
        ]);
    }

    public function getGames(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM games;
        ');
        $stmt->execute();
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($games as $game) {
            $result[] = new Game(
                $game['name'],
                $game['description'],
                $game['steamId'],
                $game['owner'],
                $game['likes'],
                $game['dislikes'],
                $game['id']
            );
        }

        return $result;
    }

    public function getTopGames(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM games ORDER BY likes/NULLIF(likes+dislikes,0) desc LIMIT 1;
        ');

        $stmt->execute();
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($games as $game) {
            $result[] = new Game(
                $game['name'],
                $game['description'],
                $game['steamId'],
                $game['owner'],
                $game['likes'],
                $game['dislikes'],
                $game['id']
            );
        }

        return $result;
    }

    public function getPlayerGames(int $userId): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM games WHERE owner = :id;
        ');

        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($games as $game) {
            $result[] = new Game(
                $game['name'],
                $game['description'],
                $game['steamId'],
                $game['owner'],
                $game['likes'],
                $game['dislikes'],
                $game['id']
            );
        }

        return $result;
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
}