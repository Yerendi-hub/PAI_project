<?php

require_once 'src/utils/CurlRequests.php';
require_once 'src/models/Game.php';

class SteamTopGames
{
    public static $games;

    public static function init()
    {
        $gamesResp = CurlRequests::get("https://steamspy.com/api.php?request=top100in2weeks");
        $tempGames = [];
        $gamesRespJson = json_decode($gamesResp, TRUE);

        foreach ($gamesRespJson as $singleGame) {
            $game = new Game(
                0,
                $singleGame['appid'],
                $singleGame['name'],
                $singleGame['ccu'],
                ""
            );
            $tempGames[(int)$singleGame['ccu']] = $game;
        }

        krsort($tempGames);
        $tempGames = array_slice( $tempGames, 0, 20 );

        foreach ($tempGames as $item) {
            self::$games[(int)$item->getSteamId()] = $item;
        }

        foreach (self::$games as $item) {
            $gameResp = CurlRequests::get("https://store.steampowered.com/api/appdetails?appids=".
                $item->getSteamId());

            if(curl_errno(CurlRequests::$lastCurl) === 0)
            {
                $gameRespJson = json_decode($gameResp, TRUE);
                $item->setImage($gameRespJson[$item->getSteamId()]["data"]["header_image"]);
            }
        }

        foreach (self::$games as $item) {
            echo($item->getName()." ");
        }
    }



}