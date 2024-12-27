<?php

namespace PHPFramework;

class View
{
    public string $layout = LAYOUT;
    public string $content = '';

    public function __construct() {}

    public function render($path, $data = [], $layout = ''): string
    {
        extract($data);

        $path_to_file = VIEWS . "/pages/$path.php";

        if(is_file($path_to_file)) {
            ob_start();
            require $path_to_file;
            $this->content = ob_get_clean();
        } else {
            abort("Not found View $path_to_file", 500);
        }

        if(false === $layout) {
            return $this->content;
        }

        $layout_filename = $layout ?: $this->layout;

        $path_to_layout = VIEWS . "/layouts/$layout_filename.php";

        if(is_file($path_to_layout)) {
            ob_start();
            require_once $path_to_layout;
        } else {
            abort("Not found View $path_to_layout", 500);
        }

        return '';
    }
}