<?php


namespace App\Exceptions;


use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class BaseException extends HttpException
{
    /** @var string */
    protected string $errors;

    /** @var int */
    protected int $statusCode;

    /**
     * @param string $errors
     * @param Throwable|null $previous
     * @param int $code
     */
    public function __construct(string $errors = '', Throwable $previous = null, int $code = 0)
    {
        parent::__construct(
            $this->statusCode ?: 500,
            $errors,
            $previous,
            [],
            $code
        );
    }

    /**
     * @return string
     */
    public function getErrors(): string
    {
        return $this->errors;
    }
}
