<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Functions\Unary\TypeCheck;

use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsFloat;
use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsNotFloat;
use PeekAndPoke\Component\Psi\Tests\Mocks\MockA;

/**
 * Test IsFloatIsNotFloatTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsFloatIsNotFloatTest extends \PHPUnit_Framework_TestCase
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

        $result = $subject->__invoke($psiValue);

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

        $result = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        return [
            // positives
            [(float) 0,             true],
            [(float) 'Z',           true],
            [(double) 0.0,          true],  // there seems to be no difference between float and double
            [0.0,                   true],

            // negatives
            [null,                  false],
            [0,                     false],
            ['Z',                   false],
            [new \ArrayIterator(),  false],
            [new MockA(),           false],
        ];
    }
}
