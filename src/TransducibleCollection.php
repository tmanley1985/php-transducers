<?php

namespace Tmanley1985\PhpTransducers;

final class TransducibleCollection
{
    protected $transducers = [];

    private function __construct(public array $values)
    {
    }

    public static function fromValues(array $values)
    {
        return new static($values);
    }

    public function transMap(callable $xformFn)
    {
        $this->transducers[] = $this->makeMapTransducer($xformFn);

        return $this;
    }

    public function transFilter(callable $predicateFn)
    {
        $this->transducers[] = $this->makeFilterTransducer($predicateFn);

        return $this;
    }

    private function makeMapTransducer(callable $xformFn)
    {
        // Transform the value before passing it into the reducer and return a NEW reducer!
        return fn ($reducer) => fn ($acc, $val) => $reducer($acc, $xformFn($val));
    }

    private function makeFilterTransducer(callable $predicateFn)
    {
        // Transform the value before passing it into the reducer and return a NEW reducer!
        return fn ($reducer) => fn ($acc, $val) => $predicateFn($val) ? $reducer($acc, $val) : $acc;
    }

    public function transduce()
    {
        // Here we compose our transducers together to get a pipeline.
        $pipeline = array_reduce(
            $this->transducers,
            fn ($accTransducer, $nextTransducer) => fn ($reducer) => $accTransducer($nextTransducer($reducer)),
            fn ($reducer) => fn ($acc, $val) => $reducer($acc, $val)
        );

        // This initial reducer is an identity function for arrays under concatenation.
        $initialReducer = fn ($acc, $val) => array_merge($acc, [$val]);

        // The transducers entire job is to compose reducing functions and return a NEW reducer.
        $reducer = $pipeline($initialReducer);

        // Here we finally use this reducer.
        return array_reduce($this->values, $reducer, []);
    }
}
