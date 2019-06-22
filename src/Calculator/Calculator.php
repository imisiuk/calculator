<?php

namespace Misiyuk\MathBundle\Calculator;

class Calculator implements CalculatorInterface
{
    public function calc(string $str): float
    {
        if ($this->isValid($str)) {
            $str = $this->calcDivision($str);
            $str = $this->calcMultiplication($str);
            $str = $this->calcPlus($str);
            $str = $this->calcMinus($str);

            return floatval($str);
        }
        throw new \Exception('Not valid');
    }

    private function isValid(string $str): bool
    {
        return (bool) preg_match('#^\d+([\+\-\/\*]\d+)*$#', $str);
    }

    private function calcDivision(string $str): string
    {
        return preg_replace_callback('#\d+/\d+#', function (string $str) {
            $values = explode('/', $str);
            return $values[0] / $values[1];
        }, $str);
    }

    private function calcMultiplication(string $str): string
    {
        return preg_replace_callback('#\d+\*\d+#', function (string $str) {
            $values = explode('*', $str);
            return $values[0] * $values[1];
        }, $str);
    }

    private function calcPlus(string $str): string
    {
        return preg_replace_callback('#\d+\+\d+#', function (string $str) {
            $values = explode('*', $str);
            return array_sum($values);
        }, $str);
    }

    private function calcMinus(string $str): string
    {
        return preg_replace_callback('#\d+\-\d+#', function (string $str) {
            $values = explode('-', $str);
            return $values[0] - $values[1];
        }, $str);
    }
}
