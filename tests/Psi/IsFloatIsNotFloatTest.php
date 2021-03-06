<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Stubs\UnitTestMockA;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsFloatIsNotFloatTest extends TestCase
{
    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsFloat($psiValue, $expectedResult)
    {
        $subject = new IsFloat();
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);

        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new \PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsFloat();
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNotFloat($psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotFloat();
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new \PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsNotFloat();
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        /** @noinspection UnnecessaryCastingInspection */
        return [
            // positives
            [(float) 0, true],
            [(float) 'Z', true],
            [(double) 1.0, true],  // there seems to be NO difference between float and double
            [(double) 1.1, true],  // there seems to be NO difference between float and double
            [(real) 1.1, true],  // there seems to be NO difference between float and real
            [(float) 1.1, true],
            [0.0, true],

            // negatives
            [null, false],
            [0, false],
            ['Z', false],
            [new \ArrayIterator(), false],
            [new UnitTestMockA(), false],
        ];
    }
}
