<?php

namespace Misiyuk\Bundle\MathBundle\Tests;

use Misiyuk\Bundle\MathBundle\Math\Calculator\CalculatorInterface;
use Misiyuk\Bundle\MathBundle\Math\Math;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MathTest extends WebTestCase
{
    public function testMathCalculator()
    {
        self::bootKernel();
        $container = self::$kernel->getContainer();
        /** @var CalculatorInterface $calculator */
        $calculator = $container->get('calculator');
        $math = new Math($calculator);
        $result = $math->calc('-2*2-15*56/15*5-61/3+22*2*5/5-1+5564/156+1');
        $this->assertEquals(-224.66666666666, $result);
        try {
            $math->calc('-2**2');
            $error = false;
        } catch (\Exception $e) {
            $error = true;
        }
        $this->assertTrue($error);
    }
}
