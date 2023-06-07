# PHP Transducers
An implementation of transducers in php

## About

Transducers allow you to compose map and filter operations without the need for intermediate data structures by composing reducing functions (reducers). They're like a factory for reducing functions. Whenever you run a map or filter operation, you're creating a new intermediate data structure which is usually negligible, but as the size of your input scales, so do these operations.

True transducers should be able to operate on multiple data structures: trees, streams, arrays, etc. This library only operates on arrays.

I've created two videos as part of a larger series on the reduce method on youtube. All examples are in es6:

1. [Transducers: Mapping](https://youtu.be/ywtYDInYPKc)
2. [Transducers: Filtering](https://youtu.be/aX1HgyG5o60)


## TOC
* [Installation](#installation)
* [Usage](#usage)
* [Versioning](#versioning)
* [License](#license)


## Installation

First:

```
composer require tmanley1985/php-transducers
```

## Usage

```php

use TManley1985\PhpTransducers\TransducibleCollection;

TransducibleCollection::fromValues([10,11,12,13])
    ->transMap(fn ($num) => $num + 1)
    ->transFilter(fn ($num) => $num % 2 === 0)
    ->transduce(); // [12,14]

```

## Versioning

We use [SemVer](http://semver.org/) for versioning.

## License

This project is licensed under the MIT License
