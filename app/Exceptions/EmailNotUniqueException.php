<?php


namespace App\Exceptions;

class EmailNotUniqueException extends BaseException
{
    /** @var string */
    protected string $errors = 'Пользователь с таким Email уже существует';
    protected int $statusCode = 409;
}
