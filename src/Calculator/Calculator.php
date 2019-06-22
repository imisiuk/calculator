<?php

namespace Misiyuk\MathBundle\Calculator;

class Calculator implements CalculatorInterface
{
    public function calc(string $str): float
    {
        if ($this->isValid($str)) {
            $str = $this->calcOperation($str, '/', function (array $v) {
                return $v[0] / $v[1];
            });
            $str = $this->calcOperation($str, '*', function (array $v) {
                return $v[0] * $v[1];
            });
            $str = $this->calcOperation($str, '-', function (array $v) {
                return $v[0] - $v[1];
            });
            $str = $this->calcOperation($str, '+', 'array_sum');

            return floatval($str);
        }
        throw new \Exception('Not valid');
    }

    private function isValid(string $str): bool
    {
        return (bool) preg_match('#^[\-]?\d+(\.\d+)?([\+\-\/\*]\d+(\.\d+)?)*$#', $str);
    }

    private function calcOperation(string $str, string $operation, callable $func): string
    {
        $pattern = '#[\-]?\d+(\.\d+)?\\'.$operation.'\d+\.?\d*#';
        while (preg_match($pattern, $str)) {
            $str = preg_replace_callback($pattern, function (array $str) use ($operation, $func) {
                $values = array_map(function (string $v) {
                    return floatval($v);
                }, preg_split('#\b\\'.$operation.'#', $str[0]));

                return $func($values);
            }, $str);
        }

        return $str;
    }
}
