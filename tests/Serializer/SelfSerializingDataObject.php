<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

use stdClass;

final class SelfSerializingDataObject implements SelfSerializerInterface
{
    use SelfSerializerTrait;

    public const BINARY_B64 = 'S7QysarOtDKwzrQyBGN/KwsrpeKSFOecxOJiJStDq+piK2MrpbT8fCVrMCspsUjJujbTygjINTQxtVLy3mK0cdW5LUYbgJgpyTm7Xptbe+mjSSLP5xx5lKSq7bz6VZJ2svbSLX9qVLMNtDU3epzcJbZkz41Td454nazuvngs9Pk2iVyGpG0qz99U5ea9Xdqv1mkzv/hJ4KRV2z6/Cve8dfKW9/Y/KwPPml24dudFYdH0m0+D1fM+ro+sfHxFVt/XO9W5Njo4jNeNTXUBc8/av2uyGZWAHjG29rOuBQA=';

    public readonly ?self $innerInstance;

    private function __construct(
        public readonly int $scalar,
        public readonly stdClass $serializable,
        self|string|null $innerInstance = null,
        public mixed $variable = null,
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

    public static function getInstance(): self
    {
        $stdClass = new stdClass();
        $stdClass->foo = 'bar';

        $instance = new self(
            1,
            $stdClass,
            new self(
                2,
                $stdClass,
                new self(
                    3,
                    $stdClass,
                    variable: 'value',
                ),
            ),
        );

        $instance->innerInstance->innerInstance->variable = 'changed';

        return $instance;
    }
}
