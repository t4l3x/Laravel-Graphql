<?php

namespace App\Domains\Authentication\Traits;

use App\Domains\Authentication\Services\AuthService;

trait AuthServiceTrait
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
}
