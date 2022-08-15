<?php


namespace App\Exceptions;

class AccessException extends BaseException
{
    /** @var string */
    protected string $errors =  'У вас нет прав для просмотра данной страницы';
    protected int $statusCode = 408;
}
