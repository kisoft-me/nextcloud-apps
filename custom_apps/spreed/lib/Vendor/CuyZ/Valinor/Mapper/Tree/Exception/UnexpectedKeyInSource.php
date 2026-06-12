<?php

declare(strict_types=1);

namespace OCA\Talk\Vendor\CuyZ\Valinor\Mapper\Tree\Exception;

use OCA\Talk\Vendor\CuyZ\Valinor\Mapper\Tree\Message\ErrorMessage;
use OCA\Talk\Vendor\CuyZ\Valinor\Mapper\Tree\Message\HasCode;
use OCA\Talk\Vendor\CuyZ\Valinor\Mapper\Tree\Message\HasParameters;

/** @internal */
final class UnexpectedKeyInSource implements ErrorMessage, HasCode, HasParameters
{
    private string $body = 'Unexpected key {key}.';

    private string $code = 'unexpected_key';

    /** @var array<string, string> */
    private array $parameters;

    public function __construct(string $key)
    {
        $this->parameters = [
            'key' => "`$key`",
        ];
    }

    public function body(): string
    {
        return $this->body;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function parameters(): array
    {
        return $this->parameters;
    }
}
