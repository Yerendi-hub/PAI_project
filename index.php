<?php

require_once 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);


Routing::get('', "DefaultController");
Routing::get('index', "DefaultController");
Routing::post('getSingleGame', "AppController");
Routing::post('search', "DefaultController");
Routing::get('login', "LoginController");
Routing::get('logout', "LoginController");
Routing::get('register', "LoginController");
Routing::post('postLogin', "LoginController");
Routing::post('registerUser', "LoginController");
Routing::post('addGame', "UserGamesController");
Routing::get('singleGame', "SingleGameController");
Routing::post('voteUp', "SingleGameController");
Routing::post('voteDown', "SingleGameController");
Routing::post('deleteGame', "SingleGameController");
Routing::get('topGames', "TopGamesController");
Routing::get('userGames', "UserGamesController");
Routing::get('contact', "FavoriteGamesController");
Routing::get('error', "ErrorController");
Routing::get('favoriteGames', "FavoriteGamesController");
Routing::run($path);