<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck;

use PeekAndPoke\Component\Psi\Mocks\MockA;
use PeekAndPoke\Component\Psi\Mocks\ToStringMock;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsStringIsNotStringTest extends TestCase
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

        $result = $subject->__invoke($psiValue);

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
