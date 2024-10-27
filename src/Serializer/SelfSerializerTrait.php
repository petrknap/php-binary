<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

use PetrKnap\Binary\Binary;

/**
 * If your {@see self::__construct()} argument is an instance of {@see SelfSerializerInterface} then
 * accept it as a union type `YourClass|string` and call {@see SelfSerializerInterface::fromBinary()} if it is a string.
 */
trait SelfSerializerTrait
{
    /**
     * References to {@see self::__construct()} arguments (`&$argument`)
     */
    private readonly array $referencesToConstructorArgs;

    public function toBinary(): string
    {
        return Binary::serialize(array_map(
            static fn (mixed $constructorArg): mixed => match ($constructorArg instanceof SelfSerializerInterface) {
                true => $constructorArg->toBinary(),
                false => $constructorArg,
            },
            $this->referencesToConstructorArgs,
        ));
    }

    public static function fromBinary(string $data): self
    {
        return new self(...Binary::unserialize($data));
    }
}
