<?php

namespace PHPFramework;

class Application
{
    public Request $request;
    public Router $router;
    public Response $response;
    public View $view;
    public static Application $app;

    public function __construct()
    {
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->view = new View();
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        $this->router->dispatch();
    }
}