<?php

namespace PHPFramework;

class Response
{
    public function setResponseCode(int $code): void
    {
        http_response_code($code);
    }

    public function redirect($url = '')
    {
        if($url) {
            $redirect = $url;
        } else {
            // HTTP_REFERER -- значение в котором хранится инфа о том откуда пользователь пришел
            $redirect = $_SERVER['HTTP_REFERER'] ?? base_url('/');
        }

        header("Location: $redirect");
        die;
    }
}