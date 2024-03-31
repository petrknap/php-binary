# Library for work with binaries

Library for basic work with binary data in PHP.
See the sample below for more information, or check out [`CoderInterface`](./src/CoderInterface.php).

```php
use PetrKnap\Binary\Binary;

$data = base64_decode('hmlpFnFwbchsoQARSibVpfbWVfuwAHLbGxjFl9eC8fiGaWkWcXBtyGyhABFKJtWl9tZV+7AActsbGMWX14Lx+A==');
$encoded = Binary::encode($data)->checksum()->zlib()->base64(urlSafe: true)->getData();
$decoded = Binary::decode($encoded)->base64()->zlib()->checksum()->getData();

printf('Data was coded into `%s` %s.', $encoded, $decoded === $data ? 'successfully' : 'unsuccessfully');
```

---

Run `composer require petrknap/binary` to install it.
You can [support this project via donation](https://petrknap.github.io/donate.html).
The project is licensed under [the terms of the `LGPL-3.0-or-later`](./COPYING.LESSER).
