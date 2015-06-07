<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Functions\Unary\TypeCheck;

use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsInteger;
use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsNotInteger;
use PeekAndPoke\Component\Psi\Tests\Mocks\MockA;

/**
 * Test IsIntegerIsNotIntegerTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsIntegerIsNotIntegerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsInteger($psiValue, $expectedResult)
    {
        $subject = new IsInteger();

        $result = $subject->apply($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNotInteger($psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotInteger();

        $result = $subject->apply($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        return [
            // positives
            [0,                     true],
            [1,                     true],
            [PHP_INT_MAX - 1,       true],
            [PHP_INT_MAX,           true],
            [(int) 1.0,             true],
            [(int) '1',             true],
            [(int) 1,              true],

            // negatives
            [PHP_INT_MAX + 1,       false],
            [null,                  false],
            [true,                  false],
            [false,                 false],
            [0.0,                   false],
            [(real) 0.0,            false],
            [(float) 0.0,           false],
            [(double) 0.0,          false],
            ['Z',                   false],
            [new \ArrayIterator(),  false],
            [new MockA(),           false],
        ];
    }
}