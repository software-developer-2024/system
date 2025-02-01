<?php

function view($path, $attributes = [])
{

    extract($attributes);

    return require base_path('public/views/' . $path);
}

function action($path, $attributes = [])
{

    extract($attributes);

    return require base_path('controllers/action/' . $path);
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/error/{$code}.php");

    die();

}