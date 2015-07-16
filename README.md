Rut Library
===========

This library contain two simples class to provide you helpers methods to work with rut.

# Usage Util

## Validate a Rut.
```php
<?php
use Tifon\Rut\RutUtil;

RutUtil::validateRut('11.111.111-1');
// Or
RutUtil::validateRut(11111111, 1);
```

## Generate random Rut.
```php
<?php
use Tifon\Rut\RutUtil;

$randomRutWithFormatter = RutUtil::generateRut();
// Generate rut between 1000000 and 2000000 and separate the check digit.
list($rut, $dv) = RutUtil::generateRut(FALSE, 1000000, 2000000);
```

## Formatting a Rut.
```php
<?php
use Tifon\Rut\RutUtil;

$rut = RutUtil::formatterRut(111111111);
// 11.111.111-1

// Or
$rut = RutUtil::formatterRut(11111111, 1, FALSE);
// 11111111-1
```

## Separate the check digit from the Rut.
```php
<?php
use Tifon\Rut\RutUtil;

list($rut, $dv) = RutUtil::separateRut('11.111.111-1');
```

# Usage Rut
```php
<?php
use Tifon\Rut\Rut;

$rut = new Rut('11.111.111-1');
// Or
$rut = new Rut(11111111, 1);

echo $rut->getRut();
// 11111111
echo $rut->getDv();
// 1
echo $rut->getFormatter();
// 11.111.111-1
echo $rut->getRaw();
// 111111111
echo $rut->isValid();
// 1
```