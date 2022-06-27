<?php

require_once 'Routing.php';
require_once 'src/models/SteamTopGames.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);


Routing::get('', "DefaultController");
Routing::get('index', "DefaultController");
Routing::get('login', "LoginController");
Routing::get('logout', "LoginController");
Routing::post('postLogin', "LoginController");
Routing::get('singleGame', "SingleGameController");
Routing::get('topGames', "TopGamesController");
Routing::get('userGames', "UserGamesController");
Routing::get('contact', "FavoriteGamesController");
Routing::get('error', "ErrorController");
Routing::run($path);
//SteamTopGames::init();