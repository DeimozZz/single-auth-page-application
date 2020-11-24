<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('CLASSES', ROOT . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . 'Classes');
include_once CLASSES . getPath('/Base/User.php');

session_start();
function getPath($path) {
  return str_replace([ "/", '\\', '//'], DIRECTORY_SEPARATOR, $path);
}

spl_autoload_register(function ($class) {
    include_once getPath(CLASSES . "/{$class}.php");
});

if (!is_object($_SESSION['USER'])) {
  $_SESSION['USER'] = new Base\User();
}

if (!$_SESSION['USER']->isAuth() && isset($_COOKIE['key']) && isset($_COOKIE['login'])) {
  Helpers\Authorize::authByHash($_COOKIE['login'], $_COOKIE['key']);
}