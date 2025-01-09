<?php

namespace PHPFramework;

class Application
{
    public Request $request;
    public Router $router;
    public Response $response;
    public View $view;
    public Session $session;
    public static Application $app;

    public function __construct()
    {
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->view = new View();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);

        $this->generateCsrfToken();
    }

    public function run()
    {
        $this->router->dispatch();
    }

    public function generateCsrfToken()
    {
        if(!session()->has('csrf_token')) {
            session()->set('csrf_token', md5(uniqid(mt_rand(), true)));
        }
    }
}