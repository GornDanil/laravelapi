<?php


namespace App\Exceptions;

class ResetPasswordErrorException extends BaseException
{
    /** @var string */
    protected string $errors =  'Токен недействителен';
    protected int $statusCode = 404;
}
