<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Functions\Unary\Matcher;

use PeekAndPoke\Component\Psi\Functions\Unary\Matcher\IsEmpty;
use PeekAndPoke\Component\Psi\Functions\Unary\Matcher\IsNotEmpty;

/**
 * Test IsEmpty and IsNotEmpty
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsEmptyIsNotEmptyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsEmpty($psiValue, $expectedResult)
    {
        $subject = new IsEmpty();

        $result = $subject($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testNotEqualTo($psiValue, $expectedResult)
    {
        $expectedResult = !$expectedResult;

        $subject = new IsNotEmpty();

        $result = $subject($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        return [
            // positives - ensure substitution
            [0,             true],
            [0.0,           true],
            ['',            true],
            ['0',           true],
            [null,          true],
            [false,         true],
            [[],            true],

            // positives
            [1,                 false],
            [0.1,               false],
            [' ',               false],
            ['1',               false],
            [new \stdClass(),   false],
            [true,              false],
            [[1],               false],
        ];
    }
}
