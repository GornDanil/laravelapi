<?php


namespace App\Exceptions;

class ResetPasswordException extends BaseException
{
    /** @var string */
    protected string $errors =  'Такого пользователя не существует';
    protected int $statusCode = 408;
}
