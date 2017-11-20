<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Mocks\ToStringMock;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsNumericIsNotNumericTest extends TestCase
{
    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNumeric($psiValue, $expectedResult)
    {
        $subject = new IsNumeric();
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new \PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsNumeric();
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNotNumeric($psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotNumeric();
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new \PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsNotNumeric();
        $result  = $subject->__invoke($psiValue);

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
            [1.0,                   true],
            [(int) 1.0,             true],
            [1.0,                   true],
            ['0',                   true],
            ['1.0',                 true],
            ['123',                 true],

            // negatives
            [null,                  false],
            ['z0',                  false],
            ['0z',                  false],
            [new \ArrayIterator(),  false],
            [true,                  false],
            [false,                 false],
            ['Z',                   false],
            [new ToStringMock(1),   false],
        ];
    }
}
