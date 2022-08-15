<?php


namespace App\Exceptions;

class AuthontificationException extends BaseException
{
    /** @var string */
    protected string $errors =  'Неправильный логин или пароль';
    protected int $statusCode = 408;
}
