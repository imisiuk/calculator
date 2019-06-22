<?php

namespace Misiyuk\MathBundle\Calculator;

interface CalculatorInterface
{
    public function calc(string $str): float;
}
