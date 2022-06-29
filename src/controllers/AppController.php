<?php

require_once __DIR__.'/../utils/SessionManager.php';
require_once __DIR__.'/../repository/GameRepository.php';

class AppController {
    private $request;
    protected $sessionManager;
    protected $gameRepository;
    protected $userRepository;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
        $this->sessionManager = new SessionManager();
        $this->gameRepository = new GameRepository();
        $this->userRepository = new UserRepository();
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    public function getSingleGame()
    {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $gameId = $_POST['gameId'];
        $game = $this->gameRepository->getGame((int)$gameId);

        if (!$game) {
            return $this->render('index');
        }

        return $this->render('singleGame', ['game' => [$game]]);
    }

    protected function render(string $template = null, array $variables = [])
    {
        if($this->sessionManager->validateSession())
        {
            $variables['isLogin'] = 'true';
        }

        $templatePath = 'public/views/'. $template.'.php';
        $output = 'File not found';

        if(file_exists($templatePath)){
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }
}