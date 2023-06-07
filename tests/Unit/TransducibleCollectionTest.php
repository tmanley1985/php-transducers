<?php

use TManley1985\PhpTransducers\TransducibleCollection;

it('can map a function over an array', function () {
    $mappedValues = TransducibleCollection::fromValues([1,2,3])
        ->transMap(fn ($num) => $num + 1)
        ->transduce();

    $this->assertEquals([2,3,4], $mappedValues);
});

it('can filter an array', function () {
    $filteredValues = TransducibleCollection::fromValues([1,2,3,4])
        ->transFilter(fn ($num) => $num % 2 === 0)
        ->transduce();

    $this->assertEquals([2,4], $filteredValues);
});

it('can map and then filter', function () {

    // This also ensures that the left to right composition is maintained.
    $transformedValues = TransducibleCollection::fromValues([10,11,12,13])
        ->transMap(fn ($num) => $num + 1)
        ->transFilter(fn ($num) => $num % 2 === 0)
        ->transduce();

    $this->assertEquals([12,14], $transformedValues);
});
