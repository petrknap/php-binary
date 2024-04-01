<?php declare(strict_types=1);

namespace PetrKnap\Binary;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use stdClass;

final class SerializerTest extends TestCase
{
    private EncoderInterface&MockObject $internalEncoder;
    private DecoderInterface&MockObject $internalDecoder;
    private SerializerInterface&MockObject $internalSerializer;
    private Serializer $serializer;

    public function setUp(): void
    {
        parent::setUp();

        $this->internalEncoder = self::createMock(EncoderInterface::class);
        $this->internalDecoder = self::createMock(DecoderInterface::class);
        $this->internalSerializer = self::createMock(SerializerInterface::class);

        $this->serializer = new class (
            $this->internalEncoder,
            $this->internalDecoder,
            $this->internalSerializer,
        ) extends Serializer {
            public function __construct(
                EncoderInterface $encoder,
                DecoderInterface $decoder,
                private readonly SerializerInterface $serializer,
            ) {
                parent::__construct($encoder, $decoder);
            }
            protected function doSerialize(mixed $serializable): string
            {
                return $this->serializer->serialize($serializable);
            }
            protected function doUnserialize(string $serialized): mixed
            {
                return $this->serializer->unserialize($serialized);
            }
        };
    }

    public function testSerializesData(): void
    {
        $data = new stdClass();
        $data->array = [];
        $data->binary = 0b0;
        $data->float = .0;
        $data->int = 0;
        $data->null = null;
        $data->string = '';
        $serializer = new Serializer(
            new Encoder(),
            new Decoder(),
        );

        self::assertEquals(
            $data,
            $serializer->unserialize(
                $serializer->serialize(
                    $data,
                ),
            ),
        );
    }

    public function testCallsDoSerializeAndUsesEncoder(): void
    {
        $serializable = (string) 0b01;
        $serialized = (string) 0b10;
        $encoded = (string) 0b11;

        $this->internalSerializer->expects(self::once())
            ->method('serialize')
            ->with($serializable)
            ->willReturn($serialized);
        $this->internalEncoder->expects(self::once())
            ->method('withData')
            ->with($serialized)
            ->willReturn($this->internalEncoder);
        $this->internalEncoder->expects(self::once())
            ->method('zlib')
            ->willReturn($this->internalEncoder);
        $this->internalEncoder->expects(self::once())
            ->method('getData')
            ->willReturn($encoded);

        self::assertSame(
            $encoded,
            $this->serializer->serialize($serializable),
        );
    }

    public function testUsesDecoderAndCallsDoUnserialize(): void
    {
        $serialized = (string) 0b01;
        $decoded = (string) 0b10;
        $serializable = (string) 0b11;

        $this->internalDecoder->expects(self::once())
            ->method('withData')
            ->with($serialized)
            ->willReturn($this->internalDecoder);
        $this->internalDecoder->expects(self::once())
            ->method('zlib')
            ->willReturn($this->internalDecoder);
        $this->internalDecoder->expects(self::once())
            ->method('getData')
            ->willReturn($decoded);
        $this->internalSerializer->expects(self::once())
            ->method('unserialize')
            ->with($decoded)
            ->willReturn($serializable);

        self::assertSame(
            $serializable,
            $this->serializer->unserialize($serialized),
        );
    }
}
