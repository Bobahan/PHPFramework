<?php

namespace PHPFramework;

class Request
{
    private string $uri;
    public function __construct()
    {
        $this->uri = trim(urldecode($_SERVER['REQUEST_URI']), '/');
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(): bool 
    {
        return $this->getMethod() === 'GET';
    }

    public function isPost(): bool 
    {
        return !$this->isGet();
    }

    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    // я хочу из такого URL /?page=2 например получить 2, тогда в качестве $name я передаю ключ 'page'
    public function get($name, $default = null): ?string
    {
        return $_GET[$name] ?? $default;
    }

    public function post($name, $default = null): ?string
    {
        return $_POST[$name] ?? $default;
    }

    public function getPath(): string
    {
        return $this->removeQueryString();
    }

    // метод который убирает queryString, оставляя при этом только сам path
    private function removeQueryString(): string
    {
        if($this->uri) {
            $params = explode('?', $this->uri);

            [ $path ] = $params;

            return trim($path, '/');
        }

        return '';
    }

    public function getData(): array
    {
        $data = [];
        $request_data = $this->isPost() ? $_POST : $_GET;

        foreach($request_data as $k => $v) {
            $data[$k] = trim($v);
        }

        return $data;
    }
}