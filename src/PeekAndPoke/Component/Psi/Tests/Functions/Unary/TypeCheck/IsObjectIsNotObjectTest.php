<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Functions\Unary\TypeCheck;

use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsNotObject;
use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsObject;
use PeekAndPoke\Component\Psi\Tests\Mocks\MockA;

/**
 * Test IsObject
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsObjectIsNotObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsObject($psiValue, $expectedResult)
    {
        $subject = new IsObject();

        $result = $subject->apply($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNotObject($psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotObject();

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
            [new \ArrayIterator(),  true],
            [new MockA(),           true],
            [new \stdClass(),       true],

            // negatives
            [null,                  false],
            [0,                     false],
            ['2',                   false],
            ['z',                   false],
            [true,                  false],
            [false,                 false],
        ];
    }
}
