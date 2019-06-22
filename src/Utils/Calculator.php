<?php


namespace Misiyuk\MathBundle\Utils;


class Calculator
{
    public function calc(string $str)
    {
        return array_sum(array_map('trim', explode('+', $str)));
    }
}