<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Functions\Unary\TypeCheck;

use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsNotNull;
use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsNull;
use PeekAndPoke\Component\Psi\Tests\Mocks\MockA;

/**
 * Test IsNull
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsNullIsNotNullTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNull($psiValue, $expectedResult)
    {
        $subject = new IsNull();

        $result = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNotNull($psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotNull();

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
            [null,                  true],

            // negatives
            [0,                     false],
            ['0',                   false],
            [new \ArrayIterator(),  false],
            [true,                  false],
            ['Z',                   false],
            [new MockA(),           false],
        ];
    }
}
