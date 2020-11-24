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
  /**
   * Имя пользователя
   * 
   * @var string 
   */
  protected $name;
  
  /**
   * Электронная почта пользователя
   * 
   * @var string
   */
  protected $email;
  /**
   * Дата-время регистрации пользователя
   * 
   * @var string
   */
  protected $registered;

  /**
   * Логин пользователя
   * 
   * @var string
   */
  protected $login;

  /**
   * Хэш пароля пользователя
   * 
   * @var string
   */
  private $hash;

  /**
   * Получить данные о пользователе в текущем объекта
   * 
   * @return array
   */
  public function getInfo(): array
  {
    return [
      'NAME' => $this->name,
      'EMAIL' => $this->email,
      'REGISTER_DATE' => $this->registered,
      'LOGIN' => $this->login
    ];
  }

  /**
   * Проверка авторизации пользователя
   * 
   * @return bool
   */
  public function isAuth(): bool
  {
    return !empty($this->login);
  }

  /**
   * Получить логин пользователя в текущем объекте
   * 
   * @return string
   */
  public function getLogin(): string
  {
    return $this->login;
  }
  /**
   * Получить хэш от пароля пользователя в текущем объекте
   * 
   * @return string
   */
  public function getPasswordHash(): string
  {
    return $this->hash;
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
      list($this->login, $this->name, $this->email, $this->registered, $this->hash) = $user;
    }
  }
}