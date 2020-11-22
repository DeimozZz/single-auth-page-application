<?php
session_start();
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('CLASSES', ROOT . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . 'Classes');

if (!is_object($_SESSION['USER']) && isset($_COOKIE['key']) && isset($_COOKIE['login'])) {
  Helpers\Authorize::authByHash($_COOKIE['login'], $_COOKIE['key']);
}

function getPath($path) {
  return str_replace([ "/", '\\', '//'], DIRECTORY_SEPARATOR, $path);
}

spl_autoload_register(function ($class) {
    include_once getPath(CLASSES . "/{$class}.php");
});