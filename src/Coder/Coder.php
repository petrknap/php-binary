<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

use Throwable;

abstract class Coder implements CoderInterface
{
    public function encode(string $decoded): string
    {
        try {
            return $this->doEncode($decoded);
        } catch (Throwable $reason) {
            if ($reason instanceof Exception\CouldNotEncodeData) {
                throw $reason;
            }
            throw new Exception\CouldNotEncodeData(__METHOD__, $decoded, $reason);
        }
    }

    public function decode(string $encoded): string
    {
        try {
            return $this->doDecode($encoded);
        } catch (Throwable $reason) {
            if ($reason instanceof Exception\CouldNotDecodeData) {
                throw $reason;
            }
            throw new Exception\CouldNotDecodeData(__METHOD__, $encoded, $reason);
        }
    }

    /**
     * @throws Throwable
     */
    abstract protected function doEncode(string $decoded): string;

    /**
     * @throws Throwable
     */
    abstract protected function doDecode(string $encoded): string;
}
