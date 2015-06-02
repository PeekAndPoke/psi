<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Functions\Unary\TypeCheck;

use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsNotString;
use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsString;
use PeekAndPoke\Component\Psi\Tests\Mocks\MockA;
use PeekAndPoke\Component\Psi\Tests\Mocks\ToStringMock;

/**
 * Test IsString
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsStringIsNotStringTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsString($psiValue, $expectedResult)
    {
        $subject = new IsString();

        $result = $subject->apply($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNotString($psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotString();

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
            ['',                    true],
            ['a',                   true],

            // negatives
            [null,                  false],
            [0,                     false],
            [true,                  false],
            [false,                 false],
            [new MockA(),           false],
            [new ToStringMock('a'), false],
        ];
    }
}
