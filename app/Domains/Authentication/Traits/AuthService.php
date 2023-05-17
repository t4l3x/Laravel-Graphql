<?php

namespace App\Domains\Authentication\Traits;

use App\Domains\Authentication\Services\AuthService;

trait AuthService
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
}
