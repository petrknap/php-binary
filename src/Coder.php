<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

/**
 * @phpstan-consistent-constructor override {@see self::create()} if not
 *
 * @implements CoderInterface<Exception\CouldNotCodeData>
 */
abstract class Coder implements CoderInterface
{
    protected const BASE64_URL_SAFE_MAP = [
        ['+', '/', '='],
        ['-', '_', ''],
    ];

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
