<?php

namespace PHPFramework;

class Router
{
    private array $routes = [];
    private array $route_params = [];
    public function __construct(private Request $request, private Response $response) {}

    public function get($path, $callback)
    {
        return $this->add($path, $callback, 'GET');
    }

    public function post($path, $callback)
    {
        return $this->add($path, $callback, 'POST');
    }

    public function add($path, $callback, $method)
    {
        $path = trim($path, '/');

        if(is_array($method)) {
            $method = array_map('strtoupper', $method);
        } else {
            $method = [strtoupper($method)];
        }

        $this->routes[] = [
            'path' => "/$path",
            'callback' => $callback,
            'middleware' => '',
            'method' => $method,
            'needCsrfToken' => true
        ];

        return $this;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function dispatch()
    {
        $path = $this->request->getPath();

        $route = $this->matchRoute($path);

        if(false === $route) {
            $this->response->setResponseCode(404);
            echo '404 - Page not Found';
            die;
        }

        [ $controller, $action ] = $route['callback'];

        $controller = new $controller();

        return call_user_func([$controller, $action]);
    }

    private function matchRoute($path)
    {
        foreach($this->routes as $route) {
            if(preg_match("#^{$route['path']}$#", "/{$path}", $matches) && in_array($this->request->getMethod(), $route['method'])) {
                if(request()->isPost()) {
                    if($route['needCsrfToken'] && !$this->checkCsrfToken()) {
                        if(request()->isAjax()) {
                            echo json_encode([
                                'status' => 'error',
                                'data' => 'Security CSRF error'
                            ]);
                            return die;
                        }

                        session()->setFlash('error', 'Ошибка безопасности CSRF');
                        response()->redirect();
                    }
                }

                foreach($matches as $k => $v) {
                    if(is_string($k)) {
                        $this->route_params[$k] = $v;
                    }
                }

                return $route;
            }
        }

        return false;
    }

    public function checkCsrfToken(): bool
    {
        // проверяем наличие csrf_token в POST запросе и затем сравниваем это значение с тем что хранится в сессии
        return request()->post('csrf_token') && (request()->post('csrf_token') === session()->get('csrf_token'));
    }

    public function withoutCsrfToken(): self
    {
        $this->routes[array_key_last($this->routes)]['needCsrfToken'] = false;

        return $this;
    }
}