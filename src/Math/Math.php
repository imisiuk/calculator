<?php

namespace Misiyuk\Bundle\MathBundle\Math;

use Misiyuk\Bundle\MathBundle\Math\Calculator\CalculatorInterface;

class Math
{
    private $calculator;

    public function __construct(CalculatorInterface $calculator)
    {
        $this->calculator = $calculator;
    }

    public function calc(string $str): float
    {
        return $this->calculator->calc($str);
    }
}