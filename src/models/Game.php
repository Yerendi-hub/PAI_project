<?php

class Game
{
    private $dbId;
    private $steamId;
    private $name;
    private $description;
    private $likes;
    private $dislikes;
    private $owner;
    private $image;

    public function __construct($name, $description, $steamId, $owner, $image, $likes = 0, $dislikes = 0, $id = null)
    {
        $this->dbId = $id;
        $this->steamId = $steamId;
        $this->name = $name;
        $this->description = $description;
        $this->likes = $likes;
        $this->dislikes = $dislikes;
        $this->owner = $owner;
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
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

    /**
     * @return int|mixed
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param int|mixed $likes
     */
    public function setLikes($likes): void
    {
        $this->likes = $likes;
    }

    /**
     * @return int|mixed
     */
    public function getDislikes()
    {
        return $this->dislikes;
    }

    /**
     * @param int|mixed $dislikes
     */
    public function setDislikes($dislikes): void
    {
        $this->dislikes = $dislikes;
    }


}