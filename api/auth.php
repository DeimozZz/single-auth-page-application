<?php
include $_SERVER['DOCUMENT_ROOT'] . '/App/header.php';
use Helpers\Authorize;

$login = htmlspecialchars($_REQUEST['login']);
$password = htmlspecialchars($_REQUEST['password']);
$remember = ( isset($_REQUEST['remember']) && $_REQUEST['remember'] == "N" ? false : true);

$authRes = Authorize::logIn($login, $password, $remember);
if ($authRes['type'] == 'OK') {
  $arOut['success'] = true;
  $arOut['user'] = $_SESSION['USER']->getInfo()['NAME'];
} else {
  $arOut['success'] = false;
}

$arOut['result'] = $authRes['text'];

echo json_encode($arOut, JSON_UNESCAPED_UNICODE);