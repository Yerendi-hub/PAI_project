<?php

class SingleGameController extends AppController{
    public function singleGame()
    {
        $this->render('singleGame');
    }

    public function voteUp()
    {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $game = $_POST['gameId'];

        $this->gameRepository->addVote(1, $game);
        $this->getSingleGame();
    }

    public function voteDown()
    {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $game = $_POST['gameId'];

        $this->gameRepository->addVote(0, $game);
        $this->getSingleGame();
    }

    public function deleteGame()
    {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $game = $_POST['gameId'];

        $this->gameRepository->deleteGame($game);
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/index");
    }

}