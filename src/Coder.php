<?php

declare(strict_types=1);

namespace PetrKnap\Binary;

use PetrKnap\Shorts\Exception;
use Stringable;

/**
 * @internal please use subclass
 *
 * @phpstan-consistent-constructor override {@see self::create()} if not
 *
 * @implements CoderInterface<Exception\CouldNotProcessData>
 */
abstract class Coder implements CoderInterface, Stringable
{
    /**
     * @param string $data may contain binary data
     */
    public function __construct(
        public readonly string $data = '',
    ) {
    }

    public function withData(string $data): static
    {
        return static::create($this, $data);
    }

    /**
     * @deprecated use readonly property {@see self::$data}
     */
    final public function getData(): string
    {
        return $this->data;
    }

    /**
     * @note this is just a helper, this class is not supposed to implement {@see BinariableInterface}
     */
    public function __toString(): string
    {
        return $this->data;
    }

    protected static function create(self $coder, string $data): static
    {
        return new static($data);
    }
}
