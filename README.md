# Library for work with binary data and objects

Simple library for work with binary data and objects in PHP.
See the examples below for more information, or check out [`Encoder`](./src/Encoder.php), [`Decoder`](./src/Decoder.php) and [`Serializer`](./src/Serializer.php).

```php
use PetrKnap\Binary\Binary;

$data = base64_decode('hmlpFnFwbchsoQARSibVpfbWVfuwAHLbGxjFl9eC8fiGaWkWcXBtyGyhABFKJtWl9tZV+7AActsbGMWX14Lx+A==');
$encoded = Binary::encode($data)->checksum()->zlib()->base64(urlSafe: true)->getData();
$decoded = Binary::decode($encoded)->base64()->zlib()->checksum()->getData();

printf('Data was coded into `%s` %s.', $encoded, $decoded === $data ? 'successfully' : 'unsuccessfully');
```

```php
use PetrKnap\Binary\Binary;

$data = [
    'type' => 'image/png',
    'data' => base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAA1JREFUGFdj+L+U4T8ABu8CpCYJ1DQAAAAASUVORK5CYII='),
];
$serialized = Binary::serialize($data);
$unserialized = Binary::unserialize($serialized);

printf('Data was serialized into `%s` %s.', base64_encode($serialized), $unserialized === $data ? 'successfully' : 'unsuccessfully');
```

---

Run `composer require petrknap/binary` to install it.
You can [support this project via donation](https://petrknap.github.io/donate.html).
The project is licensed under [the terms of the `LGPL-3.0-or-later`](./COPYING.LESSER).
