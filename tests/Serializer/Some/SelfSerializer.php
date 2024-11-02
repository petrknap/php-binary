<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer\Some;

use PetrKnap\Binary\Serializer\SelfSerializerInterface;
use PetrKnap\Binary\Serializer\SelfSerializerTrait;
use stdClass;

final class SelfSerializer implements SelfSerializerInterface
{
    use SelfSerializerTrait;

    public readonly self|null $innerInstance;

    public function __construct(
        public readonly int $scalar,
        public readonly stdClass $serializable,
        self|string|null $innerInstance,
        public mixed $variable,
    ) {
        $this->innerInstance = match (is_string($innerInstance)) {
            true => self::fromBinary($innerInstance),
            false => $innerInstance,
        };
        $this->referencesToConstructorArgs = [
            $this->scalar,
            $this->serializable,
            $this->innerInstance,
            &$this->variable,
        ];
    }
}
