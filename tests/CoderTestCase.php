<?php declare(strict_types=1);

namespace PetrKnap\Binary;

use PHPUnit\Framework\TestCase;

abstract class CoderTestCase extends TestCase
{
    private const DATA_BASE64 = '2jmj7l5rSw0yVb/vlWAYkK/YBwnaOaPuXmtLDTJVv++VYBiQr9gHCdo5o+5ea0sNMlW/75VgGJCv2AcJ';

    public static function dataBase64(): array
    {
        $data = base64_decode(self::DATA_BASE64);
        return [
            'URL unsafe' => [$data, self::DATA_BASE64, false],
            'URL safe' => [$data, '2jmj7l5rSw0yVb_vlWAYkK_YBwnaOaPuXmtLDTJVv--VYBiQr9gHCdo5o-5ea0sNMlW_75VgGJCv2AcJ', true],
        ];
    }

    public static function dataChecksum(): array
    {
        $data = base64_decode(self::DATA_BASE64);
        return [
            'crc32' => [$data, $data . hex2bin('95a41ef8'), 'crc32'],
            'sha1' => [$data, $data . hex2bin('d0dc1cf9bf61884f8e7982e0b1b87954bd9ee9c7'), 'sha1'],
        ];
    }

    public static function dataZlib(): array
    {
        $data = base64_decode(self::DATA_BASE64);
        return [
            'RAW' => [$data, base64_decode('u2W5+F1ctjevUej+91MTJCasv8HOeYtIMQA='), ZLIB_ENCODING_RAW, EncoderInterface::ZLIB_LEVEL],
            'deflate' => [$data, base64_decode('eJy7Zbn4XVy2N69R6P73UxMkJqy/wc55i0gxAF0bG4s='), ZLIB_ENCODING_DEFLATE, EncoderInterface::ZLIB_LEVEL],
            'gzip' => [$data, base64_decode('H4sIAAAAAAAAA7tlufhdXLY3r1Ho/vdTEyQmrL/BznmLSDEAqyp39zwAAAA='), ZLIB_ENCODING_GZIP, EncoderInterface::ZLIB_LEVEL],
        ];
    }
}
