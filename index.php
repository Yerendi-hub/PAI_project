<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);


Routing::get('', "DefaultController");
Routing::get('index', "DefaultController");
Routing::get('login', "LoginController");
Routing::post('postLogin', "LoginController");
Routing::get('singleGame', "SingleGameController");
Routing::get('topGames', "TopGamesController");
Routing::get('userGames', "UserGamesController");
Routing::get('contact', "ContactController");
Routing::get('error', "ErrorController");
Routing::run($path);