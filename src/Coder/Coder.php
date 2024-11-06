<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Coder;

use Throwable;

/**
 * @internal shared logic
 */
abstract class Coder implements CoderInterface
{
    public function encode(string $decoded): string
    {
        try {
            return $this->doEncode($decoded);
        } catch (Exception\CoderCouldNotEncodeData $exception) {
            throw $exception;
        } catch (Throwable $reason) {
            throw new Exception\CoderCouldNotEncodeData(__METHOD__, $decoded, $reason);
        }
    }

    public function decode(string $encoded): string
    {
        try {
            return $this->doDecode($encoded);
        } catch (Exception\CoderCouldNotDecodeData $exception) {
            throw $exception;
        } catch (Throwable $reason) {
            throw new Exception\CoderCouldNotDecodeData(__METHOD__, $encoded, $reason);
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
