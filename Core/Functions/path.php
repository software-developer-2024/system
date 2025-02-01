<?php

function uriIs($path)
{
    return parse_url($_SERVER['REQUEST_URI'])['path'] == $path;
}

function showImage($path)
{
    return "../../../../../../../../../img\\" . $path;
}

function js($path)
{
    return "../../../../../../../../../js\\" . $path;
}

function css($path)
{
    return "../../../../../../../../../css\\" . $path;
}

function base_path($path)
{
    return BASE_PATH . $path;
}