<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Functions\Unary\TypeCheck;

use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsArray;
use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsNotArray;
use PeekAndPoke\Component\Psi\Tests\Mocks\MockA;

/**
 * Test IsArray
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsArrayIsNotArrayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsArray($psiValue, $expectedResult)
    {
        $subject = new IsArray();

        $result = $subject->apply($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNotArray($psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotArray();

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
            [[],                    true],
            [[1],                   true],

            // negatives
            [new \ArrayIterator(),  false],
            [null,                  false],
            [true,                  false],
            [0,                     false],
            ['Z',                   false],
            [new MockA(),           false],
        ];
    }
}
