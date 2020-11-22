<?php
declare(strict_types = 1);
namespace Base;

use Example;

/**
 * Класс реализующий представление пользователя в системе
 * 
 * @author Anton Kurmaev
 */
class User
{
  protected static $name;
  protected static $email;
  protected static $registered;
  protected static $login;
  private static $hash;

  /**
   * Получить данные о пользователе в текущем объекта
   * 
   * @return array
   */
  public static function getInfo(): array
  {
    return [
      'NAME' => self::$name,
      'EMAIL' => self::$email,
      'REGISTER_DATE' => self::$registered,
      'LOGIN' => self::$login
    ];
  }

  /**
   * Получить логин пользователя в текущем объекте
   * 
   * @return string
   */
  public static function getLogin(): string
  {
    return self::$login;
  }
  /**
   * Получить хэш от пароля пользователя в текущем объекте
   * 
   * @return string
   */
  public static function getPasswordHash(): string
  {
    return self::$hash;
  }

  /**
   * Запись в текущий объект данных пользователя
   * 
   * @param $login
   * 
   * @return void
   */
  public function findByLogin(string $login): void
  {
    if ( count( $user = Example::findUser($login) ) ) {
      list(self::$login, self::$name, self::$email, self::$registered, self::$hash) = $user;
    }
  }
}