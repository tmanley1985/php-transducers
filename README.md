# Transducers in php

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tmanley1985/php-transducers.svg?style=flat-square)](https://packagist.org/packages/tmanley1985/php-transducers)
[![Tests](https://github.com/tmanley1985/php-transducers/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/tmanley1985/php-transducers/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/tmanley1985/php-transducers.svg?style=flat-square)](https://packagist.org/packages/tmanley1985/php-transducers)

Transducers are a way to compose map and filter functions using reduce under the hood. Normally when you run map and filter functions, they create intermediate arrays which isn't performant. The benefit of transducers is that every item in the list can be fed into a pipeline and collected into one intermediate array at the end.


## Installation

You can install the package via composer:

```bash
composer require tmanley1985/php-transducers
```

## Usage

```php
use Tmanley1985\PhpTransducers\TransducibleCollection;

$transformedValues = TransducibleCollection::fromValues([10,11,12,13])
    ->transMap(fn ($num) => $num + 1)
    ->transFilter(fn ($num) => $num % 2 === 0)
    ->transduce();

var_dump($transformed_values); // [12,14]

```

## Testing

Run the container:

```bash
docker-compose up -d
```

Exec into the container:

```bash
docker-compose exec app sh
```

Install dependencies:

```bash
composer install
```

Run the tests:

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details. I'd like to follow this standard.


## Credits

- [Thomas Manley](https://github.com/tmanley1985)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
