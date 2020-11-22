<?php
include $_SERVER['DOCUMENT_ROOT'] . '/App/header.php';
use Helpers\Authorize;

$login = htmlspecialchars($_REQUEST['login']);
$password = htmlspecialchars($_REQUEST['password']);
$remember = ( isset($_REQUEST['remember']) && $_REQUEST['remember'] == "N" ? false : true);

$arOut['result'] = Authorize::logIn($login, $password, $remember);

echo json_encode($arOut, JSON_UNESCAPED_UNICODE);