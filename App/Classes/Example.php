<?php
declare(strict_types = 1);

/**
 * Аналог класса поиска в БД
 * Для примера
 * 
 * @author Anton Kurmaev
 */
class Example
{
  const DEFAULT_LOGIN = 'example';
  const DEFAULT_PASSWORD = "qwerty1234";
  const DEFAULT_EMAIL = 'example@example.com';
  const DEFAULT_REGISTER_DATE = '22.11.2020 10:14:03';
  const DEFAULT_NAME = 'User';

  /**
   * Проверка наличия комбинации логина и пароля в "БД"
   * 
   * @param string $login
   * @param string $password
   * 
   * @return bool
   */
  public static function canAuth(string $login, string $password): bool
  {
    // В базе данных пароль должен храниться в хэше,
    // поэтому хэшируем для более реалистичных действий
    $hash = password_hash(self::DEFAULT_PASSWORD, PASSWORD_DEFAULT);
    return ($login === self::DEFAULT_LOGIN && password_verify($password, $hash));
  }

  /**
   * Проверка существования пользователя с указанным логином в "БД"
   * @param string $login
   * 
   * @return array
   */
  public static function findUser(string $login): array
  {
    if ($login !== self::DEFAULT_LOGIN)
      return [];
    return [self::DEFAULT_LOGIN, self::DEFAULT_NAME, self::DEFAULT_EMAIL, self::DEFAULT_REGISTER_DATE, password_hash(self::DEFAULT_PASSWORD, PASSWORD_DEFAULT)];
  }
}