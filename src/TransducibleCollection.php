<?php

namespace Tmanley1985\PhpTransducers;

class TransducibleCollection
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
        $pipeline = array_reduce(
            $this->transducers,
            fn ($accTransducer, $nextTransducer) => fn ($reducer) => $accTransducer($nextTransducer($reducer)),
            fn ($reducer) => fn ($acc, $val) => $reducer($acc, $val)
        );

        // TODO, take this and the inital value as parameters.
        $initialReducer = fn ($acc, $val) => array_merge($acc, [$val]);

        $reducer = $pipeline($initialReducer);

        return array_reduce($this->values, $reducer, []);
    }
}
