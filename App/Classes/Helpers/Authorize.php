<?php
declare(strict_types = 1);
namespace Helpers;
use Base\User;
use Example;

/**
 * Класс реализующий механизм авторизация и выхода из системы
 * 
 * @author Anton Kurmaev
 */
class Authorize
{
  /**
   * Авторизовать пользователя по логину и паролю
   * 
   * @param string $login
   * @param string $password
   * @param bool $remember
   * 
   * @return string
   */
  public static function logIn(string $login, string $password, ?bool $remember = false): string
  {
    $result = 'Введены не верные логин или пароль';
    if ( Example::canAuth($login, $password) ) {
        $user = new User();
        $user->findByLogin($login);
        self::Auth($user, $remember);
        $result = 'Авторизация прошла успешно!';
    }
    return $result;
  }

  /**
   * Разлогинить пользователя
   * 
   * @return string
   */
  public static function logOut(): string
  {
    $_SESSION['isAuth'] = false;
    unset($_SESSION['USER'], $_COOKIE['login'], $_COOKIE['key']);
    session_destroy();
    return 'Вы разлогинились ...';
  }

  /**
   * Авторизация пользователю по хэшу и логину хранимым в coockie
   * 
   * @param string $login
   * @param string $hash Хэш от хэша пароля пользователя
   */
  public static function authByHash(string $login, string $hash): void
  {
    $user = new User();
    $user->findByLogin($login);
    if (md5($user->getPasswordHash()) == $hash) {
      self::Auth($user, false);
    }
  }

  /**
   * Проведение мероприятий по авторизации пользователя
   * 
   * @param User $user
   * @param bool $remember
   * 
   * @return void
   */
  protected static function Auth(User $user, bool $remember): void
  {
    $_SESSION['USER'] = $user;
    $_SESSION['isAuth'] = true;
    if ($remember) {
      $_COOKIE['login'] = $user->getLogin();
      $_COOKIE['key'] = md5($user->getPasswordHash());
    }
  }
}