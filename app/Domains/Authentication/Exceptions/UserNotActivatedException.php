<?php

namespace App\Domains\Authentication\Exceptions;
use Exception;
use GraphQL\Error\ClientAware;
use GraphQL\Error\ProvidesExtensions;

class UserNotActivatedException extends Exception implements ClientAware, ProvidesExtensions
{
    /** @var @string */
    protected string $reason;

    public function __construct(string $message, string $reason=null)
    {
        parent::__construct($message);

        $this->reason = $reason;
    }

    /**
     * Returns true when exception message is safe to be displayed to a client.
     */
    public function isClientSafe(): bool
    {
        return true;
    }

    /**
     * Data to include within the "extensions" key of the formatted error.
     *
     * @return array<string, mixed>
     */
    public function getExtensions(): array
    {
        return [
            'some' => 'additional information',
            'reason' => $this->reason,
        ];
    }
}
