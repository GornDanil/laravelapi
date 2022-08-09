<?php

namespace App\Services\Workers\Abstracts;

interface WorkersServiceInterface
{
    /**
     * @param object $user
     */
    public function workers(object $user);
}
