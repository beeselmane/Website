<?php

// t, r
// t --> style, theme, script
// r --> resource name

if (!isset($_GET['t']) || !isset($_GET['r'])) die();

require_once 'config.php';

$resource_type = $_GET['t'];
$resource_name = $_GET['r'];

function is_valid_name($name)
{
    return !preg_match('/[^_\s-A-Za-z0-9\.]/', $name);
}

function load_path($type, $name)
{
    $path = SERVER_ROOT . '/private/';

    switch ($type)
    {
        case 'style': {
            $path .= 'css/' . $name . '.css';
            header('Content-Type: text/css');
        } break;
        case 'script': {
            $path .= 'js/' . $name . '.js';
       	    header('Content-Type: text/javascript');
        } break;
        case 'theme': {
            $path .= 'themes/';

            if ($name === 'current') {
                $path .= SITE_THEME;
            } else {
                $path .= $name;
            }

            $path .= '.css';
       	    header('Content-Type: text/css');
        } break;
        case 'cx': {
            $path .= 'cxdox/' . $name;

            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . $name . '"');
        } break;
        case 'generic': {
            $path .= 'resources/' . $name;
            header('Content-Type: image/jpeg');
        } break;
        default: return '';
    }

    return $path;
}

if (!is_valid_name($resource_name)) die();
$resource_path = load_path($resource_type, $resource_name);

if ($resource_path)
{
    if (!file_exists($resource_path)) die();

    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($resource_path));
    header('Accept-Ranges: bytes');

    @readfile($resource_path) or die('Unexpected Error!');
}
