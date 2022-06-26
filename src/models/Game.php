<?php

class Game
{
    private $dbId;
    private $steamId;
    private $name;
    private $ccu;
    private $image;

    public function __construct($dbId, $steamId, $name, $ccu, $image)
    {
        $this->dbId = $dbId;
        $this->steamId = $steamId;
        $this->name = $name;
        $this->ccu = $ccu;
        $this->image = $image;
    }

    public function getDbId()
    {
        return $this->dbId;
    }

    public function setDbId($dbId): void
    {
        $this->dbId = $dbId;
    }

    public function getSteamId()
    {
        return $this->steamId;
    }

    public function setSteamId($steamId): void
    {
        $this->steamId = $steamId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getCcu()
    {
        return $this->ccu;
    }

    public function setCcu($ccu): void
    {
        $this->ccu = $ccu;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }


}