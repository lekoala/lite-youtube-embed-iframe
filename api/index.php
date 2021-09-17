<?php

require dirname(__DIR__) . '/vendor/autoload.php';

define('REQUEST_URI', $_SERVER['SCRIPT_NAME'] ?? '/');
define('REQUEST_PARTS', explode("/", trim(REQUEST_URI, '/'), 10));

switch (REQUEST_PARTS[0]) {
    case '':
        require 'home.php';
        break;
    case 'embed':
        require 'embed.php';
        break;
    case 'generate':
        require 'generate.php';
        break;
    case 'demo':
        $which = REQUEST_PARTS[1] ?? '';
        if ($which == "lite") {
            require "demo-lite.php";
        } elseif ($which == "regular") {
            require "demo-regular.php";
        } else {
            http_response_code(404);
        }
        break;
    default:
        http_response_code(404);
}
