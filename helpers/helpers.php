<?php

function app(): PHPFramework\Application {
    return PHPFramework\Application::$app;
}

function request(): PHPFramework\Request {
    return app()->request;
}

function response(): PHPFramework\Response {
    return app()->response;
}

function router(): PHPFramework\Router {
    return app()->router;
}

function view($view = '', $data = [], $layout = ''): string|PHPFramework\View {
    if($view) {
        return app()->view->render($view, $data, $layout);
    }

    return app()->view;
}

function session(): PHPFramework\Session {
    return app()->session;
}

function get_alerts() {
    if(!empty($_SESSION)) {
        foreach($_SESSION as $key => $value) {
            if($key === 'flash') {
                $type = (!empty($value['error'])) ? 'error' : 'success';

                echo view()->renderPartial("alert_{$type}", [
                    "flash_{$type}" => session()->getFlash($type),
                ]);

                session()->remove('flash');
            }
        }
    }
}

// fieldname может принимать name, email, password, ...
function get_errors(string $fieldname): string {
    $output = '';

    $errors = session()->get('form_errors');

    if(isset($errors[$fieldname])) {
        $output .= "<div class='invalid-feedback d-block'><ul class='list-unstyled'>";
        foreach($errors[$fieldname] as $error) {
            $output .= "<li>$error</li>";
        }
        $output .= "<ul/></div>";
    }

    return $output;
}

function old(string $fielname): string {
    $form_data = session()->get('form_data');

    return isset($form_data[$fielname]) ? h($form_data[$fielname]) : '';
}

function get_validation_class($fieldname) {
    $errors = session()->get('form_errors');

    if(empty($errors)) {
        return '';
    }

    return isset($errors[$fieldname]) ? 'is-invalid' : 'is-valid';
}


function h(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES);
}

function abort($error = '', $code = 404) {
    response()->setResponseCode($code);

    echo view("errors/$code", ['error' => $error], false);
    die;
}

function base_url($path = ''): string {
    return PATH . $path;
}