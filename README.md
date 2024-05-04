# Library for work with binary data and objects

Simple library for work with binary data and objects in PHP.
See the examples below for more information, or check out [`Encoder`](./src/Encoder.php), [`Decoder`](./src/Decoder.php), [`Serializer`](./src/Serializer.php) and [`Byter`](./src/Byter.php).

```php
namespace PetrKnap\Binary;

$data = base64_decode('hmlpFnFwbchsoQARSibVpfbWVfuwAHLbGxjFl9eC8fiGaWkWcXBtyGyhABFKJtWl9tZV+7AActsbGMWX14Lx+A==');
$encoded = Binary::encode($data)->checksum()->zlib()->base64(urlSafe: true)->getData();
$decoded = Binary::decode($encoded)->base64()->zlib()->checksum()->getData();

printf('Data was coded into `%s` %s.', $encoded, $decoded === $data ? 'successfully' : 'unsuccessfully');
```

```php
namespace PetrKnap\Binary;

$data = [
    'type' => 'image/png',
    'data' => base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAA1JREFUGFdj+L+U4T8ABu8CpCYJ1DQAAAAASUVORK5CYII='),
];
$serialized = Binary::serialize($data);
$unserialized = Binary::unserialize($serialized);

printf('Data was serialized into `%s` %s.', base64_encode($serialized), $unserialized === $data ? 'successfully' : 'unsuccessfully');
```

```php
namespace PetrKnap\Binary;

class DataObject implements Serializer\SelfSerializerInterface
{
    use Serializer\SelfSerializerTrait;
    
    public function __construct(
        public string $data,
    ) {
        $this->referencesToConstructorArgs = [
            &$this->data,
        ];
    }
}

$instance = new DataObject('Lorem ipsum dolor sit amet, consectetur adipiscing elit.');
$instance->data .= ' Duis venenatis ultricies elementum.';
$binary = $instance->toBinary();
$binaryFromHelper = Binary::asBinary($instance);

printf(
    'Data object was serialized into `%s` %s.',
    base64_encode($binary),
    $binary === $binaryFromHelper && $instance == DataObject::fromBinary($binary) ? 'successfully' : 'unsuccessfully',
);
```

```php
namespace PetrKnap\Binary;

$data = base64_decode('hmlpFnFwbchsoQARSibVpfbWVfuwAHLbGxjFl9eC8fiGaWkWcXBtyGyhABFKJtWl9tZV+7AActsbGMWX14Lx+A==');
$sha1 = sha1($data, binary: true);
$md5 = md5($data, binary: true);
$unbitten = Binary::unbite($sha1, $md5, $data);
[$sha1Bite, $md5Bite, $dataBite] = Binary::bite($unbitten, 20, 16);

printf(
    'Hashes and data was unbitten into `%s` %s.',
    base64_encode($unbitten),
    $sha1Bite === $sha1 && $md5Bite === $md5 && $dataBite === $data ? 'successfully' : 'unsuccessfully',
);
```

---

Run `composer require petrknap/binary` to install it.
You can [support this project via donation](https://petrknap.github.io/donate.html).
The project is licensed under [the terms of the `LGPL-3.0-or-later`](./COPYING.LESSER).
