<?php

declare(strict_types=1);

namespace PetrKnap\Binary\Serializer;

final class PhpTest extends SerializerTestCase
{
    public static function getSerialized(): string
    {
        return 'O:8:"stdClass":6:{s:5:"array";a:0:{}s:6:"binary";i:0;s:5:"float";d:0;s:3:"int";i:0;s:4:"null";N;s:6:"string";s:0:"";}';
    }

    public static function getSerializer(): SerializerInterface
    {
        return new Php();
    }
}
