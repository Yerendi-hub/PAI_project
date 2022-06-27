<?php

require_once __DIR__.'/../utils/SessionManager.php';

class AppController {
    private $request;
    protected $sessionManager;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
        $this->sessionManager = new SessionManager();
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
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