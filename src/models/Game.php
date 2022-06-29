<?php

class Game
{
    private $dbId;
    private $steamId;
    private $name;
    private $description;
    private $owner;
    private $image;
    private $votes;
    private $userVote;
    private $ccu;
    private $canUserDeleteGame;

    public function __construct($name, $description, $steamId, $owner, $image, $votes = 0, $id = null, $userVote = -1, $canUserDeleteGame = false)
    {
        $this->dbId = $id;
        $this->steamId = $steamId;
        $this->name = $name;
        $this->description = $description;
        $this->owner = $owner;
        $this->image = $image;
        $this->votes = $votes;
        $this->userVote = $userVote;
        $this->canUserDeleteGame = $canUserDeleteGame;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @return int|mixed
     */
    public function getUserVote()
    {
        return $this->userVote;
    }

    /**
     * @param int|mixed $userVote
     */
    public function setUserVote($userVote): void
    {
        $this->userVote = $userVote;
    }


    /**
     * @param mixed $owner
     */
    public function setOwner($owner): void
    {
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed|null
     */
    public function getDbId()
    {
        return $this->dbId;
    }

    /**
     * @return mixed
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @param mixed $votes
     */
    public function setVotes($votes): void
    {
        $this->votes = $votes;
    }

    /**
     * @return false|mixed
     */
    public function getCanUserDeleteGame()
    {
        return $this->canUserDeleteGame;
    }

    /**
     * @param false|mixed $canUserDeleteGame
     */
    public function setCanUserDeleteGame($canUserDeleteGame): void
    {
        $this->canUserDeleteGame = $canUserDeleteGame;
    }

    /**
     * @param mixed|null $dbId
     */
    public function setDbId($dbId): void
    {
        $this->dbId = $dbId;
    }

    /**
     * @return mixed
     */
    public function getSteamId()
    {
        return $this->steamId;
    }

    /**
     * @param mixed $steamId
     */
    public function setSteamId($steamId): void
    {
        $this->steamId = $steamId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }


}