<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use PetrKnap\Shorts\Exception;

/**
 * @internal please use subclass
 *
 * @phpstan-consistent-constructor override {@see self::create()} if not
 *
 * @implements CoderInterface<Exception\CouldNotProcessData>
 */
abstract class Coder implements CoderInterface
{
    public function __construct(
        protected readonly string $data = '',
    ) {
    }

    public function withData(string $data): static
    {
        return static::create($this, $data);
    }

    public function getData(): string
    {
        return $this->data;
    }

    protected static function create(self $coder, string $data): static
    {
        return new static($data);
    }
}
